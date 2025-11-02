<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SNoEstructural;
use App\Http\Requests\SNoEstructuralRequest;
use App\Http\Resources\SNoEstructuralResource;

class SNoEstructuralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la CondicionBasePolicy
        $this->authorize('viewAny', SNoEstructural::class);

        $condicionBase = SNoEstructural::all();

        return SNoEstructuralResource::collection($condicionBase)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SNoEstructuralRequest $request)
    {
        // Policy: Llama al método 'create' de la SNoEstructuralPolicy
        $this->authorize('create', SNoEstructural::class);

        $condicionBase = SNoEstructural::create($request->validated());

        return SNoEstructuralResource::make($condicionBase)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SNoEstructural $sNoEstructural)
    {
        // Policy: Llama al método 'view' de la SNoEstructuralPolicy
        $this->authorize('view', $sNoEstructural);

        return SNoEstructuralResource::make($sNoEstructural)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SNoEstructuralRequest $request, SNoEstructural $sNoEstructural)
    {
        // Policy: Llama al método 'update' de la SNoEstructuralPolicy
        $this->authorize('update', $sNoEstructural);

        $sNoEstructural->update($request->validated());

        return SNoEstructuralResource::make($sNoEstructural)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SNoEstructural $sNoEstructural)
    {
        // Policy: Llama al método 'delete' de la SNoEstructuralPolicy
        $this->authorize('delete', $sNoEstructural);

        $sNoEstructural->delete();

        return SNoEstructuralResource::make($sNoEstructural)->response()->setStatusCode(204);
    }
}
