<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Repartidor;
use App\Models\AsignacionPedido;
use Illuminate\Http\Request;

class RepartidorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repartidores = Personal::with('asignaciones')
            ->where('cargo', 'Repartidor')
            ->get();

        return view('repartidores.index', compact('repartidores'));
    }

    public function getPedidoDetalles($id)
    {
        try {
            $pedido = \App\Models\Pedido::with('detalles.platillo', 'user')->findOrFail($id);

            return response()->json([
                'cliente' => $pedido->user->name,
                'direccion' => $pedido->direccion,
                'metodo_pago' => $pedido->MetodoPago,
                'total' => number_format($pedido->detalles->sum('total'), 2),
                'detalles' => $pedido->detalles->map(function ($detalle) {
                    return [
                        'nombre' => $detalle->platillo->nombre ?? 'Platillo desconocido',
                        'cantidad' => $detalle->cantidad,
                        'total' => number_format($detalle->total, 2),
                    ];
                }),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los detalles del pedido.'], 500);
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Repartidor $repartidor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repartidor $repartidor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Repartidor $repartidor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repartidor $repartidor)
    {
        //
    }
}
