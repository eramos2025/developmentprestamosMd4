<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuarios = User::all();
        return view("admin.usuarios.index", compact('usuarios'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Trae todos los Roles
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        $datos = $request->all();
        return response()->json($datos);
        */

        // Validación
        $request->validate([
            "name"=> "required",
            "email"=> "required|unique:users",
            "password"=> "required|confirmed"
        ]);

        //Cargamos los datos
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        
        $usuario->save();

        $usuario->assignRole($request->rod);

        //Redirige con mensaje de exito!!
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario guardado correctamente.')
            ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Extrae todos los roles
        $roles = Role::all();
        // Extrae todos los datos del usuario
        $usuario = User::find($id);
        // Manda a la vista edición
        return view('admin.usuarios.edit', compact('usuario', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        /*
        $datos = $request->all();
        return response()->json($datos);
        */
        // Validación
        $request->validate([
            "name"=> "required",
            "email"=> "required|unique:users,email,".$id,
            "password"=> "confirmed"
        ]);

        //Cargamos los datos
        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        
        if($request->filled('password')){

        $usuario->password = Hash::make($request->password);

        }
        
        $usuario->save();

        $usuario->syncRoles($request->rod);

        //Redirige con mensaje de exito!!
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario Modificado correctamente.')
            ->with('icono', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
         User::destroy($id);  

        //Redirige con mensaje de exito!!
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Eliminado correctamente.')
            ->with('icono', 'success');
        
    }
}
