<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Voucher;
use App\Models\Personal;
use App\Models\AsignacionPedido;
use Illuminate\Http\Request;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        // Recibir datos de la solicitud
        $total = $request->input('total'); // Total en céntimos
        $description = json_decode($request->input('description'), true); // Items del carrito
        $deliveryOption = $request->input('estadoVariable'); // 'sendHome' o 'pickupStore'
        $direccion = $request->input('address') ?? 'Recojo en tienda'; // Dirección de entrega o "Recojo en tienda"
        $metodoPago = $request->input('MetodoPago') ?? 'Tarjeta'; // Método de pago
        $tipoPedido = $deliveryOption === 'sendHome' ? 'Delivery' : 'Recojo en tienda'; // Tipo de pedido


        // Validar el nombre del cliente
        $customerName = $request->input('customerName') ?? (auth()->check() ? auth()->user()->name : null);

        // Validar si el nombre es null
        if (!$customerName) {
            return redirect()->back()->with('error', 'El nombre del cliente no puede estar vacío.');
        }

        $userId = auth()->user()->id; // Usuario autenticado
        $fechaPedido = now(); // Fecha y hora actual

        // Crear un registro de Pedido
        $pedido = new Pedido();
        $pedido->user_id = $userId;
        $pedido->nombre = $customerName;
        $pedido->estado = 'Pendiente'; // Estado inicial
        $pedido->direccion = $direccion;
        $pedido->MetodoPago = $metodoPago;
        $pedido->FechaPedido = $fechaPedido;
        $pedido->TipoPedido = $tipoPedido;
        $pedido->save();

        // Crear los detalles del pedido
        foreach ($description as $item) {
            $detallePedido = new DetallePedido();
            $detallePedido->pedido_id = $pedido->id; // ID del pedido
            $detallePedido->platillo_id = $item['id']; // ID del platillo o producto
            $detallePedido->cantidad = $item['qty']; // Cantidad
            $detallePedido->total = $item['qty'] * $item['price']; // Total por ítem
            $detallePedido->save();
        }

        // Si la opción es "sendHome" (Envío a casa), asignar un repartidor disponible
        if ($deliveryOption === 'delivery') {
            $repartidor = Personal::where('cargo', 'Repartidor')
                ->where('estado', 'Disponible')
                ->first();

            if (!$repartidor) {
                return redirect()->back()->with('error', 'No hay repartidores disponibles en este momento.');
            }

            // Asignar el pedido al repartidor
            $asignacion = new AsignacionPedido();
            $asignacion->pedido_id = $pedido->id;
            $asignacion->personal_id = $repartidor->id;
            $asignacion->estado = 'Asignado';
            $asignacion->fecha_asignacion = now();
            $asignacion->direccion = $direccion;
            $asignacion->save();

            // Actualizar el estado del repartidor a "Ocupado"
            $repartidor->estado = 'Ocupado';
            $repartidor->save();
        }

        // Crear el voucher para el pedido
        $voucher = new Voucher();
        $voucher->codigo = 'VOU-' . str_pad($pedido->id, 6, '0', STR_PAD_LEFT); // Código único del voucher
        $voucher->fecha = $fechaPedido->format('Y-m-d'); // Fecha del pedido
        $voucher->estado = 'Pagado'; // Estado del voucher
        $voucher->pedido_id = $pedido->id; // Asociar al pedido
        $voucher->save();

        // Crear un ítem de línea para Stripe con el total
        $lineItems = [
            [
                'price_data' => [
                    'currency' => 'pen',
                    'product_data' => [
                        'name' => 'Total con IGV',
                    ],
                    'unit_amount' => $total,
                ],
                'quantity' => 1,
            ]
        ];

        // Crear la sesión de Stripe
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('summary', ['pedido_id' => $pedido->id]),
            'cancel_url' => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function summary(Request $request)
    {
        $pedidoId = $request->input('pedido_id');
        $pedido = Pedido::with(['detalles'])->findOrFail($pedidoId); // Cargar pedido con detalles

        // Verificar si el pedido necesita asignar un repartidor
        if ($pedido->TipoPedido === 'Envío a casa' && !$pedido->asignacion) {
            $repartidor = Personal::where('cargo', 'Repartidor')
                ->where('estado', 'Disponible')
                ->first();

            if ($repartidor) {
                $asignacion = new AsignacionPedido();
                $asignacion->pedido_id = $pedido->id;
                $asignacion->personal_id = $repartidor->id;
                $asignacion->estado = 'Asignado';
                $asignacion->fecha_asignacion = now();
                $asignacion->direccion = $pedido->direccion;
                $asignacion->save();

                $repartidor->estado = 'Ocupado';
                $repartidor->save();
            }
        }

        return view('purchase_summary', [
            'pedido' => $pedido,
            'detallePedidos' => DetallePedido::where('pedido_id', $pedido->id)->get(),
            'voucher' => Voucher::where('pedido_id', $pedido->id)->first(),
        ]);
    }
}
