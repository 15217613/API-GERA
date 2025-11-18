<?php

namespace App\Http\Controllers;

use App\Http\Requests\CObservadaDetRequest;
use App\Models\CObservadaDet;
use App\Http\Resources\CObservadaDetResource;

class CObservadaDetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la CObservadaDetPolicy
        $this->authorize('viewAny', CObservadaDet::class);

        $cObservadaDet = CObservadaDet::all();

        return CObservadaDetResource::collection($cObservadaDet)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CObservadaDetRequest $request)
    {
        // Policy: Llama al método 'create' de la CObservadaDetPolicy
        $this->authorize('create', CObservadaDet::class);

        $cObservadaDet = CObservadaDet::create($request->validated());

        return CObservadaDetResource::make($cObservadaDet)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CObservadaDet $cObservadaDet)
    {
        // Policy: Llama al método 'view' de la CObservadaDetPolicy
        $this->authorize('view', $cObservadaDet);

        return CObservadaDetResource::make($cObservadaDet)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CObservadaDetRequest $request, CObservadaDet $cObservadaDet)
    {
        // Policy: Llama al método 'update' de la CObservadaDetPolicy
        $this->authorize('update', CObservadaDet::class);

        $cObservadaDet->update($request->validated());

        return CObservadaDetResource::make($cObservadaDet)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CObservadaDet $cObservadaDet)
    {
        // Policy: Llama al método 'delete' de la CObservadaDetPolicy
        $this->authorize('delete', $cObservadaDet);

        $cObservadaDet->delete();

        return CObservadaDetResource::make($cObservadaDet)->response()->setStatusCode(204);
    }
}
