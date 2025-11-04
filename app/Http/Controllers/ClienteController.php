<?php

namespace App\Http\Controllers;


use App\Models\ArchivoCliente;
use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Log;

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
        // Limpiar archivos temporales de intentos anteriores
        session()->forget('temp_files');
        //
        return view("admin.clientes.create");

    }

    public function prueba()
    {
        //
        return view("admin.clientes.old.create");

    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    // Validación
    $request->validate([
        "nro_documento" => "required",
        "nombre" => "required",
        "apellido" => "required",
        "fecha_nacimiento" => "nullable|date",
        "genero" => "nullable",
        "email" => "required|email",
        "telefono" => "required|numeric",
        "telefono_ref" => "nullable|numeric",
        "direccion" => "required",
        "departamento" => "nullable",
        "provincia" => "nullable",
        "distrito" => "nullable",
        "nro_cuenta" => "nullable",
        "ocupacion" => "nullable",
        "ing_mensual" => "nullable|numeric",
        "comentarios" => "nullable",
        "foto" => "nullable|image|mimes:jpg,jpeg,png|max:2048",
        
        // ✅ Validación para múltiples archivos
        "archivos" => "nullable|array|max:10",
        "archivos.*" => "file|mimes:jpg,jpeg,png,pdf|max:5120",
    ], [
        'archivos.max' => 'Puedes subir máximo 10 archivos',
        'archivos.*.mimes' => 'Solo se permiten archivos JPG, PNG y PDF',
        'archivos.*.max' => 'Cada archivo no puede superar los 5MB',
    ]);

    DB::beginTransaction();
    
    try {
        // Cargamos los datos del cliente
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

        $cliente->departamento = $request->departamento;
        $cliente->provincia = $request->provincia;
        $cliente->distrito = $request->distrito;

        $cliente->nro_cuenta = $request->nro_cuenta;
        $cliente->ocupacion = $request->ocupacion;
        $cliente->ing_mensual = $request->ing_mensual;

        $cliente->comentarios = $request->comentarios;
        
        // Procesar foto
        if ($request->hasFile('foto')) {
            // Guardar la imagen subida en storage/app/public/fotos
            $cliente->foto = $request->file('foto')->store('fotos', 'public');
        } else {
            // Usar imagen por defecto (ruta desde public/)
            $cliente->foto = 'images/default-avatar.png';
        }

        // Guardar cliente
        $cliente->save();

        Log::info('📝 Cliente creado', [
            'cliente_id' => $cliente->id,
            'nombre' => $cliente->nombre . ' ' . $cliente->apellido,
        ]);

        // ✅ PROCESAR ARCHIVOS MÚLTIPLES
        $archivosGuardados = 0;
        
        if ($request->hasFile('archivos')) {
            // Crear carpeta específica para este cliente
            $carpetaDestino = 'clientes/' . $cliente->id;
            
            foreach ($request->file('archivos') as $file) {
                if ($file->isValid()) {
                    // Generar nombre único
                    $nombreOriginal = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $nombreArchivo = time() . '_' . uniqid(). '_' . $nombreOriginal . '.' . $extension;
                    
                    // Guardar archivo en storage/app/public/clientes/{id}/
                    $path = $file->storeAs($carpetaDestino, $nombreArchivo, 'public');
                    
                    // Guardar registro en base de datos
                    ArchivoCliente::create([
                        'cliente_id' => $cliente->id,
                        'nombre' => $nombreOriginal,
                        'alias' => $nombreArchivo,
                        'ruta' => $path,
                    ]);
                    
                    $archivosGuardados++;
                    
                    Log::info('📎 Archivo guardado', [
                        'cliente_id' => $cliente->id,
                        'archivo' => $nombreOriginal,
                        'ruta' => $path,
                    ]);
                }
            }
        }

        DB::commit();

        // Mensaje de éxito
        $mensaje = 'Cliente guardado correctamente.';
        if ($archivosGuardados > 0) {
            $mensaje .= " Se guardaron {$archivosGuardados} archivo(s).";
        }

        // Redirige con mensaje de éxito
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', $mensaje)
            ->with('icono', 'success');
            
    } catch (\Exception $e) {
        DB::rollBack();
        
        Log::error('❌ Error al crear cliente', [
            'mensaje' => $e->getMessage(),
            'linea' => $e->getLine(),
        ]);
        
        return redirect()->back()
            ->withInput()
            ->with('mensaje', 'Error al guardar el cliente: ' . $e->getMessage())
            ->with('icono', 'error');
    }
    
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Cargar cliente con sus archivos relacionados
        $cliente = Cliente::with('archivos')->find($id);
        //
        //$cliente = Cliente::find($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Cargar cliente con sus archivos relacionados
        $cliente = Cliente::with('archivos')->find($id);
        //
        //$cliente = Cliente::find($id);
        return view('admin.clientes.edit', compact('cliente'));
    }


