<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtroRiesgoRequest;
use App\Models\OtroRiesgo;
use App\Http\Resources\OtroRiesgoResource;

class OtroRiesgoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la OcupacionPolicy
        $this->authorize('viewAny', OtroRiesgo::class);

        $otroRiesgo = OtroRiesgo::all();

        return OtroRiesgoResource::collection($otroRiesgo)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OtroRiesgoRequest $request)
    {
        // Policy: Llama al método 'create' de la OcupacionPolicy
        $this->authorize('create', OtroRiesgo::class);

        $otroRiesgo = OtroRiesgo::create($request->validated());

        return OtroRiesgoResource::make($otroRiesgo)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(OtroRiesgo $otroRiesgo)
    {
        // Policy: Llama al método 'view' de la OcupacionPolicy
        $this->authorize('view', $otroRiesgo);

        return OtroRiesgoResource::make($otroRiesgo)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OtroRiesgoRequest $request, OtroRiesgo $otroRiesgo)
    {
        // Policy: Llama al método 'update' de la OcupacionPolicy
        $this->authorize('update', $otroRiesgo);

        $otroRiesgo->update($request->validated());

        return OtroRiesgoResource::make($otroRiesgo)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OtroRiesgo $otroRiesgo)
    {
        // Policy: Llama al método 'delete' de la OcupacionPolicy
        $this->authorize('delete', $otroRiesgo);

        $otroRiesgo->delete();

        return OtroRiesgoResource::make($otroRiesgo)->response()->setStatusCode(204);
    }
}
