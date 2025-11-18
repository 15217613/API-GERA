<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CObservadaDet extends Model
{
    protected $table = 'c_observadas_det';

    protected $fillable = [
        'grado_danio_id',
        'condicion_detallada_id',
        'comentario',
        'postsismica_detallada_id',
    ];

    public function grado_danio()
    {
        return $this->belongsTo(GradoDanio::class);
    }

    public function condicion_detallada()
    {
        return $this->belongsTo(CondicionDetallada::class);
    }

    public function postsismica_detallada()
    {
        return $this->belongsTo(EPostsismicaDetallada::class);
    }
}
