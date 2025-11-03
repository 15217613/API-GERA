<?php

namespace App\Http\Controllers;

use App\Models\TipoConstruccion;
use App\Http\Requests\TipoConstruccionRequest;
use App\Http\Resources\TipoConstruccionResource;

class TipoConstruccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la TipoConstruccionPolicy
        $this->authorize('viewAny', TipoConstruccion::class);

        $tipoConstruccion = TipoConstruccion::all();

        return TipoConstruccionResource::collection($tipoConstruccion)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoConstruccionRequest $request)
    {
        // Policy: Llama al método 'create' de la TipoConstruccionPolicy
        $this->authorize('create', TipoConstruccion::class);

        $tipoConstruccion = TipoConstruccion::create($request->validated());

        return TipoConstruccionResource::make($tipoConstruccion)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoConstruccion $tipoConstruccion)
    {
        // Policy: Llama al método 'view' de la TipoConstruccionPolicy
        $this->authorize('view', $tipoConstruccion);

        return TipoConstruccionResource::make($tipoConstruccion)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoConstruccionRequest $request, TipoConstruccion $tipoConstruccion)
    {
        // Policy: Llama al método 'update' de la TipoConstruccionPolicy
        $this->authorize('update', $tipoConstruccion);

        $tipoConstruccion->update($request->validated());

        return TipoConstruccionResource::make($tipoConstruccion)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoConstruccion $tipoConstruccion)
    {
        // Policy: Llama al método 'delete' de la TipoConstruccionPolicy
        $this->authorize('delete', $tipoConstruccion);

        $tipoConstruccion->delete();

        return TipoConstruccionResource::make($tipoConstruccion)->response()->setStatusCode(204);
    }
}
