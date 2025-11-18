<?php

namespace App\Http\Controllers;

use App\Models\RiesgoNoEstructural;
use App\Http\Requests\RiesgoNoEstructuralRequest;
use App\Http\Resources\RiesgoNoEstructuralResource;

class RiesgoNoEstructuralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la RiesgoNoEstructuralPolicy
        $this->authorize('viewAny', RiesgoNoEstructural::class);

        $riesgoNoEstructural = RiesgoNoEstructural::all();

        return RiesgoNoEstructuralResource::collection($riesgoNoEstructural)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RiesgoNoEstructuralRequest $request)
    {
        // Policy: Llama al método 'create' de la RiesgoNoEstructuralPolicy
        $this->authorize('create', RiesgoNoEstructural::class);

        $riesgoNoEstructural = RiesgoNoEstructural::create($request->validated());

        return RiesgoNoEstructuralResource::make($riesgoNoEstructural)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(RiesgoNoEstructural $riesgoNoEstructural)
    {
        // Policy: Llama al método 'view' de la RiesgoNoEstructuralPolicy
        $this->authorize('view', $riesgoNoEstructural);

        return RiesgoNoEstructuralResource::make($riesgoNoEstructural)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RiesgoNoEstructuralRequest $request, RiesgoNoEstructural $riesgoNoEstructural)
    {
        // Policy: Llama al método 'update' de la RiesgoNoEstructuralPolicy
        $this->authorize('update', RiesgoNoEstructural::class);

        $riesgoNoEstructural->update($request->validated());

        return RiesgoNoEstructuralResource::make($riesgoNoEstructural)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiesgoNoEstructural $riesgoNoEstructural)
    {
        // Policy: Llama al método 'delete' de la RiesgoNoEstructuralPolicy
        $this->authorize('delete', $riesgoNoEstructural);

        $riesgoNoEstructural->delete();

        return RiesgoNoEstructuralResource::make($riesgoNoEstructural)->response()->setStatusCode(204);
    }
}
