<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPresismicaAccionRequerida;
use App\Http\Requests\EvaluacionPresismicaAccionRequeridaRequest;
use App\Http\Resources\EvaluacionPresismicaAccionRequeridaResource;

class EvaluacionPresismicaAccionRequeridaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EvaluacionPresismicaAccionRequeridaPolicy
        $this->authorize('viewAny', EvaluacionPresismicaAccionRequerida::class);

        $evaluacionPresismicaAccionRequerida = EvaluacionPresismicaAccionRequerida::all();

        return EvaluacionPresismicaAccionRequeridaResource::collection($evaluacionPresismicaAccionRequerida)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluacionPresismicaAccionRequeridaRequest $request)
    {
        // Policy: Llama al método 'create' de la EvaluacionPresismicaAccionRequeridaPolicy
        $this->authorize('create', EvaluacionPresismicaAccionRequerida::class);

        $evaluacionPresismicaAccionRequerida = EvaluacionPresismicaAccionRequerida::create($request->validated());

        return EvaluacionPresismicaAccionRequeridaResource::make($evaluacionPresismicaAccionRequerida)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPresismicaAccionRequerida $evaluacion_presismica_ar)
    {
        // Policy: Llama al método 'view' de la EvaluacionPresismicaAccionRequeridaPolicy
        $this->authorize('view', $evaluacion_presismica_ar);

        return EvaluacionPresismicaAccionRequeridaResource::make($evaluacion_presismica_ar)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluacionPresismicaAccionRequeridaRequest $request, EvaluacionPresismicaAccionRequerida $evaluacion_presismica_ar)
    {
        // Policy: Llama al método 'update' de la EvaluacionPresismicaAccionRequeridaPolicy
        $this->authorize('update', $evaluacion_presismica_ar);

        $evaluacion_presismica_ar->update($request->validated());

        return EvaluacionPresismicaAccionRequeridaResource::make($evaluacion_presismica_ar)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPresismicaAccionRequerida $evaluacion_presismica_ar)
    {
        // Policy: Llama al método 'delete' de la EvaluacionPresismicaAccionRequeridaPolicy
        $this->authorize('delete', $evaluacion_presismica_ar);

        $evaluacion_presismica_ar->delete();

        return EvaluacionPresismicaAccionRequeridaResource::make($evaluacion_presismica_ar)->response()->setStatusCode(204);
    }
}
