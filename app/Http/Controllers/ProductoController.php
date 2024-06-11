<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Precio;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::paginate(8);
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoria = Categoria::all();
        return view('productos.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'stock' => 'required',
            'precio' => 'required',
            'imagen' => 'required',
            'categoria_id' => 'required',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        $precios=Precio::all();
        return view('precios.index', ['producto_id' => $producto->id], compact('precios'));
    }


    public function verProducto(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $categoria = Categoria::all();
        return view('productos.edit', compact('producto', 'categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        request()->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'stock' => 'required',
            'precio' => 'required',
            'imagen' => 'required',
            'categoria_id' => 'required',
        ]);

        $producto->update($request->all());
        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}
