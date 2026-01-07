<?php

namespace App\Http\Controllers;

use App\Models\EdificacionEvaluacionPresismica;
use App\Http\Requests\EdificacionEvaluacionPresismicaRequest;
use App\Http\Resources\EdificacionEvaluacionPresismicaResource;

class EdificacionEvaluacionPresismicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EdificacionEvaluacionPresismicaPolicy
        $this->authorize('viewAny', EdificacionEvaluacionPresismica::class);

        $edificacionEvaluacionPresismica = EdificacionEvaluacionPresismica::all();

        return EdificacionEvaluacionPresismicaResource::collection($edificacionEvaluacionPresismica)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EdificacionEvaluacionPresismicaRequest $request)
    {
        // Policy: Llama al método 'create' de la EdificacionEvaluacionPresismicaPolicy
        $this->authorize('create', EdificacionEvaluacionPresismica::class);

        $edificacionEvaluacionPresismica = EdificacionEvaluacionPresismica::create($request->validated());

        return new EdificacionEvaluacionPresismicaResource($edificacionEvaluacionPresismica);
    }

    /**
     * Display the specified resource.
     */
    public function show(EdificacionEvaluacionPresismica $edificacion_evaluacion_pre)
    {
        // Policy: Llama al método 'view' de la EdificacionEvaluacionPresismicaPolicy
        $this->authorize('view', $edificacion_evaluacion_pre);

        return new EdificacionEvaluacionPresismicaResource($edificacion_evaluacion_pre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EdificacionEvaluacionPresismicaRequest $request, EdificacionEvaluacionPresismica $edificacion_evaluacion_pre)
    {
        // Policy: Llama al método 'update' de la EdificacionEvaluacionPresismicaPolicy
        $this->authorize('update', $edificacion_evaluacion_pre);

        $edificacion_evaluacion_pre->update($request->validated());

        return new EdificacionEvaluacionPresismicaResource($edificacion_evaluacion_pre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EdificacionEvaluacionPresismica $edificacion_evaluacion_pre)
    {
        // Policy: Llama al método 'delete' de la EdificacionEvaluacionPresismicaPolicy
        $this->authorize('delete', $edificacion_evaluacion_pre);

        $edificacion_evaluacion_pre->delete();

        return EdificacionEvaluacionPresismicaResource::make($edificacion_evaluacion_pre)->response()->setStatusCode(204);
    }
}
