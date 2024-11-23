<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Sala;
use App\Models\Pedido;
use App\Models\Platillo;
use App\Models\Cliente;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    public function indexMesas($salaId)
    {
        $sala = Sala::findOrFail($salaId); // Encuentra la sala correspondiente
        $mesas = $sala->mesas; // Obtén las mesas relacionadas
        return view('mesas.index', compact('sala', 'mesas'));
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
    public function show($mesaId)
    {
        $mesa = Mesa::with('sala')->findOrFail($mesaId);
        $platillos = Platillo::where('estado', 1)->get(); // Solo platillos con estado = 1
        $subcategorias = SubCategoria::where('estado', 1)->get(); // Solo subcategorías activas
        $clientes = Cliente::all();

        return view('mesas.show', compact('mesa', 'platillos', 'subcategorias', 'clientes'));
    }






    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mesa $mesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mesa $mesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mesa $mesa)
    {
        //
    }
}
