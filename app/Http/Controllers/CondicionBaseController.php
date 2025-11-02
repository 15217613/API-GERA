<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondicionBaseRequest;
use Illuminate\Http\Request;

use App\Models\CondicionBase;
use App\Http\Resources\CondicionBaseResource;

class CondicionBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la CondicionBasePolicy
        $this->authorize('viewAny', CondicionBase::class);

        $condicionBase = CondicionBase::all();

        return CondicionBaseResource::collection($condicionBase)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CondicionBaseRequest $request)
    {
        /// Policy: Llama al método 'create' de la CondicionBasePolicy
        $this->authorize('create', CondicionBase::class);

        $condicionBase = CondicionBase::create($request->validated());

        return new CondicionBaseResource($condicionBase);
    }

    /**
     * Display the specified resource.
     */
    public function show(CondicionBase $condicionBase)
    {
        // Policy: Llama al método 'view' de la CondicionBasePolicy
        $this->authorize('view', $condicionBase);

        return new CondicionBaseResource($condicionBase);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CondicionBaseRequest $request, CondicionBase $condicionBase)
    {
        // Policy: Llama al método 'update' de la CondicionBasePolicy
        $this->authorize('update', $condicionBase);

        $condicionBase->update($request->validated());

        return new CondicionBaseResource($condicionBase);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CondicionBase $condicionBase)
    {
        // Policy: Llama al método 'delete' de la CondicionBasePolicy
        $this->authorize('delete', $condicionBase);

        $condicionBase->delete();

        return CondicionBaseResource::make($condicionBase)->response()->setStatusCode(204);
    }
}
