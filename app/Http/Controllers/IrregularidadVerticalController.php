<?php

namespace App\Http\Controllers;

use App\Models\IrregularidadVertical;
use App\Http\Requests\IrregularidadVerticalRequest;
use App\Http\Resources\IrregularidadVerticalResource;

class IrregularidadVerticalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la IrregularidadVerticalPolicy
        $this->authorize('viewAny', IrregularidadVertical::class);

        $irregularidadVertical = IrregularidadVertical::all();

        return IrregularidadVerticalResource::collection($irregularidadVertical)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IrregularidadVerticalRequest $request)
    {
        // Policy: Llama al método 'create' de la IrregularidadVerticalPolicy
        $this->authorize('create', IrregularidadVertical::class);

        $irregularidadVertical = IrregularidadVertical::create($request->validated());

        return IrregularidadVerticalResource::make($irregularidadVertical)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(IrregularidadVertical $irregularidadVertical)
    {
        // Policy: Llama al método 'view' de la IrregularidadVerticalPolicy
        $this->authorize('view', $irregularidadVertical);

        return IrregularidadVerticalResource::make($irregularidadVertical)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IrregularidadVerticalRequest $request, IrregularidadVertical $irregularidadVertical)
    {
        // Policy: Llama al método 'update' de la IrregularidadVerticalPolicy
        $this->authorize('update', $irregularidadVertical);

        $irregularidadVertical->update($request->validated());

        return IrregularidadVerticalResource::make($irregularidadVertical)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IrregularidadVertical $irregularidadVertical)
    {
        // Policy: Llama al método 'delete' de la IrregularidadVerticalPolicy
        $this->authorize('delete', $irregularidadVertical);

        $irregularidadVertical->delete();

        return IrregularidadVerticalResource::make($irregularidadVertical)->response()->setStatusCode(204);
    }
}
