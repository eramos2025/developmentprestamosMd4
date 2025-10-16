<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Name;
use App\Models\User;
use App\Models\Cliente;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuario = Auth::user()->name;
        $total_usuarios = User::count();
        $total_clientes = Cliente::count();

         //$usuarios = User::all();

        //return view('home',compact('usuario'));
        return view('admin.index',compact('usuario','total_usuarios','total_clientes'));
    }
}
