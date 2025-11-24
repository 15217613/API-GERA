<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPresismicaDetalladaCNoEstructural;
use App\Http\Requests\EvaluacionPresismicaDetalladaCNoEstructuralRequest;
use App\Http\Resources\EvaluacionPresismicaDetalladaCNoEstructuralResource;

class EvaluacionPresismicaDetalladaCNoEstructuralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EvaluacionPresismicaDetalladaCNoEstructuralPolicy
        $this->authorize('viewAny', EvaluacionPresismicaDetalladaCNoEstructural::class);

        $evaluacionPresismicaDCNoEstructural = EvaluacionPresismicaDetalladaCNoEstructural::all();

        return EvaluacionPresismicaDetalladaCNoEstructuralResource::collection($evaluacionPresismicaDCNoEstructural)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluacionPresismicaDetalladaCNoEstructuralRequest $request)
    {
        // Policy: Llama al método 'create' de la EvaluacionPresismicaDetalladaCNoEstructuralPolicy
        $this->authorize('create', EvaluacionPresismicaDetalladaCNoEstructural::class);

        $evaluacionPresismicaDCNoEstructural = EvaluacionPresismicaDetalladaCNoEstructural::create($request->validated());

        return EvaluacionPresismicaDetalladaCNoEstructuralResource::make($evaluacionPresismicaDCNoEstructural)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPresismicaDetalladaCNoEstructural $presismica_ne)
    {
        // Policy: Llama al método 'view' de la EvaluacionPresismicaDetalladaCNoEstructuralPolicy
        $this->authorize('view', $presismica_ne);

        return EvaluacionPresismicaDetalladaCNoEstructuralResource::make($presismica_ne)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluacionPresismicaDetalladaCNoEstructuralRequest $request, EvaluacionPresismicaDetalladaCNoEstructural $presismica_ne)
    {
        // Policy: Llama al método 'update' de la EvaluacionPresismicaDetalladaCNoEstructuralPolicy
        $this->authorize('update', $presismica_ne);

        $presismica_ne->update($request->validated());

        return EvaluacionPresismicaDetalladaCNoEstructuralResource::make($presismica_ne)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPresismicaDetalladaCNoEstructural $presismica_ne)
    {
        // Policy: Llama al método 'delete' de la EvaluacionPresismicaDetalladaCNoEstructuralPolicy
        $this->authorize('delete', $presismica_ne);

        $presismica_ne->delete();

        return EvaluacionPresismicaDetalladaCNoEstructuralResource::make($presismica_ne)->response()->setStatusCode(204);
    }
}
