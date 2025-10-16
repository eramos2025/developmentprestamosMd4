<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = Cliente::all();
        return view("admin.clientes.index", compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.clientes.create");

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
            "nro_documento"=> "required",
            "nombre"=> "required",
            "apellido"=> "required",
            "fecha_nacimiento"=> "required",
            "genero"=> "required",
            "email"=> "required",
            "telefono"=> "required",
            "telefono_ref"=> "required",
            "direccion"=> "required",
            "nro_cuenta"=> "required",
            "ocupacion"=> "required",
            "ing_mensual"=> "required",
            "comentarios"=> "required"
            //"foto"=> "required"
        ]);

        //Cargamos los datos
        $cliente = new Cliente();
        $cliente->nro_documento = $request->nro_documento;
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->fecha_nacimiento = $request->fecha_nacimiento;
        $cliente->genero = $request->genero;

        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->telefono_ref = $request->telefono_ref;

        $cliente->direccion = $request->direccion;

        $cliente->nro_cuenta = $request->nro_cuenta;
        $cliente->ocupacion = $request->ocupacion;
        $cliente->ing_mensual = $request->ing_mensual;

        $cliente->comentarios = $request->comentarios;
        
        
        //$cliente->foto = $request->file('foto')->store('fotos','public');

        if ($request->hasFile('foto')) {
        // Guardar la imagen subida en storage/app/public/fotos
            $cliente->foto = $request->file('foto')->store('fotos', 'public');
        } else {
        // Usar imagen por defecto (ruta desde public/)
            $cliente->foto = 'images/default-avatar.png';
            //$cliente->foto = $request->file('images/default-avatar.png')->store('fotos', 'public');
        }

        $cliente->save();

        //Redirige con mensaje de exito!!
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente guardada correctamente.')
            ->with('icono', 'success');
           
            
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $cliente = Cliente::find($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $cliente = Cliente::find($id);
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
  
        // Validación
        $request->validate([
            "nro_documento"=> "required",
            "nombre"=> "required",
            "apellido"=> "required",
            "fecha_nacimiento"=> "required",
            "genero"=> "required",
            "email"=> "required",
            "telefono"=> "required",
            "telefono_ref"=> "required",
            "direccion"=> "required",
            "nro_cuenta"=> "required",
            "ocupacion"=> "required",
            "ing_mensual"=> "required",
            "comentarios"=> "required"
           // "foto"=> "required"
        ]);

        //Cargamos los datos  
        $cliente = Cliente::find($id);
        $cliente->nro_documento = $request->nro_documento;
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->fecha_nacimiento = $request->fecha_nacimiento;
        $cliente->genero = $request->genero;

        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->telefono_ref = $request->telefono_ref;

        $cliente->direccion = $request->direccion;

        $cliente->nro_cuenta = $request->nro_cuenta;
        $cliente->ocupacion = $request->ocupacion;
        $cliente->ing_mensual = $request->ing_mensual;

        $cliente->comentarios = $request->comentarios;
        
        //$cliente->foto = $request->file('foto')->store('fotos','public');


        if($request->hasFile('foto')){

            // Eliminar logo anterior si existe
                if ($cliente->foto && Storage::disk('public')->exists($cliente->foto)) {
                    Storage::disk('public')->delete($cliente->foto);
                }
            // Guardar nuevo logo
            $path = $request->file('foto')->store('fotos', 'public');
            $cliente->foto = $path;
        }


        $cliente->save();


        //Redirige con mensaje de exito!!
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente Modificado correctamente.')
            ->with('icono', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $cliente = Cliente::find($id);        
        Storage::disk('public')->delete($cliente->foto);

         Cliente::destroy($id);  

        //Redirige con mensaje de exito!!
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Eliminado correctamente.')
            ->with('icono', 'success');


    }
}

