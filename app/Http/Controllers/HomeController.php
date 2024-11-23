<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Platillo;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('principal');
    }

    public function principal()
    {
        $users = User::count();
        $platillos = Platillo::count();
        $pedidos = Pedido::count();

        // Top 3 platillos más vendidos
        $topPlatillos = Pedido::select('platillos.nombre', DB::raw('COUNT(pedidos.platillo_id) as count'))
            ->join('platillos', 'pedidos.platillo_id', '=', 'platillos.id')
            ->groupBy('platillos.nombre')
            ->orderBy('count', 'desc')
            ->limit(3)
            ->get();

        // Total de platillos vendidos
        $totalPlatillos = Pedido::select('platillos.nombre', DB::raw('COUNT(pedidos.platillo_id) as count'))
            ->join('platillos', 'pedidos.platillo_id', '=', 'platillos.id')
            ->groupBy('platillos.nombre')
            ->orderBy('platillos.nombre')
            ->get();

        return view('home', compact('users', 'platillos', 'pedidos', 'topPlatillos', 'totalPlatillos'));
    }
}
