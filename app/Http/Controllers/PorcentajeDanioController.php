<?php

namespace App\Http\Controllers;

use App\Http\Requests\PorcentajeDanioRequest;
use App\Models\PorcentajeDanio;
use App\Http\Resources\PorcentajeDanioResource;

class PorcentajeDanioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la OcupacionPolicy
        $this->authorize('viewAny', PorcentajeDanio::class);

        $porcentajeDanio = PorcentajeDanio::all();

        return PorcentajeDanioResource::collection($porcentajeDanio)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PorcentajeDanioRequest $request)
    {
        // Policy: Llama al método 'create' de la OcupacionPolicy
        $this->authorize('create', PorcentajeDanio::class);

        $porcentajeDanio = PorcentajeDanio::create($request->validated());

        return PorcentajeDanioResource::make($porcentajeDanio)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PorcentajeDanio $porcentajeDanio)
    {
        // Policy: Llama al método 'view' de la OcupacionPolicy
        $this->authorize('view', $porcentajeDanio);

        return PorcentajeDanioResource::make($porcentajeDanio)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PorcentajeDanioRequest $request, PorcentajeDanio $porcentajeDanio)
    {
        // Policy: Llama al método 'update' de la OcupacionPolicy
        $this->authorize('update', $porcentajeDanio);

        $porcentajeDanio->update($request->validated());

        return PorcentajeDanioResource::make($porcentajeDanio)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PorcentajeDanio $porcentajeDanio)
    {
        // Policy: Llama al método 'delete' de la OcupacionPolicy
        $this->authorize('delete', $porcentajeDanio);

        $porcentajeDanio->delete();

        return PorcentajeDanioResource::make($porcentajeDanio)->response()->setStatusCode(204);
    }
}
