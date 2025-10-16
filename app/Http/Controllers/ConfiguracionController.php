<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //return view("admin.configuraciones.index");
        $configuraciones = Configuracion::all();
        return view("admin.configuraciones.index",compact("configuraciones"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //echo "Formulario de registro de configuración";
        return view("admin.configuraciones.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Recibe los datos del formulario
        /* Prueba de recepción de los datos
        $datos = $request->all();
        return response()->json($datos);
        */
        // Validación
        $request->validate([
            "nombre"=> "required",
            "descripcion"=> "required",
            "direccion"=> "required",
            "telefono"=> "required",
            "email"=> "required",
            "moneda"=> "required",
            "logo"=> "required"
        ]);

        //Cargamos los datos
        $configuracion = new Configuracion();
        $configuracion->nombre = $request->nombre;
        $configuracion->descripcion = $request->descripcion;
        $configuracion->direccion = $request->direccion;
        $configuracion->telefono = $request->telefono;
        $configuracion->email = $request->email;
        $configuracion->web = $request->web;
        $configuracion->moneda = $request->moneda;
        $configuracion->logo = $request->file('logo')->store('logos','public');
        $configuracion->save();


        //Redirige con mensaje de exito!!
        return redirect()->route('admin.configuracion.index')
            ->with('mensaje', 'Configuración guardada correctamente.')
            ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //Boton de Acciones - Ver
        //echo $id;
        $configuracion = Configuracion::find($id);
        return view('admin.configuraciones.show', compact('configuracion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
          $configuracion = Configuracion::find($id);
        return view('admin.configuraciones.edit', compact('configuracion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación
        $request->validate([
            "nombre"=> "required",
            "descripcion"=> "required",
            "direccion"=> "required",
            "telefono"=> "required",
            "email"=> "required",
            "moneda"=> "required"
            //"logo"=> "required"
        ]);

        //Busca los datos y actualiza
        $configuracion = Configuracion::find($id);
        $configuracion->nombre = $request->nombre;
        $configuracion->descripcion = $request->descripcion;
        $configuracion->direccion = $request->direccion;
        $configuracion->telefono = $request->telefono;
        $configuracion->email = $request->email;
        $configuracion->web = $request->web;
        $configuracion->moneda = $request->moneda;

        if($request->hasFile('logo')){
//            // Eliminar el logo anterior si existe
//                Storage::delete('public/'.$configuracion->logo);
//                $configuracion->logo = $request->file('logo')->store('logos','public');

            // Eliminar logo anterior si existe
                if ($configuracion->logo && Storage::disk('public')->exists($configuracion->logo)) {
                    Storage::disk('public')->delete($configuracion->logo);
                }
            // Guardar nuevo logo
            $path = $request->file('logo')->store('logos', 'public');
            $configuracion->logo = $path;
        }

        $configuracion->save();

        //Redirige con mensaje de exito!!
        return redirect()->route('admin.configuracion.index')
            ->with('mensaje', 'Modificado correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //echo $id;
        //Busca los datos
        $configuracion = Configuracion::find($id);        
        Storage::disk('public')->delete($configuracion->logo);

         Configuracion::destroy($id);  

        //Redirige con mensaje de exito!!
        return redirect()->route('admin.configuracion.index')
            ->with('mensaje', 'Eliminado correctamente.')
            ->with('icono', 'success');

    }
}
