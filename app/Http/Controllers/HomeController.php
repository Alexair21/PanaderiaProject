<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Producto;
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
        $clientes = Cliente::count();
        $productos = Producto::count();
        $ventas = Venta::count();
        $ganancias = Venta::sum('total');

        // Top 3 productos más vendidos
        $topProducts = Pedido::select('productos.nombre', DB::raw('count(pedidos.producto_id) as count'))
            ->join('productos', 'pedidos.producto_id', '=', 'productos.id')
            ->groupBy('productos.nombre')
            ->orderBy('count', 'desc')
            ->limit(3)
            ->get();

        // Productos totales vendidos
        $totalProducts = Pedido::select('productos.nombre', DB::raw('count(pedidos.producto_id) as count'))
            ->join('productos', 'pedidos.producto_id', '=', 'productos.id')
            ->groupBy('productos.nombre')
            ->orderBy('productos.nombre')
            ->get();

        return view('home', compact('users', 'clientes', 'productos', 'ventas', 'ganancias', 'topProducts', 'totalProducts'));
    }
}
