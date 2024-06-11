<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Venta;
use App\Models\Pedido;
use App\Models\Voucher;

use Illuminate\Support\Str;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $producto = Producto::find($request->id);
        $precioSeleccionado = $request->input('precio_seleccionado');
        $precio = $precioSeleccionado === 'base' ? $producto->precio : $producto->precios()->where('id', $precioSeleccionado)->first()->precio;
        $cantidad = $request->input('quantity', 1);

        // Obtener la descripción
        $tamaño = $precioSeleccionado === 'base' ? 'Base' : $producto->precios()->where('id', $precioSeleccionado)->first()->nombre;
        $crema = $request->input('cream', 'No');
        $jarabes = $request->input('extras', []);
        $descripcion = "Tamaño: $tamaño, Crema: $crema, Jarabes: " . implode(', ', $jarabes);

        Cart::add(
            $producto->id,
            $producto->nombre,
            $cantidad,
            $precio,
            [
                'imagen' => $producto->imagen,
                'descripcion' => $descripcion
            ]
        );

        return redirect()->back()->with('success', 'Producto agregado al carrito: ' . $producto->nombre);
    }


    public function checkout()
    {
        return view('cart.checkout');
    }

    public function removeItem(Request $request)
    {
        Cart::remove($request->rowId);
        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    public function clear()
    {
        Cart::destroy();
        return redirect()->back()->with('success', 'Carrito vaciado');
    }

    public function formaPago()
    {
        return view('cart.formaPago', [
            'cartItems' => Cart::content(),
            'subtotal' => Cart::subtotal(),
            'tax' => Cart::tax(),
            'total' => Cart::total()
        ]);
    }

    public function pagoTarjeta()
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Café',
                        ],
                        'unit_amount' => Cart::total() * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        return redirect()->away($session->url);
    }

    public function confirmarPagoEfectivo(Request $request)
    {
        $total = $request->input('total') / 100; // Convertir de céntimos a soles
        $cartItems = json_decode($request->input('description'), true);

        // Obtener el valor de estadoVariable desde la solicitud
        $estadoVariable = $request->input('estadoVariable');

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
        $voucher->codigo = '0000'. $venta->id;
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
