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

        // Almacenar el estado en la sesión
        $request->session()->put('estadoVariable', $estadoVariable);

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

        // Recuperar el valor de estadoVariable desde la sesión
        $estadoVariable = $request->session()->get('estadoVariable');

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

        // Insertar en la tabla ventas
        $venta = new Venta();
        $venta->cliente_id = $cliente_id;
        $venta->fecha_venta = $fecha; // Cambiado de 'fecha' a 'fecha_venta' para mayor claridad
        $venta->total = $total;
        $venta->save();

        // Guardar datos en la tabla pedidos
        foreach ($cartItems as $item) {
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
        }

        // Insertar en la tabla vouchers
        $voucher = new Voucher();
        $voucher->codigo =  '0000' . $venta->id;
        $voucher->fecha = $fecha;
        $voucher->estado = $estado;
        $voucher->ventas_id = $venta->id;
        $voucher->save();

        // Limpiar el carrito
        Cart::destroy();
        $voucher = Voucher::all()->last();

        return view('purchase_summary', compact('total', 'cartItems', 'estado', 'voucher'));
    }
}
