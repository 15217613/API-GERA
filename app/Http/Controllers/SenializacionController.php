<?php

namespace App\Http\Controllers;

use App\Models\Senializacion;
use App\Http\Requests\SenializacionRequest;
use App\Http\Resources\SenializacionResource;

class SenializacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la SenializacionPolicy
        $this->authorize('viewAny', Senializacion::class);

        $senializacion = Senializacion::all();

        return SenializacionResource::collection($senializacion)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SenializacionRequest $request)
    {
        // Policy: Llama al método 'create' de la SenializacionPolicy
        $this->authorize('create', Senializacion::class);

        $senializacion = Senializacion::create($request->validated());

        return SenializacionResource::make($senializacion)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Senializacion $senializacion)
    {
        // Policy: Llama al método 'view' de la SenializacionPolicy
        $this->authorize('view', $senializacion);

        return SenializacionResource::make($senializacion)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SenializacionRequest $request, Senializacion $senializacion)
    {
        // Policy: Llama al método 'update' de la SenializacionPolicy
        $this->authorize('update', $senializacion);

        $senializacion->update($request->validated());

        return SenializacionResource::make($senializacion)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Senializacion $senializacion)
    {
        // Policy: Llama al método 'delete' de la SenializacionPolicy
        $this->authorize('delete', $senializacion);

        $senializacion->delete();

        return SenializacionResource::make($senializacion)->response()->setStatusCode(204);
    }
}
