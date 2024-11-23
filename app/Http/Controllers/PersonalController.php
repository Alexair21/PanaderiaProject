<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Repartidor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personals = Personal::all();
        return view('personals.index', compact('personals')); // Asegúrate de crear la vista 'personals/index.blade.php'
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personals.create'); // Asegúrate de crear la vista 'personals/create.blade.php'
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email',
            'direccion' => 'required|string|max:255',
            'dni' => 'required|string|max:15|unique:personals,dni',
            'cargo' => 'required|string|max:100',
            'fecha_contrato' => 'required|date',
            'sueldo' => 'required|numeric|min:0',
            'licencia' => 'required|string|max:20',
            'vehiculo' => 'required|string|max:100',
        ]);

        // Crear el usuario primero
        $user = User::create([
            'name' => $validated['nombre'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['dni']), // Contraseña es el DNI
        ]);

        // Crear el personal usando el id del usuario creado
        $personal = Personal::create([
            'nombre' => $validated['nombre'],
            'telefono' => $validated['telefono'],
            'email' => $validated['email'],
            'direccion' => $validated['direccion'],
            'dni' => $validated['dni'],
            'cargo' => $validated['cargo'],
            'fecha_contrato' => $validated['fecha_contrato'],
            'sueldo' => $validated['sueldo'],
            'licencia' =>  $validated['licencia'],
            'vehiculo' =>  $validated['vehiculo'],
            'usuario_id' => $user->id, // Asociamos el id del usuario creado
        ]);

        return redirect()->route('personal.index')->with('success', 'Personal y usuario creados exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Personal $personal)
    {
        return view('personals.show', compact('personal')); // Asegúrate de crear la vista 'personals/show.blade.php'
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personal $personal)
    {
        return view('personals.edit', compact('personal')); // Asegúrate de crear la vista 'personals/edit.blade.php'
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personal $personal)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:personals,email,' . $personal->id,
            'direccion' => 'required|string|max:255',
            'dni' => 'required|string|max:15|unique:personals,dni,' . $personal->id,
            'cargo' => 'required|string|max:100',
            'fecha_contrato' => 'required|date',
            'sueldo' => 'required|numeric|min:0',
            'licencia' => 'nullable|string|max:255', // Validación opcional
            'vehiculo' => 'nullable|string|max:255', // Validación opcional
        ]);

        // Actualizar campos del personal
        $personal->update($validated);

        // Guardar datos adicionales si el cargo es repartidor
        if ($request->cargo === 'repartidor') {
            $personal->licencia = $request->licencia;
            $personal->vehiculo = $request->vehiculo;
        } else {
            $personal->licencia = null; // Limpiar campo si no es repartidor
            $personal->vehiculo = null; // Limpiar campo si no es repartidor
        }

        $personal->save();

        return redirect()->route('personals.index')->with('success', 'Personal actualizado exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personal $personal)
    {
        // Eliminar el usuario asociado
        $user = User::find($personal->usuario_id);
        if ($user) {
            $user->delete();
        }

        $personal->delete();

        return redirect()->route('personals.index')->with('success', 'Personal eliminado exitosamente.');
    }
}
