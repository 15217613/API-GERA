<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edificacion extends Model
{
    protected $table = 'edificaciones';

    protected $fillable = [
        'nombre',
        'habitante_contacto',
        'telefono_contacto',
        'email_contacto',
        'area_construccion',
        'niveles_sobre_suelo',
        'niveles_bajo_suelo',
        'direccion_id',
        'ocupacion_id',
    ];

    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }

    public function ocupacion()
    {
        return $this->belongsTo(Ocupacion::class);
    }
}
