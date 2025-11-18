<?php

namespace App\Http\Controllers;

use App\Models\CObservadaBase;
use App\Http\Requests\CObservadaBaseRequest;
use App\Http\Resources\CObservadaBaseResource;

class CObservadaBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la CObservadaBasePolicy
        $this->authorize('viewAny', CObservadaBase::class);

        $direccion = CObservadaBase::all();

        return CObservadaBaseResource::collection($direccion)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CObservadaBaseRequest $request)
    {
        // Policy: Llama al método 'create' de la CObservadaBasePolicy
        $this->authorize('create', CObservadaBase::class);

        $direccion = CObservadaBase::create($request->validated());

        return CObservadaBaseResource::make($direccion)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CObservadaBase $cObservadaBase)
    {
        // Policy: Llama al método 'view' de la CObservadaBasePolicy
        $this->authorize('view', $cObservadaBase);

        return CObservadaBaseResource::make($cObservadaBase)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CObservadaBaseRequest $request, CObservadaBase $cObservadaBase)
    {
        // Policy: Llama al método 'update' de la CObservadaBasePolicy
        $this->authorize('update', CObservadaBase::class);

        $cObservadaBase->update($request->validated());

        return CObservadaBaseResource::make($cObservadaBase)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CObservadaBase $cObservadaBase)
    {
        // Policy: Llama al método 'delete' de la CObservadaBasePolicy
        $this->authorize('delete', $cObservadaBase);

        $cObservadaBase->delete();

        return CObservadaBaseResource::make($cObservadaBase)->response()->setStatusCode(204);
    }
}
