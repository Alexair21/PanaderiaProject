<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::paginate(8);
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        Categoria::create($request->all());
        return redirect()->route('categorias.index')
            ->with('success', 'Categoria creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        request()->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        $categoria->update($request->all());
        return redirect()->route('categorias.index')
            ->with('success', 'Categoria actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')
            ->with('success', 'Categoria eliminada correctamente');
    }
}