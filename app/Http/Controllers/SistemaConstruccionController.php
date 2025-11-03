<?php

namespace App\Http\Controllers;

use App\Models\SistemaConstruccion;
use App\Http\Requests\SistemaConstruccionRequest;
use App\Http\Resources\SistemaConstruccionResource;

class SistemaConstruccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la SistemaConstruccionPolicy
        $this->authorize('viewAny', SistemaConstruccion::class);

        $sistemaConstruccion = SistemaConstruccion::all();

        return SistemaConstruccionResource::collection($sistemaConstruccion)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SistemaConstruccionRequest $request)
    {
        // Policy: Llama al método 'create' de la SistemaConstruccionPolicy
        $this->authorize('create', SistemaConstruccion::class);

        $sistemaConstruccion = SistemaConstruccion::create($request->validated());

        return SistemaConstruccionResource::make($sistemaConstruccion)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SistemaConstruccion $sistemaConstruccion)
    {
        // Policy: Llama al método 'view' de la SistemaConstruccionPolicy
        $this->authorize('view', $sistemaConstruccion);

        return SistemaConstruccionResource::make($sistemaConstruccion)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SistemaConstruccionRequest $request, SistemaConstruccion $sistemaConstruccion)
    {
        // Policy: Llama al método 'update' de la SistemaConstruccionPolicy
        $this->authorize('update', $sistemaConstruccion);

        $sistemaConstruccion->update($request->validated());

        return SistemaConstruccionResource::make($sistemaConstruccion)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SistemaConstruccion $sistemaConstruccion)
    {
        // Policy: Llama al método 'delete' de la SistemaConstruccionPolicy
        $this->authorize('delete', $sistemaConstruccion);

        $sistemaConstruccion->delete();

        return SistemaConstruccionResource::make($sistemaConstruccion)->response()->setStatusCode(204);
    }
}
