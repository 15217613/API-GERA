<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Http\Requests\DireccionRequest;
use App\Http\Resources\DireccionResource;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la DireccionPolicy
        $this->authorize('viewAny', Direccion::class);

        $direccion = Direccion::all();

        return DireccionResource::collection($direccion)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DireccionRequest $request)
    {
        // Policy: Llama al método 'create' de la DireccionPolicy
        $this->authorize('create', Direccion::class);

        $direccion = Direccion::create($request->validated());

        return new DireccionResource($direccion);
    }

    /**
     * Display the specified resource.
     */
    public function show(Direccion $direccion)
    {
        // Policy: Llama al método 'view' de la DireccionPolicy
        $this->authorize('view', $direccion);

        return new DireccionResource($direccion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DireccionRequest $request, Direccion $direccion)
    {
        // Policy: Llama al método 'update' de la DireccionPolicy
        $this->authorize('update', Direccion::class);

        $direccion->update($request->validated());

        return new DireccionResource($direccion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direccion $direccion)
    {
        // Policy: Llama al método 'delete' de la DireccionPolicy
        $this->authorize('delete', $direccion);

        $direccion->delete();

        return DireccionResource::make($direccion)->response()->setStatusCode(204);
    }
}
