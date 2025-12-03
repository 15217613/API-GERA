<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPresismicaIrregularidadHorizontal;
use App\Http\Requests\EvaluacionPresismicaIrregularidadHorizontalRequest;
use App\Http\Resources\EvaluacionPresismicaIrregularidadHorizontalResource;

class EvaluacionPresismicaIrregularidadHorizontalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EvaluacionPresismicaIrregularidadHorizontalPolicy
        $this->authorize('viewAny', EvaluacionPresismicaIrregularidadHorizontal::class);

        $evaluacionPresismicaIrregularidadHorizontal = EvaluacionPresismicaIrregularidadHorizontal::all();

        return EvaluacionPresismicaIrregularidadHorizontalResource::collection($evaluacionPresismicaIrregularidadHorizontal)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluacionPresismicaIrregularidadHorizontalRequest $request)
    {
        // Policy: Llama al método 'create' de la EvaluacionPresismicaIrregularidadHorizontalPolicy
        $this->authorize('create', EvaluacionPresismicaIrregularidadHorizontal::class);

        $evaluacionPresismicaIrregularidadHorizontal = EvaluacionPresismicaIrregularidadHorizontal::create($request->validated());

        return new EvaluacionPresismicaIrregularidadHorizontalResource($evaluacionPresismicaIrregularidadHorizontal);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPresismicaIrregularidadHorizontal $evaluacion_presismica_ih)
    {
        // Policy: Llama al método 'view' de la EvaluacionPresismicaIrregularidadHorizontalPolicy
        $this->authorize('view', $evaluacion_presismica_ih);

        return new EvaluacionPresismicaIrregularidadHorizontalResource($evaluacion_presismica_ih);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluacionPresismicaIrregularidadHorizontalRequest $request, EvaluacionPresismicaIrregularidadHorizontal $evaluacion_presismica_ih)
    {
        // Policy: Llama al método 'update' de la EvaluacionPresismicaIrregularidadHorizontalPolicy
        $this->authorize('update', $evaluacion_presismica_ih);

        $evaluacion_presismica_ih->update($request->validated());

        return new EvaluacionPresismicaIrregularidadHorizontalResource($evaluacion_presismica_ih);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPresismicaIrregularidadHorizontal $evaluacion_presismica_ih)
    {
        // Policy: Llama al método 'delete' de la EvaluacionPresismicaIrregularidadHorizontalPolicy
        $this->authorize('delete', $evaluacion_presismica_ih);

        $evaluacion_presismica_ih->delete();

        return EvaluacionPresismicaIrregularidadHorizontalResource::make($evaluacion_presismica_ih)->response()->setStatusCode(204);
    }
}
