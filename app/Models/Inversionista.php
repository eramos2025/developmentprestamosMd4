<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inversionista extends Model
{

    use HasFactory;

    protected $table = 'inversionistas';

    //FALTABA ESTO:
    protected $fillable = [
        'nro_documento',
        'nombre',
        'apellido',
        'estado_civil',
        'email',
        'telefono',
        'telefono_ref',
        'direccion',
        'departamento',
        'provincia',
        'distrito',
        'nro_cuenta_principal',
        'monto_inversion',
        'comentarios',
    ];

    protected $casts = [
        'monto_inversion' => 'decimal:2',
    ];

    // Relación con archivos
    public function archivos()
    {
        return $this->hasMany(InversionistaArchivo::class, 'inversionista_id');
    }

    // Relación con archivos
    public function cuentas()
    {
        return $this->hasMany(InversionistaCuenta::class, 'inversionista_id');
    }


    // Accessor para nombre completo
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }


}
