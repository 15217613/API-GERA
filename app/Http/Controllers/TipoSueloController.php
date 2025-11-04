<?php

namespace App\Http\Controllers;

use App\Models\TipoSuelo;
use App\Http\Requests\TipoSueloRequest;
use App\Http\Resources\TipoSueloResource;

class TipoSueloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la TipoSueloPolicy
        $this->authorize('viewAny', TipoSuelo::class);

        $tipoSuelo = TipoSuelo::all();

        return TipoSueloResource::collection($tipoSuelo)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoSueloRequest $request)
    {
        // Policy: Llama al método 'create' de la TipoSueloPolicy
        $this->authorize('create', TipoSuelo::class);

        $tipoSuelo = TipoSuelo::create($request->validated());

        return TipoSueloResource::make($tipoSuelo)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoSuelo $tipoSuelo)
    {
        // Policy: Llama al método 'view' de la TipoSueloPolicy
        $this->authorize('view', $tipoSuelo);

        return TipoSueloResource::make($tipoSuelo)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoSueloRequest $request, TipoSuelo $tipoSuelo)
    {
        // Policy: Llama al método 'update' de la TipoSueloPolicy
        $this->authorize('update', $tipoSuelo);

        $tipoSuelo->update($request->validated());

        return TipoSueloResource::make($tipoSuelo)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoSuelo $tipoSuelo)
    {
        // Policy: Llama al método 'delete' de la TipoSueloPolicy
        $this->authorize('delete', $tipoSuelo);

        $tipoSuelo->delete();

        return TipoSueloResource::make($tipoSuelo)->response()->setStatusCode(204);
    }
}
