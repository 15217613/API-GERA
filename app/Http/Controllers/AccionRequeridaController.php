<?php

namespace App\Http\Controllers;

use App\Models\AccionRequerida;
use App\Http\Requests\AccionRequeridaRequest;
use App\Http\Resources\AccionRequeridaResource;

class AccionRequeridaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la AccionRequeridaPolicy
        $this->authorize('viewAny', AccionRequerida::class);

        $accionRequerida = AccionRequerida::all();

        return AccionRequeridaResource::collection($accionRequerida)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccionRequeridaRequest $request)
    {
        // Policy: Llama al método 'create' de la AccionRequeridaPolicy
        $this->authorize('create', AccionRequerida::class);

        $accionRequerida = AccionRequerida::create($request->validated());

        return new AccionRequeridaResource($accionRequerida);
    }

    /**
     * Display the specified resource.
     */
    public function show(AccionRequerida $accionRequerida)
    {
        // Policy: Llama al método 'view' de la AccionRequeridaPolicy
        $this->authorize('view', $accionRequerida);

        return new AccionRequeridaResource($accionRequerida);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccionRequeridaRequest $request, AccionRequerida $accionRequerida)
    {
        // Policy: Llama al método 'update' de la AccionRequeridaPolicy
        $this->authorize('update', AccionRequerida::class);

        $accionRequerida->update($request->validated());

        return new AccionRequeridaResource($accionRequerida);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccionRequerida $accionRequerida)
    {
        // Policy: Llama al método 'delete' de la AccionRequeridaPolicy
        $this->authorize('delete', $accionRequerida);

        $accionRequerida->delete();

        return AccionRequeridaResource::make($accionRequerida)->response()->setStatusCode(204);
    }
}
