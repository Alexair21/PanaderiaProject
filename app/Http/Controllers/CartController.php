<?php

namespace App\Http\Controllers;

use App\Models\Platillo;
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
        // Buscar el platillo por su ID
        $platillo = Platillo::find($request->id);
        if (!$platillo) {
            return redirect()->back()->with('error', 'Platillo no encontrado.');
        }

        // Obtener la cantidad y precio
        $cantidad = $request->input('quantity', 1);
        $precio = $platillo->precio;

        // Obtener las observaciones del usuario
        $observaciones = $request->input('observaciones', '');

        // Descripción (concatenamos la descripción del platillo con las observaciones, si existen)
        $descripcion = $platillo->descripcion;
        if (!empty($observaciones)) {
            $descripcion .= ' - Observaciones: ' . $observaciones;
        }

        // Agregar al carrito
        Cart::add(
            $platillo->id,
            $platillo->nombre,
            $cantidad,
            $precio,
            [
                'imagen' => asset($platillo->imagen), // Usar asset() para generar la ruta correcta de la imagen
                'descripcion' => $descripcion,
            ]
        );

        return redirect()->back()->with('success', 'Platillo agregado al carrito: ' . $platillo->nombre);
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

    public function guardarVenta(Request $request)
    {
        //guardar la venta
        $venta = new Venta();
        $venta->cliente_nombre = $request->input('cliente_nombre');
        $venta->fecha_venta = now();
        $venta->total = Cart::total();
        $venta->save();

        //guardar los pedidos
        foreach (Cart::content() as $item) {
            $pedido = new Pedido();
            $pedido->cantidad = $item->qty;
            $pedido->precio_unitario = $item->price;
            $pedido->total = $item->price * $item->qty;
            $pedido->producto_id = $item->id;
            $pedido->venta_id = $venta->id;
            $pedido->save();
        }

        //limpiar el carrito
        Cart::destroy();

        //redireccionar al menu
        return redirect()->route('catalogos.index')->with('success', 'Venta realizada correctamente');
    }

    public function estadoPagar(Venta $venta)
    {
        // Obtener los pedidos relacionados con la venta
        $pedidos = Pedido::where('venta_id', $venta->id)->get();

        // Calcular el subtotal, IGV y total
        $subtotal = $pedidos->sum(function ($pedido) {
            return $pedido->cantidad * $pedido->precio_unitario;
        });
        $tax = $subtotal * 0.18; // Asumiendo un IGV de 18%
        $total = $subtotal + $tax;

        // Pasar los datos a la vista
        return view('cart.estadoPagar', compact('venta', 'pedidos', 'subtotal', 'tax', 'total'));
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

        // Obtener la fecha actual
        $fecha = now(); // Esto obtiene la fecha y hora actual en formato Carbon

        // Actualizamos en la tabla ventas
        $venta = Venta::all()->last();
        $venta->estado = 'Pagado';
        $venta->save();

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
