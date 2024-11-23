<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Mesa;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salas = Sala::with('mesas')->paginate(9); // Carga las salas con sus mesas (9 por página)
        return view('salas.index', compact('salas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'numero_mesas' => 'required|integer|min:1',
        ]);

        // Crear la sala
        $sala = Sala::create([
            'nombre' => $request->nombre,
            'numero_mesas' => $request->numero_mesas,
        ]);

        // Crear las mesas asociadas
        for ($i = 1; $i <= $request->numero_mesas; $i++) {
            Mesa::create([
                'numero' => $i, // Número de la mesa (secuencial)
                'sala_id' => $sala->id, // Relacionar la mesa con la sala creada
                'estado' => 'disponible', // Estado inicial
            ]);
        }

        // Redirigir a la vista index con una notificación de éxito
        return redirect()->route('salas.index')->with('success', 'Sala y mesas creadas exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Sala $sala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sala $sala)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sala $sala)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sala $sala)
    {
        //
    }
}
