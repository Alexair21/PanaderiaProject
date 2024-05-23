<?php

namespace App\Http\Controllers;

use App\Models\Precio;
use Illuminate\Http\Request;

class PrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $precios = Precio::paginate(8);
        return view('precios.index', compact('precios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $producto_id = $request->producto_id;
        return view('precios.create', compact('producto_id'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'producto_id' => 'required',
        ]);

        $precio = new Precio();
        $precio->nombre = $request->nombre;
        $precio->precio = $request->precio;
        $precio->producto_id = $request->producto_id;
        $precio->save();

        $precios = Precio::all();
        return view('precios.index', ['producto_id' => $request->producto_id], compact('precios'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Precio $precio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Precio $precio)
    {
        $precios = Precio::all();
        return view('precios.edit', compact('precios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Precio $precio)
    {
        request()->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'producto_id' => 'required',
        ]);

        $precio->update($request->all());
        return redirect()->route('precios.index')
            ->with('success', 'Precio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Precio $precio)
    {
        $producto_id = $precio->producto_id;
        $precio->delete();

        $precios = Precio::all();
        return view('precios.index', ['producto_id' => $producto_id], compact('precios'));
    }
}
