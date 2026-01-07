<?php

namespace App\Http\Controllers;

use App\Models\EdificacionEvaluacionPostsismica;
use App\Http\Requests\EdificacionEvaluacionPostsismicaRequest;
use App\Http\Resources\EdificacionEvaluacionPostsismicaResource;

class EdificacionEvaluacionPostsismicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EdificacionEvaluacionPostsismicaPolicy
        $this->authorize('viewAny', EdificacionEvaluacionPostsismica::class);

        $edificacionEvaluacionPostsismica = EdificacionEvaluacionPostsismica::all();

        return EdificacionEvaluacionPostsismicaResource::collection($edificacionEvaluacionPostsismica)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EdificacionEvaluacionPostsismicaRequest $request)
    {
        // Policy: Llama al método 'create' de la GradoDanioPolicy
        $this->authorize('create', EdificacionEvaluacionPostsismica::class);

        $edificacionEvaluacionPostsismica = EdificacionEvaluacionPostsismica::create($request->validated());

        return new EdificacionEvaluacionPostsismicaResource($edificacionEvaluacionPostsismica);
    }

    /**
     * Display the specified resource.
     */
    public function show(EdificacionEvaluacionPostsismica $edificacion_evaluacion_post)
    {
        // Policy: Llama al método 'view' de la GradoDanioPolicy
        $this->authorize('view', $edificacion_evaluacion_post);

        return new EdificacionEvaluacionPostsismicaResource($edificacion_evaluacion_post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EdificacionEvaluacionPostsismicaRequest $request, EdificacionEvaluacionPostsismica $edificacion_evaluacion_post)
    {
        // Policy: Llama al método 'update' de la GradoDanioPolicy
        $this->authorize('update', $edificacion_evaluacion_post);

        $edificacion_evaluacion_post->update($request->validated());

        return new EdificacionEvaluacionPostsismicaResource($edificacion_evaluacion_post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EdificacionEvaluacionPostsismica $edificacion_evaluacion_post)
    {
        // Policy: Llama al método 'delete' de la GradoDanioPolicy
        $this->authorize('delete', $edificacion_evaluacion_post);

        $edificacion_evaluacion_post->delete();

        return EdificacionEvaluacionPostsismicaResource::make($edificacion_evaluacion_post)->response()->setStatusCode(204);
    }
}
