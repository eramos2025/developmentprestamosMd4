<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class InversionistaArchivo extends Model
{
    use HasFactory;

    protected $table = 'inversionista_archivos';

    protected $fillable = [
        'nombre',
        'inversionista_id',
        'alias',
        'ruta',
    ];

    public function inversionista()
    {  // Establece la relacion
        return $this->belongsTo(Inversionista::class, 'inversionista_id');
    }

    // Accessor para URL pública
    public function getUrlAttribute()
    {
        return Storage::url($this->ruta);
    }

}
