<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EPostsismicaDetallada extends Model
{
    protected $table = 'e_postsismicas_detalladas';

    protected $fillable = [
        'croquis',
        'fotografia',
        'version'
    ];

}
