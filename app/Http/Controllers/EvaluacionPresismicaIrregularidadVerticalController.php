<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPresismicaIrregularidadVertical;
use App\Http\Requests\EvaluacionPresismicaIrregularidadVerticalRequest;
use App\Http\Resources\EvaluacionPresismicaIrregularidadVerticalResource;

class EvaluacionPresismicaIrregularidadVerticalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EvaluacionPresismicaIrregularidadHorizontalPolicy
        $this->authorize('viewAny', EvaluacionPresismicaIrregularidadVertical::class);

        $evaluacionPresismicaIrregularidadVertical = EvaluacionPresismicaIrregularidadVertical::all();

        return EvaluacionPresismicaIrregularidadVerticalResource::collection($evaluacionPresismicaIrregularidadVertical)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluacionPresismicaIrregularidadVerticalRequest $request)
    {
        // Policy: Llama al método 'create' de la EvaluacionPresismicaIrregularidadHorizontalPolicy
        $this->authorize('create', EvaluacionPresismicaIrregularidadVertical::class);

        $evaluacionPresismicaIrregularidadVertical = EvaluacionPresismicaIrregularidadVertical::create($request->validated());

        return new EvaluacionPresismicaIrregularidadVerticalResource($evaluacionPresismicaIrregularidadVertical);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPresismicaIrregularidadVertical $evaluacion_presismica_iv)
    {
        // Policy: Llama al método 'view' de la EvaluacionPresismicaIrregularidadHorizontalPolicy
        $this->authorize('view', $evaluacion_presismica_iv);

        return new EvaluacionPresismicaIrregularidadVerticalResource($evaluacion_presismica_iv);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluacionPresismicaIrregularidadVerticalRequest $request, EvaluacionPresismicaIrregularidadVertical $evaluacion_presismica_iv)
    {
        // Policy: Llama al método 'update' de la EvaluacionPresismicaIrregularidadHorizontalPolicy
        $this->authorize('update', $evaluacion_presismica_iv);

        $evaluacion_presismica_iv->update($request->validated());

        return new EvaluacionPresismicaIrregularidadVerticalResource($evaluacion_presismica_iv);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPresismicaIrregularidadVertical $evaluacion_presismica_iv)
    {
        // Policy: Llama al método 'delete' de la EvaluacionPresismicaIrregularidadHorizontalPolicy
        $this->authorize('delete', $evaluacion_presismica_iv);

        $evaluacion_presismica_iv->delete();

        return EvaluacionPresismicaIrregularidadVerticalResource::make($evaluacion_presismica_iv)->response()->setStatusCode(204);
    }
}
