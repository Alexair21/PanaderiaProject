<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Venta;
use App\Models\Pedido;
use App\Models\Voucher;


class VoucherController extends Controller
{
    public function generateVoucher($id)
    {
        $voucher = Voucher::findOrFail($id);
        $venta = $voucher->venta;

        if (!$venta) {
            return redirect()->back()->with('error', 'No se encontró ninguna venta para el voucher.');
        }

        $cartItems = Pedido::where('venta_id', $venta->id)->get()->map(function ($pedido) {
            $producto = $pedido->producto;
            return [
                'name' => $producto ? $producto->nombre : 'Producto desconocido',
                'qty' => $pedido->cantidad,
                'price' => $pedido->precio_unitario,
                'options' => ['imagen' => $producto ? $producto->imagen : 'ruta_a_imagen_por_defecto']
            ];
        })->toArray();

        $total = $venta->total;

        // Calcular el IGV y el total con IGV
        $subtotal = $total / 1.18;
        $igv = $subtotal * 0.18;

        $qrCode = base64_encode(QrCode::format('svg')->size(100)->generate('La Gota de Cafe'));

        $data = [
            'cartItems' => $cartItems,
            'total' => $total,
            'qrCode' => $qrCode,
            'venta' => $venta,
            'subtotal' => $subtotal,
            'igv' => $igv,
            'voucher' => $voucher,
            'cliente' => auth()->user()->name
        ];

        $pdf = PDF::loadView('voucher', $data);

        return $pdf->download('voucher.pdf');
    }



    public function index()
    {
        $vouchers = Voucher::all();
        return view('vouchers.index', compact('vouchers'));
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('vouchers.index')->with('success', 'Voucher eliminado correctamente');
    }

    public function verdelivery()
    {
        $vouchers = Voucher::all();
        return view('vouchers.delivery', compact('vouchers'));
    }
}
