<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPresismicaDetalladaModificador;
use App\Http\Requests\EvaluacionPresismicaDetalladaModificadorRequest;
use App\Http\Resources\EvaluacionPresismicaDetalladaModificadorResource;

class EvaluacionPresismicaDetalladaModificadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EvaluacionPresismicaDetalladaModificadorPolicy
        $this->authorize('viewAny', EvaluacionPresismicaDetalladaModificador::class);

        $evaluacionPresismicaDetalladaModificador = EvaluacionPresismicaDetalladaModificador::all();

        return EvaluacionPresismicaDetalladaModificadorResource::collection($evaluacionPresismicaDetalladaModificador)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluacionPresismicaDetalladaModificadorRequest $request)
    {
        // Policy: Llama al método 'create' de la EvaluacionPresismicaDetalladaModificadorPolicy
        $this->authorize('create', EvaluacionPresismicaDetalladaModificador::class);

        $evaluacionPresismicaDetalladaModificador = EvaluacionPresismicaDetalladaModificador::create($request->validated());

        return new EvaluacionPresismicaDetalladaModificadorResource($evaluacionPresismicaDetalladaModificador);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPresismicaDetalladaModificador $presismica_d)
    {
        // Policy: Llama al método 'view' de la EvaluacionPresismicaDetalladaModificadorPolicy
        $this->authorize('view', $presismica_d);

        return new EvaluacionPresismicaDetalladaModificadorResource($presismica_d);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluacionPresismicaDetalladaModificadorRequest $request, EvaluacionPresismicaDetalladaModificador $presismica_d)
    {
        // Policy: Llama al método 'update' de la EvaluacionPresismicaDetalladaModificadorPolicy
        $this->authorize('update', $presismica_d);

        $presismica_d->update($request->validated());

        return new EvaluacionPresismicaDetalladaModificadorResource($presismica_d);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPresismicaDetalladaModificador $presismica_d)
    {
        // Policy: Llama al método 'delete' de la EvaluacionPresismicaDetalladaModificadorPolicy
        $this->authorize('delete', $presismica_d);

        $presismica_d->delete();

        return EvaluacionPresismicaDetalladaModificadorResource::make($presismica_d)->response()->setStatusCode(204);
    }
}
