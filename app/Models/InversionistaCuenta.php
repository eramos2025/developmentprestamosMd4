<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class InversionistaCuenta extends Model
{
    //
    use HasFactory;

    protected $table = 'inversionista_cuentas';

    protected $fillable = [
        'nro_cuenta',
        'inversionista_id',
    ];

    public function inversionista()
    {  // Establece la relacion
        return $this->belongsTo(Inversionista::class, 'inversionista_id');
    }

}