/**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    // Validación
    $request->validate([
        "nro_documento" => "required",
        "nombre" => "required",
        "apellido" => "required",
        "email" => "required|email",
        "telefono" => "required|numeric",
        "telefono_ref" => "nullable|numeric",
        "direccion" => "required",
        "departamento" => "nullable",
        "provincia" => "nullable",
        "distrito" => "nullable",
        "ocupacion" => "nullable",
        "ing_mensual" => "nullable|numeric",
        "comentarios" => "nullable",
        "foto" => "nullable|image|mimes:jpg,jpeg,png|max:2048",
        
        // Validación para nuevos archivos
        "archivos" => "nullable|array|max:10",
        "archivos.*" => "file|mimes:jpg,jpeg,png,pdf|max:5120",
    ]);

    DB::beginTransaction();
    
    try {
        // Buscar cliente
        $cliente = Cliente::findOrFail($id);
        
        // Actualizar datos del cliente
        $cliente->nro_documento = $request->nro_documento;
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->telefono_ref = $request->telefono_ref;
        $cliente->direccion = $request->direccion;
        $cliente->departamento = $request->departamento;
        $cliente->provincia = $request->provincia;
        $cliente->distrito = $request->distrito;
        $cliente->ocupacion = $request->ocupacion;
        $cliente->ing_mensual = $request->ing_mensual;
        $cliente->comentarios = $request->comentarios;

        // Actualizar foto si se subió una nueva
        if ($request->hasFile('foto')) {
            // Eliminar foto anterior si existe y no es la default
            if ($cliente->foto && $cliente->foto !== 'images/default-avatar.png' && Storage::disk('public')->exists($cliente->foto)) {
                Storage::disk('public')->delete($cliente->foto);
            }
            // Guardar nueva foto
            $cliente->foto = $request->file('foto')->store('fotos', 'public');
        }

        $cliente->save();

        Log::info('✏️ Cliente actualizado', [
            'cliente_id' => $cliente->id,
            'nombre' => $cliente->nombre . ' ' . $cliente->apellido,
        ]);

        // PROCESAR NUEVOS ARCHIVOS
        $archivosGuardados = 0;
        
        if ($request->hasFile('archivos')) {
            $carpetaDestino = 'clientes/' . $cliente->id;
            
            foreach ($request->file('archivos') as $file) {
                if ($file->isValid()) {
                    $nombreOriginal = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $nombreArchivo = time() . '_' . uniqid() . '.' . $extension;
                    
                    $path = $file->storeAs($carpetaDestino, $nombreArchivo, 'public');
                    
                    ArchivoCliente::create([
                        'cliente_id' => $cliente->id,
                        'nombre' => $nombreOriginal,
                        'alias' => $nombreArchivo,
                        'ruta' => $path,
                    ]);
                    
                    $archivosGuardados++;
                    
                    Log::info('📎 Archivo agregado al cliente', [
                        'cliente_id' => $cliente->id,
                        'archivo' => $nombreOriginal,
                    ]);
                }
            }
        }

        DB::commit();

        $mensaje = 'Cliente modificado correctamente.';
        if ($archivosGuardados > 0) {
            $mensaje .= " Se agregaron {$archivosGuardados} archivo(s) nuevo(s).";
        }

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', $mensaje)
            ->with('icono', 'success');
            
    } catch (\Exception $e) {
        DB::rollBack();
        
        Log::error('❌ Error al actualizar cliente', [
            'cliente_id' => $id,
            'mensaje' => $e->getMessage(),
            'linea' => $e->getLine(),
        ]);
        
        return redirect()->back()
            ->withInput()
            ->with('mensaje', 'Error al actualizar el cliente: ' . $e->getMessage())
            ->with('icono', 'error');
    }
}

/**
 * Eliminar un archivo específico del cliente
 */
public function deleteArchivo($id)
{
    try {
        $archivo = ArchivoCliente::findOrFail($id);
        
        Log::info('🗑️ Eliminando archivo', [
            'archivo_id' => $archivo->id,
            'cliente_id' => $archivo->cliente_id,
            'nombre' => $archivo->nombre,
        ]);
        
        // Eliminar archivo físico
        if (Storage::disk('public')->exists($archivo->ruta)) {
            Storage::disk('public')->delete($archivo->ruta);
        }
        
        // Eliminar registro de BD
        $archivo->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Archivo eliminado correctamente'
        ]);
        
    } catch (\Exception $e) {
        Log::error('❌ Error al eliminar archivo', [
            'archivo_id' => $id,
            'mensaje' => $e->getMessage(),
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Error al eliminar el archivo'
        ], 500);
    }
}


