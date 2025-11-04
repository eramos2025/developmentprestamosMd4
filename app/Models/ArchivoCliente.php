<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ArchivoCliente extends Model
{   //
    use HasFactory;

    protected $table = 'archivo_clientes';

    protected $fillable = [
        'nombre',
        'cliente_id',
        'alias',
        'ruta',
    ];

    public function cliente()
    {  // Establece la relacion
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Accessor para URL pública
    public function getUrlAttribute()
    {
        return Storage::url($this->ruta);
    }

}
