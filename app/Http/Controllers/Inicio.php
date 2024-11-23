<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platillo;
use App\Models\Categoria;

class Inicio extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $platillos = Platillo::all(); // Obtener todos los platillos de la base de datos
    $categorias = Categoria::where('estado', true)->with('platillos')->get();
    $platilloDestacado = Platillo::where('destacado', true)->first(); // Obtenemos el platillo destacado

    return view('content.landing.home', compact('categorias', 'platilloDestacado','platillos'));
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
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}

