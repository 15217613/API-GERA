<?php

namespace App\Http\Controllers;

use App\Models\GradoDanio;
use App\Http\Requests\GradoDanioRequest;
use App\Http\Resources\GradoDanioResource;

class GradoDanioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la GradoDanioPolicy
        $this->authorize('viewAny', GradoDanio::class);

        $gradoDanio = GradoDanio::all();

        return GradoDanioResource::collection($gradoDanio)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradoDanioRequest $request)
    {
        // Policy: Llama al método 'create' de la GradoDanioPolicy
        $this->authorize('create', GradoDanio::class);

        $gradoDanio = GradoDanio::create($request->validated());

        return new GradoDanioResource($gradoDanio);
    }

    /**
     * Display the specified resource.
     */
    public function show(GradoDanio $gradoDanio)
    {
        // Policy: Llama al método 'view' de la GradoDanioPolicy
        $this->authorize('view', $gradoDanio);

        return new GradoDanioResource($gradoDanio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradoDanioRequest $request, GradoDanio $gradoDanio)
    {
        // Policy: Llama al método 'update' de la GradoDanioPolicy
        $this->authorize('update', GradoDanio::class);

        $gradoDanio->update($request->validated());

        return new GradoDanioResource($gradoDanio);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GradoDanio $gradoDanio)
    {
        // Policy: Llama al método 'delete' de la GradoDanioPolicy
        $this->authorize('delete', $gradoDanio);

        $gradoDanio->delete();

        return GradoDanioResource::make($gradoDanio)->response()->setStatusCode(204);
    }
}
