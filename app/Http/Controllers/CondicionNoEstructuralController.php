<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondicionNoEstructuralRequest;
use Illuminate\Http\Request;
use App\Models\CondicionNoEstructural;
use App\Http\Resources\CondicionNoEstructuralResource;

class CondicionNoEstructuralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la CondicionNoEstructuralPolicy
        $this->authorize('viewAny', CondicionNoEstructural::class);

        $condicionNoEstructural = CondicionNoEstructural::all();

        return CondicionNoEstructuralResource::collection($condicionNoEstructural)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CondicionNoEstructuralRequest $request)
    {
        // Policy: Llama al método 'create' de la CondicionNoEstructuralPolicy
        $this->authorize('create', CondicionNoEstructural::class);

        $condicionNoEstructural = CondicionNoEstructural::create($request->validated());

        return new CondicionNoEstructuralResource($condicionNoEstructural);
    }

    /**
     * Display the specified resource.
     */
    public function show(CondicionNoEstructural $condicionNoEstructural)
    {
        // Policy: Llama al método 'view' de la CondicionNoEstructuralPolicy
        $this->authorize('view', $condicionNoEstructural);

        return new CondicionNoEstructuralResource($condicionNoEstructural);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CondicionNoEstructuralRequest $request, CondicionNoEstructural $condicionNoEstructural)
    {
        // Policy: Llama al método 'update' de la CondicionNoEstructuralPolicy
        $this->authorize('update', $condicionNoEstructural);

        $condicionNoEstructural->update($request->validated());

        return new CondicionNoEstructuralResource($condicionNoEstructural);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CondicionNoEstructural $condicionNoEstructural)
    {
        // Policy: Llama al método 'delete' de la CondicionNoEstructuralPolicy
        $this->authorize('delete', $condicionNoEstructural);

        $condicionNoEstructural->delete();

        return CondicionNoEstructuralResource::make($condicionNoEstructural)->response()->setStatusCode(204);
    }
}
