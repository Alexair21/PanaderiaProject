<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-cliente|crear-cliente|editar-cliente|borrar-cliente', ['only' => ['index']]);
        $this->middleware('permission:crear-cliente', ['only' => ['create','store']]);
        $this->middleware('permission:editar-cliente', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-cliente', ['only' => ['destroy']]);
    }

    public function index()
    {
        $clientes = Cliente::paginate(5);
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ]);

        Cliente::create($request->all());
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        // VER
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
       return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        request()->validate([
            'nombre' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ]);

        $cliente->update($request->all());
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente -> delete();
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente');
    }
}
