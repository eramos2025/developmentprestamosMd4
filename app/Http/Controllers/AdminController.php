<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AdminController extends Controller
{
    //
    public function index(){

        //return view("admin.index");

        $usuario = Auth::user()->name;
        $total_usuarios = User::count();

         //$usuarios = User::all();

        //return view('home',compact('usuario'));
        return view('admin.index',compact('usuario','total_usuarios'));
    }
}
