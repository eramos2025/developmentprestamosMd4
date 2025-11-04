<?php

namespace App\Http\Controllers;

use App\Models\InversionistaArchivo;
use App\Models\InversionistaCuenta;
use App\Models\Inversionista;
use App\Http\Requests\StoreClienteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Log;


class InversionistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $inversionistas = Inversionista::all();
        return view("admin.inversionistas.index", compact('inversionistas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Limpiar archivos temporales de intentos anteriores
        session()->forget('temp_files');
        //
        return view("admin.inversionistas.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validación
        $validated = $request->validate([
            // Datos personales
            'nro_documento' => 'required|string|max:20|unique:inversionistas,nro_documento',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'estado_civil' => 'required|in:S,C,V,D,E,U',
            
            // Contacto
            'telefono' => 'required|numeric|digits_between:7,15',
            'telefono_ref' => 'nullable|numeric|digits_between:7,15',
            'email' => 'required|email|max:150|unique:inversionistas,email',
            
            // Ubicación
            'direccion' => 'required|string|max:255',
            'departamento' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'distrito' => 'nullable|string|max:100',
            
            // Información financiera
            'nro_cuenta_principal' => 'nullable|string|min:10|max:20|regex:/^[0-9]+$/',
            'monto_inversion' => 'nullable|numeric|min:0',
            'comentarios' => 'nullable|string|max:500',
            
            // Archivos
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'archivos' => 'nullable|array|max:10',
            'archivos.*' => 'file|mimes:jpg,jpeg,png,pdf|max:5120',
            
            // Cuentas adicionales
            'nro_cuenta' => 'nullable|array|max:10',
            'nro_cuenta.*' => [
                'nullable',
                'string',
                'min:10',
                'max:20',
                'regex:/^[0-9]+$/',
                'distinct',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value && $value === $request->nro_cuenta_principal) {
                        $fail('La cuenta adicional no puede ser igual a la cuenta principal.');
                    }
                },
            ],
        ], [
            // ✅ UN SOLO ARRAY con TODOS los mensajes personalizados
            
            // Mensajes para cuentas adicionales
            'nro_cuenta.*.min' => 'La cuenta debe tener mínimo 10 dígitos.',
            'nro_cuenta.*.max' => 'La cuenta debe tener máximo 20 dígitos.',
            'nro_cuenta.*.regex' => 'La cuenta solo debe contener números.',
            'nro_cuenta.*.distinct' => 'No puede haber cuentas duplicadas.',
            
            // Mensajes para archivos
            'archivos.max' => 'Puedes subir máximo 10 archivos.',
            'archivos.*.file' => 'Debes subir archivos válidos.',
            'archivos.*.mimes' => 'Solo se permiten archivos JPG, PNG y PDF.',
            'archivos.*.max' => 'Cada archivo no puede superar los 5MB.',
            
            // Mensajes adicionales recomendados
            'foto.image' => 'La foto debe ser una imagen válida.',
            'foto.mimes' => 'La foto debe ser JPG, JPEG o PNG.',
            'foto.max' => 'La foto no puede superar los 2MB.',
            'nro_cuenta_principal.regex' => 'La cuenta principal solo debe contener números.',
        ]);


        DB::beginTransaction();
        try {
            //$inversionista = Inversionista::create($validated);

            // Cargamos los datos del inversionista
            $inversionista = new Inversionista();
            $inversionista->nro_documento = $request->nro_documento;
            $inversionista->nombre = $request->nombre;
            $inversionista->apellido = $request->apellido;
            
            $inversionista->estado_civil = $request->estado_civil;

            $inversionista->email = $request->email;
            $inversionista->telefono = $request->telefono;
            $inversionista->telefono_ref = $request->telefono_ref;

            $inversionista->direccion = $request->direccion;

            $inversionista->departamento = $request->departamento;
            $inversionista->provincia = $request->provincia;
            $inversionista->distrito = $request->distrito;

            $inversionista->nro_cuenta_principal = $request->nro_cuenta_principal;
            $inversionista->monto_inversion = $request->monto_inversion;

            $inversionista->comentarios = $request->comentarios;

            // Guardar inversionista
            $inversionista->save();

            Log::info('📝 Inversionista creado', [
                'inversionista_id' => $inversionista->id,
                'inversionista' => $inversionista->nombre . ' ' . $inversionista->apellido,
            ]);


        // Guardar cuentas adicionales
        $cuentasAddGuardados = 0;

        if ($request->filled('nro_cuenta')) {
            $cuentasAdicionales = array_filter($request->nro_cuenta, function($cuenta) {
                return !empty(trim($cuenta));
            });

            foreach ($cuentasAdicionales as $cuenta) {
                InversionistaCuenta::create([
                    'inversionista_id' => $inversionista->id,
                    'nro_cuenta' => trim($cuenta),
                ]);

                $cuentasAddGuardados++;

                Log::info('📎 Cuenta Adicional Guardada', [
                    'inversionista_id' => $inversionista->id,
                    'nro_cuenta' => trim($cuenta),
                ]);

            }
        }

        // ✅ PROCESAR ARCHIVOS MÚLTIPLES
        $archivosGuardados = 0;
        
        if ($request->hasFile('archivos')) {
            // Crear carpeta específica para este cliente
            $carpetaDestino = 'inversionistas/' . $inversionista->id;
            
            foreach ($request->file('archivos') as $file) {
                if ($file->isValid()) {
                    // Generar nombre único
                    $nombreOriginal = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $nombreArchivo = time() . '_' . uniqid(). '_' . $nombreOriginal . '.' . $extension;
                    
                    // Guardar archivo en storage/app/public/clientes/{id}/
                    $path = $file->storeAs($carpetaDestino, $nombreArchivo, 'public');
                    
                    // Guardar registro en base de datos
                    InversionistaArchivo::create([
                        'inversionista_id' => $inversionista->id,
                        'nombre' => $nombreOriginal,
                        'alias' => $nombreArchivo,
                        'ruta' => $path,
                    ]);
                    
                    $archivosGuardados++;
                    
                    Log::info('📎 Archivo guardado', [
                        'inversionista_id' => $inversionista->id,
                        'archivo' => $nombreOriginal,
                        'ruta' => $path,
                    ]);
                }
            }
        }

        DB::commit();

        // Mensaje de éxito
        $mensaje = 'Inversionista guardado correctamente.';
        if ($archivosGuardados > 0) {
            $mensaje .= " Se guardaron {$archivosGuardados} archivo(s).";
        }

        // Redirige con mensaje de éxito
        return redirect()->route('admin.inversionistas.index')
            ->with('mensaje', $mensaje)
            ->with('icono', 'success');
                
        } catch (\Exception $e) {

        DB::rollBack();
        
        Log::error('❌ Error al crear inversionista', [
            'mensaje' => $e->getMessage(),
            'linea' => $e->getLine(),
        ]);
        
        return redirect()->back()
            ->withInput()
            ->with('mensaje', 'Error al guardar el inversionista: ' . $e->getMessage())
            ->with('icono', 'error');
            
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Cargar inversionista con sus cuentas / archivos relacionados
        $inversionista = Inversionista::with(['cuentas', 'archivos'])->findOrFail($id);
       
        return view('admin.inversionistas.show', compact('inversionista'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Cargar inversionista con sus cuentas / archivos relacionados
        $inversionista = Inversionista::with(['cuentas', 'archivos'])->findOrFail($id);
        return view('admin.inversionistas.edit', compact('inversionista'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $inversionista = Inversionista::findOrFail($id);
    
    // Validación (excluyendo el registro actual para unique)
    $validated = $request->validate([
        // Datos personales
        'nro_documento' => 'required|string|max:20|unique:inversionistas,nro_documento,' . $id,
        'nombre' => 'required|string|max:100',
        'apellido' => 'required|string|max:100',
        'estado_civil' => 'required|in:S,C,V,D,E,U',
        
        // Contacto
        'telefono' => 'required|numeric|digits_between:7,15',
        'telefono_ref' => 'nullable|numeric|digits_between:7,15',
        'email' => 'required|email|max:150|unique:inversionistas,email,' . $id,
        
        // Ubicación
        'direccion' => 'required|string|max:255',
        'departamento' => 'nullable|string|max:100',
        'provincia' => 'nullable|string|max:100',
        'distrito' => 'nullable|string|max:100',
        
        // Información financiera
        'nro_cuenta_principal' => 'nullable|string|min:10|max:20|regex:/^[0-9]+$/',
        'monto_inversion' => 'nullable|numeric|min:0',
        'comentarios' => 'nullable|string|max:500',
        
        // Archivos
        'archivos' => 'nullable|array|max:10',
        'archivos.*' => 'file|mimes:jpg,jpeg,png,pdf|max:5120',
        
        // Cuentas adicionales
        'nro_cuenta' => 'nullable|array|max:10',
        'nro_cuenta.*' => [
            'nullable',
            'string',
            'min:10',
            'max:20',
            'regex:/^[0-9]+$/',
            'distinct',
            function ($attribute, $value, $fail) use ($request) {
                if ($value && $value === $request->nro_cuenta_principal) {
                    $fail('La cuenta adicional no puede ser igual a la cuenta principal.');
                }
            },
        ],
        
        // IDs de cuentas existentes a eliminar
        'cuentas_eliminar' => 'nullable|array',
        'cuentas_eliminar.*' => 'integer|exists:inversionista_cuentas,id',
        
        // IDs de archivos a eliminar
        'archivos_eliminar' => 'nullable|array',
        'archivos_eliminar.*' => 'integer|exists:inversionista_archivos,id',
    ], [
        'nro_cuenta.*.min' => 'La cuenta debe tener mínimo 10 dígitos.',
        'nro_cuenta.*.max' => 'La cuenta debe tener máximo 20 dígitos.',
        'nro_cuenta.*.regex' => 'La cuenta solo debe contener números.',
        'nro_cuenta.*.distinct' => 'No puede haber cuentas duplicadas.',
        'archivos.max' => 'Puedes subir máximo 10 archivos.',
        'archivos.*.mimes' => 'Solo se permiten archivos JPG, PNG y PDF.',
        'archivos.*.max' => 'Cada archivo no puede superar los 5MB.',
    ]);

    DB::beginTransaction();
    
    try {
        // Actualizar datos del inversionista
        $inversionista->update([
            'nro_documento' => $request->nro_documento,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'estado_civil' => $request->estado_civil,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'telefono_ref' => $request->telefono_ref,
            'direccion' => $request->direccion,
            'departamento' => $request->departamento,
            'provincia' => $request->provincia,
            'distrito' => $request->distrito,
            'nro_cuenta_principal' => $request->nro_cuenta_principal,
            'monto_inversion' => $request->monto_inversion,
            'comentarios' => $request->comentarios,
        ]);

        Log::info('📝 Inversionista actualizado', [
            'inversionista_id' => $inversionista->id,
            'nombre' => $inversionista->nombre_completo,
        ]);

        // Eliminar cuentas marcadas para eliminación
        if ($request->filled('cuentas_eliminar')) {
            InversionistaCuenta::whereIn('id', $request->cuentas_eliminar)
                ->where('inversionista_id', $inversionista->id)
                ->delete();
                
            Log::info('🗑️ Cuentas eliminadas', [
                'cantidad' => count($request->cuentas_eliminar),
            ]);
        }

        // Agregar nuevas cuentas adicionales
        $cuentasNuevas = 0;
        if ($request->filled('nro_cuenta')) {
            $cuentasAdicionales = array_filter($request->nro_cuenta, function($cuenta) {
                return !empty(trim($cuenta));
            });

            foreach ($cuentasAdicionales as $cuenta) {
                // Verificar que no exista ya
                $existe = InversionistaCuenta::where('inversionista_id', $inversionista->id)
                    ->where('nro_cuenta', trim($cuenta))
                    ->exists();
                    
                if (!$existe) {
                    InversionistaCuenta::create([
                        'inversionista_id' => $inversionista->id,
                        'nro_cuenta' => trim($cuenta),
                    ]);
                    $cuentasNuevas++;
                }
            }
            
            if ($cuentasNuevas > 0) {
                Log::info('➕ Nuevas cuentas agregadas', [
                    'cantidad' => $cuentasNuevas,
                ]);
            }
        }

        // Eliminar archivos marcados
        if ($request->filled('archivos_eliminar')) {
            $archivosEliminar = InversionistaArchivo::whereIn('id', $request->archivos_eliminar)
                ->where('inversionista_id', $inversionista->id)
                ->get();
                
            foreach ($archivosEliminar as $archivo) {
                // Eliminar archivo físico
                if (Storage::disk('public')->exists($archivo->ruta)) {
                    Storage::disk('public')->delete($archivo->ruta);
                }
                // Eliminar registro
                $archivo->delete();
            }
            
            Log::info('🗑️ Archivos eliminados', [
                'cantidad' => count($archivosEliminar),
            ]);
        }

        // Agregar nuevos archivos
        $archivosNuevos = 0;
        if ($request->hasFile('archivos')) {
            $carpetaDestino = 'inversionistas/' . $inversionista->id;
            
            foreach ($request->file('archivos') as $file) {
                if ($file->isValid()) {
                    $nombreOriginal = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $nombreArchivo = time() . '_' . uniqid() . '_' . $nombreOriginal;
                    
                    $path = $file->storeAs($carpetaDestino, $nombreArchivo, 'public');
                    
                    InversionistaArchivo::create([
                        'inversionista_id' => $inversionista->id,
                        'nombre' => $nombreOriginal,
                        'alias' => $nombreArchivo,
                        'ruta' => $path,
                    ]);
                    
                    $archivosNuevos++;
                }
            }
            
            if ($archivosNuevos > 0) {
                Log::info('📎 Nuevos archivos agregados', [
                    'cantidad' => $archivosNuevos,
                ]);
            }
        }

        DB::commit();

        $mensaje = 'Inversionista actualizado correctamente.';
        if ($cuentasNuevas > 0) {
            $mensaje .= " Se agregaron {$cuentasNuevas} cuenta(s).";
        }
        if ($archivosNuevos > 0) {
            $mensaje .= " Se agregaron {$archivosNuevos} archivo(s).";
        }

        return redirect()
            ->route('admin.inversionistas.index', $inversionista->id)
            ->with('mensaje', $mensaje)
            ->with('icono', 'success');

    } catch (\Exception $e) {
        DB::rollBack();
        
        Log::error('❌ Error al actualizar inversionista', [
            'mensaje' => $e->getMessage(),
            'linea' => $e->getLine(),
        ]);
        
        return redirect()
            ->back()
            ->withInput()
            ->with('mensaje', 'Error al actualizar: ' . $e->getMessage())
            ->with('icono', 'error');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $inversionista = Inversionista::findOrFail($id);
        
        DB::beginTransaction();
        
        try {
            // Eliminar archivos físicos
            $archivos = $inversionista->archivos;
            foreach ($archivos as $archivo) {
                if (Storage::disk('public')->exists($archivo->ruta)) {
                    Storage::disk('public')->delete($archivo->ruta);
                }
            }
            
            // Eliminar carpeta completa
            Storage::disk('public')->deleteDirectory('inversionistas/' . $inversionista->id);
            
            // Eliminar registros (cascade se encarga de cuentas y archivos)
            $inversionista->delete();
            
            DB::commit();
            
            Log::info('🗑️ Inversionista eliminado', [
                'inversionista_id' => $id,
            ]);
            
            return redirect()
                ->route('admin.inversionistas.index')
                ->with('mensaje', 'Inversionista eliminado correctamente')
                ->with('icono', 'success');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('❌ Error al eliminar inversionista', [
                'mensaje' => $e->getMessage(),
            ]);
            
            return redirect()
                ->back()
                ->with('mensaje', 'Error al eliminar: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }

}
