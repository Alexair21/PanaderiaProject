<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Venta;
use App\Models\Pedido;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use App\Models\Voucher;

class StripeController extends Controller
{
    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $total = $request->input('total'); // Recibe el total en céntimos
        $description = json_decode($request->input('description'), true);
        $estadoVariable = $request->input('estadoVariable'); // Obtener la variable del input oculto
        $customerName = $request->input('customerNameHidden') ?? $request->input('customerNameHiddenCard'); // Obtener el nombre del cliente
        $ventaId = $request->input('venta_id'); // Obtener el ID de la venta

        // Almacenar el estado, el nombre del cliente y el ID de la venta en la sesión
        $request->session()->put('estadoVariable', $estadoVariable);
        $request->session()->put('customerName', $customerName);
        $request->session()->put('venta_id', $ventaId);

        // Crear un ítem de línea para el total con IGV
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

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('summary', ['total' => $total, 'description' => $request->input('description')]),
            'cancel_url' => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function summary(Request $request)
    {
        $total = $request->input('total') / 100; // Convertir de céntimos a soles
        $cartItems = json_decode($request->input('description'), true);

        // Recuperar el valor de estadoVariable, el nombre del cliente y el ID de la venta desde la sesión
        $estadoVariable = $request->session()->get('estadoVariable');
        $customerName = $request->session()->get('customerName');
        $ventaId = $request->session()->get('venta_id');

        // Determinar el estado basado en la variable
        switch ($estadoVariable) {
            case '1':
                $estado = 'Delivery';
                break;
            case '2':
                $estado = 'Pago normal-Efectivo';
                break;
            case '3':
                $estado = 'Pago normal-Tarjeta';
                break;
            default:
                $estado = 'Desconocido';
                break;
        }

        // Asegurarse de que el usuario está autenticado
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para completar la compra.');
        }

        // Obtener el id del usuario que está logueado
        $cliente_id = auth()->user()->id;

        // Obtener la fecha actual
        $fecha = now(); // Esto obtiene la fecha y hora actual en formato Carbon

        // Buscar una venta existente por ID o crear una nueva
        $venta = Venta::find($ventaId);

        if ($venta) {
            // Si se encuentra una venta existente, actualizar el estado y total
            $venta->estado = 'Pagado';
            $venta->total = $total;
            $venta->save();
        } else {
            // Si no se encuentra, crear una nueva venta
            $venta = new Venta();
            $venta->cliente_nombre = $customerName;
            $venta->fecha_venta = $fecha; // Cambiado de 'fecha' a 'fecha_venta' para mayor claridad
            $venta->estado = 'Pagado';
            $venta->total = $total;
            $venta->save();

            // Guardar datos en la tabla pedidos
            foreach ($cartItems as $item) {
                if (isset($item['qty']) && isset($item['price']) && isset($item['id'])) {
                    // Obtener los datos necesarios
                    $cantidad = $item['qty'];
                    $precio_unitario = $item['price'];
                    $total_item = $item['qty'] * $item['price'];
                    $producto_id = $item['id'];
                    $venta_id = $venta->id;

                    // Insertar en la tabla pedidos
                    $pedido = new Pedido();
                    $pedido->cantidad = $cantidad;
                    $pedido->precio_unitario = $precio_unitario;
                    $pedido->total = $total_item;
                    $pedido->producto_id = $producto_id;
                    $pedido->venta_id = $venta_id;
                    $pedido->save();
                } else {
                    // Manejar el caso donde los datos no están completos
                    return redirect()->route('cart.index')->with('error', 'Datos del carrito incompletos.');
                }
            }
        }



        // Insertar en la tabla vouchers
        $voucher = new Voucher();
        $voucher->codigo = '0000' . $venta->id;
        $voucher->fecha = $fecha;
        $voucher->estado = $estado;
        $voucher->ventas_id = $venta->id;
        $voucher->save();

        // Limpiar el carrito
        Cart::destroy();

        // Obtener los pedidos de la venta
        $ventaItems = Pedido::where('venta_id', $venta->id)->get();

        // Pasar los datos necesarios a la vista
        return view('purchase_summary', [
            'venta' => $venta,
            'ventaItems' => $ventaItems,
            'voucher' => $voucher
        ]);
    }
}
