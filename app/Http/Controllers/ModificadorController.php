<?php

namespace App\Http\Controllers;

use App\Models\Modificador;
use App\Http\Requests\ModificadorRequest;
use App\Http\Resources\ModificadorResource;

class ModificadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la ModificadorPolicy
        $this->authorize('viewAny', Modificador::class);

        $modificador = Modificador::all();

        return ModificadorResource::collection($modificador)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModificadorRequest $request)
    {
        // Policy: Llama al método 'create' de la ModificadorPolicy
        $this->authorize('create', Modificador::class);

        $modificador = Modificador::create($request->validated());

        return ModificadorResource::make($modificador)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Modificador $modificador)
    {
        // Policy: Llama al método 'view' de la ModificadorPolicy
        $this->authorize('view', $modificador);

        return ModificadorResource::make($modificador)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModificadorRequest $request, Modificador $modificador)
    {
        // Policy: Llama al método 'update' de la ModificadorPolicy
        $this->authorize('update', $modificador);

        $modificador->update($request->validated());

        return ModificadorResource::make($modificador)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modificador $modificador)
    {
        // Policy: Llama al método 'delete' de la ModificadorPolicy
        $this->authorize('delete', $modificador);

        $modificador->delete();

        return ModificadorResource::make($modificador)->response()->setStatusCode(204);
    }
}
