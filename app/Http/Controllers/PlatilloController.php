<?php

namespace App\Http\Controllers;

use App\Models\Platillo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PlatilloController extends Controller
{
    public function index()
    {
        $platillos = Platillo::all();
        $categorias = Categoria::all();
        return view('platillos.index', compact ('platillos', 'categorias'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('platillos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'estado' => 'nullable|boolean',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $path = null;
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');

            // Crear un nombre único para la imagen
            $imageName = time() . '_' . $file->getClientOriginalName();

            // Guardar la imagen en 'public/imagenes'
            $file->move(public_path('imagenes'), $imageName);

            // Asignar la ruta de la imagen para guardarla en la base de datos
            $path = 'imagenes/' . $imageName;
        }

        Platillo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen' => $path,
            'estado' => $request->estado ?? false,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('platillos.index')->with('success', 'Platillo creado exitosamente.');
    }

    public function verPlatillo(Platillo $platillo)
    {
        $mensajeWhatsapp = "¡Hola! 🌟 Quisiera hacer una consulta sobre el platillo *{$platillo->nombre}*. ¿Podrías darme más información? 🍽️";
        return view('platillos.show', compact('platillo', 'mensajeWhatsapp'));
    }

    public function toggleEstado(Platillo $platillo)
    {
        $platillo->estado = !$platillo->estado;
        $platillo->save();

        return redirect()->back()->with('success', $platillo->estado ? 'El platillo está disponible.' : 'El platillo no está disponible.');
    }

    public function toggleDestacado(Platillo $platillo)
    {
        $destacado = Platillo::where('destacado', true)->first();

        if ($destacado && $platillo->id !== $destacado->id) {
            return redirect()->back()->with('error', 'Ya hay un platillo destacado. Por favor, elimina el destacado actual para continuar.');
        }

        $platillo->destacado = !$platillo->destacado;
        $platillo->save();

        return redirect()->back()->with('success', $platillo->destacado ? 'El platillo ha sido destacado.' : 'El platillo ya no está destacado.');
    }

    public function edit(Platillo $platillo)
    {
        $categorias = Categoria::all();
        return view('platillos.edit', compact('platillo', 'categorias'));
    }

    public function update(Request $request, Platillo $platillo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'estado' => 'nullable|boolean',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $path = $platillo->imagen; // Mantener la imagen actual si no se sube una nueva
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($platillo->imagen && File::exists(public_path($platillo->imagen))) {
                File::delete(public_path($platillo->imagen));
            }

            $file = $request->file('imagen');

            // Crear un nombre único para la imagen
            $imageName = time() . '_' . $file->getClientOriginalName();

            // Guardar la nueva imagen en 'public/imagenes'
            $file->move(public_path('imagenes'), $imageName);

            // Asignar la nueva ruta de la imagen para guardarla en la base de datos
            $path = 'imagenes/' . $imageName;
        }

        $platillo->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen' => $path,
            'estado' => $request->estado ?? false,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('platillos.index')->with('success', 'Platillo actualizado exitosamente.');
    }

    public function destroy(Platillo $platillo)
    {
        if ($platillo->imagen && File::exists(public_path($platillo->imagen))) {
            File::delete(public_path($platillo->imagen));
        }

        $platillo->delete();

        return redirect()->route('platillos.index')->with('success', 'Platillo eliminado exitosamente.');
    }
}
