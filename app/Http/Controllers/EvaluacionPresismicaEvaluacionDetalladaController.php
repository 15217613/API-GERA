<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPresismicaEvaluacionDetallada;
use App\Http\Requests\EvaluacionPresismicaEvaluacionDetalladaRequest;
use App\Http\Resources\EvaluacionPresismicaEvaluacionDetalladaResource;

class EvaluacionPresismicaEvaluacionDetalladaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EvaluacionPresismicaDetalladaCNoEstructuralPolicy
        $this->authorize('viewAny', EvaluacionPresismicaEvaluacionDetallada::class);

        $evaluacionPresismicaDCNoEstructural = EvaluacionPresismicaEvaluacionDetallada::all();

        return EvaluacionPresismicaEvaluacionDetalladaResource::collection($evaluacionPresismicaDCNoEstructural)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluacionPresismicaEvaluacionDetalladaRequest $request)
    {
        // Policy: Llama al método 'create' de la EvaluacionPresismicaDetalladaCNoEstructuralPolicy
        $this->authorize('create', EvaluacionPresismicaEvaluacionDetallada::class);

        $evaluacionPresismicaDCNoEstructural = EvaluacionPresismicaEvaluacionDetallada::create($request->validated());

        return EvaluacionPresismicaEvaluacionDetalladaResource::make($evaluacionPresismicaDCNoEstructural)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPresismicaEvaluacionDetallada $evaluacion_presismica_ed)
    {
        // Policy: Llama al método 'view' de la EvaluacionPresismicaDetalladaCNoEstructuralPolicy
        $this->authorize('view', $evaluacion_presismica_ed);

        return EvaluacionPresismicaEvaluacionDetalladaResource::make($evaluacion_presismica_ed)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluacionPresismicaEvaluacionDetalladaRequest $request, EvaluacionPresismicaEvaluacionDetallada $evaluacion_presismica_ed)
    {
        // Policy: Llama al método 'update' de la EvaluacionPresismicaDetalladaCNoEstructuralPolicy
        $this->authorize('update', $evaluacion_presismica_ed);

        $evaluacion_presismica_ed->update($request->validated());

        return EvaluacionPresismicaEvaluacionDetalladaResource::make($evaluacion_presismica_ed)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPresismicaEvaluacionDetallada $evaluacion_presismica_ed)
    {
        // Policy: Llama al método 'delete' de la EvaluacionPresismicaDetalladaCNoEstructuralPolicy
        $this->authorize('delete', $evaluacion_presismica_ed);

        $evaluacion_presismica_ed->delete();

        return EvaluacionPresismicaEvaluacionDetalladaResource::make($evaluacion_presismica_ed)->response()->setStatusCode(204);
    }
}
