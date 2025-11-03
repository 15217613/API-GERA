<?php

namespace App\Http\Controllers;

use App\Models\Ocupacion;
use App\Http\Requests\OcupacionRequest;
use App\Http\Resources\OcupacionResource;

class OcupacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la OcupacionPolicy
        $this->authorize('viewAny', Ocupacion::class);

        $ocupacion = Ocupacion::all();

        return OcupacionResource::collection($ocupacion)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OcupacionRequest $request)
    {
        // Policy: Llama al método 'create' de la OcupacionPolicy
        $this->authorize('create', Ocupacion::class);

        $ocupacion = Ocupacion::create($request->validated());

        return OcupacionResource::make($ocupacion)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ocupacion $ocupacion)
    {
        // Policy: Llama al método 'view' de la OcupacionPolicy
        $this->authorize('view', $ocupacion);

        return OcupacionResource::make($ocupacion)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OcupacionRequest $request, Ocupacion $ocupacion)
    {
        // Policy: Llama al método 'update' de la OcupacionPolicy
        $this->authorize('update', $ocupacion);

        $ocupacion->update($request->validated());

        return OcupacionResource::make($ocupacion)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ocupacion $ocupacion)
    {
        // Policy: Llama al método 'delete' de la OcupacionPolicy
        $this->authorize('delete', $ocupacion);

        $ocupacion->delete();

        return OcupacionResource::make($ocupacion)->response()->setStatusCode(204);
    }
}