/**
 * Remove the specified resource from storage.
 * (Versión simplificada aprovechando CASCADE de BD)
 */
public function destroy($id)
{
    DB::beginTransaction();
    
    try {
        $cliente = Cliente::with('archivos')->findOrFail($id);
        
        Log::info('🗑️ Eliminando cliente', [
            'cliente_id' => $cliente->id,
            'nombre' => $cliente->nombre . ' ' . $cliente->apellido,
            'archivos_count' => $cliente->archivos->count(),
        ]);
        
        // Eliminar archivos físicos
        foreach ($cliente->archivos as $archivo) {
            if (Storage::disk('public')->exists($archivo->ruta)) {
                Storage::disk('public')->delete($archivo->ruta);
            }
        }
        
        // Eliminar carpeta completa del cliente
        $carpetaCliente = 'clientes/' . $cliente->id;
        if (Storage::disk('public')->exists($carpetaCliente)) {
            Storage::disk('public')->deleteDirectory($carpetaCliente);
        }
        
        // Eliminar foto de perfil
        if ($cliente->foto && $cliente->foto !== 'images/default-avatar.png') {
            if (Storage::disk('public')->exists($cliente->foto)) {
                Storage::disk('public')->delete($cliente->foto);
            }
        }
        
        // Eliminar cliente (cascade eliminará registros de archivo_clientes)
        $cliente->delete();
        
        DB::commit();
        
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente y sus archivos eliminados correctamente.')
            ->with('icono', 'success');
            
    } catch (\Exception $e) {
        DB::rollBack();
        
        Log::error('❌ Error al eliminar cliente', [
            'cliente_id' => $id,
            'mensaje' => $e->getMessage(),
        ]);
        
        return redirect()->back()
            ->with('mensaje', 'Error al eliminar el cliente')
            ->with('icono', 'error');
    }
}    




/*
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
*/

/*

    public function update(Request $request,$id)
    {
  
        // Validación
        $request->validate([

            "nro_documento"=> "required",
            "nombre"=> "required",
            "apellido"=> "required",
            "fecha_nacimiento"=> "nullable|date",
            "genero"=> "nullable",
            "email"=> "required",
            "telefono"=> "required|numeric",
            "telefono_ref"=> "nullable|numeric",
            "direccion"=> "required",
            "departamento"=> "nullable",
            "provincia"=> "nullable",
            "distrito"=> "nullable",
            "nro_cuenta"=> "nullable",
            "ocupacion"=> "nullable",
            "ing_mensual"=> "nullable",
            "comentarios"=> "nullable",
            "foto"=> "nullable",
            "adjuntos"=> "nullable"

        ]);

        //Cargamos los datos  
        $cliente = Cliente::find($id);
        
        //$cliente->foto = $request->file('foto')->store('fotos','public');

        $cliente->nro_documento = $request->nro_documento;
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->fecha_nacimiento = $request->fecha_nacimiento;
        $cliente->genero = $request->genero;

        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->telefono_ref = $request->telefono_ref;

        $cliente->direccion = $request->direccion;

        $cliente->departamento = $request->departamento;
        $cliente->provincia = $request->provincia;
        $cliente->distrito = $request->distrito;

        $cliente->nro_cuenta = $request->nro_cuenta;
        $cliente->ocupacion = $request->ocupacion;
        $cliente->ing_mensual = $request->ing_mensual;

        $cliente->comentarios = $request->comentarios;


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

*/

    /* 
    public function store(Request $request)
    {
 
        $datos = $request->all();
        return response()->json($datos);
  
        // Validación
        $request->validate([
            "nro_documento"=> "required",
            "nombre"=> "required",
            "apellido"=> "required",
            "fecha_nacimiento"=> "nullable|date",
            "genero"=> "nullable",
            "email"=> "required",
            "telefono"=> "required|numeric",
            "telefono_ref"=> "nullable|numeric",
            "direccion"=> "required",
            "departamento"=> "nullable",
            "provincia"=> "nullable",
            "distrito"=> "nullable",
            "nro_cuenta"=> "nullable",
            "ocupacion"=> "nullable",
            "ing_mensual"=> "nullable",
            "comentarios"=> "nullable",
            "foto"=> "nullable",
            "adjuntos"=> "nullable"
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

        $cliente->departamento = $request->departamento;
        $cliente->provincia = $request->provincia;
        $cliente->distrito = $request->distrito;

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
    */


}

