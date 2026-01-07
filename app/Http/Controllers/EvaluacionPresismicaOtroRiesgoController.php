<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPresismicaOtroRiesgo;
use App\Http\Requests\EvaluacionPresismicaOtroRiesgoRequest;
use App\Http\Resources\EvaluacionPresismicaOtroRiesgoResource;

class EvaluacionPresismicaOtroRiesgoController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Policy: Llama al método 'viewAny' de la EvaluacionPresismicaOtroRiesgoPolicy
        $this->authorize('viewAny', EvaluacionPresismicaOtroRiesgo::class);

        $evaluacionPresismicaOtroRiesgo = EvaluacionPresismicaOtroRiesgo::all();

        return EvaluacionPresismicaOtroRiesgoResource::collection($evaluacionPresismicaOtroRiesgo)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluacionPresismicaOtroRiesgoRequest $request)
    {
        // Policy: Llama al método 'create' de la EvaluacionPresismicaOtroRiesgoPolicy
        $this->authorize('create', EvaluacionPresismicaOtroRiesgo::class);

        $evaluacionPresismicaOtroRiesgo = EvaluacionPresismicaOtroRiesgo::create($request->validated());

        return new EvaluacionPresismicaOtroRiesgoResource($evaluacionPresismicaOtroRiesgo);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPresismicaOtroRiesgo $evaluacion_presismica_or)
    {
        // Policy: Llama al método 'view' de la EvaluacionPresismicaOtroRiesgoPolicy
        $this->authorize('view', $evaluacion_presismica_or);

        return new EvaluacionPresismicaOtroRiesgoResource($evaluacion_presismica_or);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluacionPresismicaOtroRiesgoRequest $request, EvaluacionPresismicaOtroRiesgo $evaluacion_presismica_or)
    {
        // Policy: Llama al método 'update' de la EvaluacionPresismicaOtroRiesgoPolicy
        $this->authorize('update', EvaluacionPresismicaOtroRiesgo::class);

        $evaluacion_presismica_or->update($request->validated());

        return new EvaluacionPresismicaOtroRiesgoResource($evaluacion_presismica_or);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPresismicaOtroRiesgo $evaluacion_presismica_or)
    {
        // Policy: Llama al método 'delete' de la EvaluacionPresismicaOtroRiesgoPolicy
        $this->authorize('delete', $evaluacion_presismica_or);

        $evaluacion_presismica_or->delete();

        return EvaluacionPresismicaOtroRiesgoResource::make($evaluacion_presismica_or)->response()->setStatusCode(204);
    }
}
