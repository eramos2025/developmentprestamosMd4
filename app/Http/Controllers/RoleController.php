<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view("admin.roles.index", compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.roles.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        /*
        $datos = $request->all();
        return response()->json($datos);
        */
        // Validación
        $request->validate([
            "name"=> "required"
        ]);

        //Cargamos los datos
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        //Redirige con mensaje de exito!!
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Rol guardado correctamente.')
            ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $role = Role::find($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
          $role = Role::find($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /*
        $datos = $request->all();
        return response()->json($datos);
        */

        // Validación
        $request->validate([
            "name"=> "required"
        ]);

        //Cargamos los datos
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        //Redirige con mensaje de exito!!
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Rol Modificado correctamente.')
            ->with('icono', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

         Role::destroy($id);  

        //Redirige con mensaje de exito!!
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Eliminado correctamente.')
            ->with('icono', 'success');

    }
}
