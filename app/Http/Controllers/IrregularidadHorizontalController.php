<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IrregularidadHorizontal;
use App\Http\Requests\IrregularidadHorizontalRequest;
use App\Http\Resources\IrregularidadHorizontalResource;

class IrregularidadHorizontalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la IrregularidadHorizontalPolicy
        $this->authorize('viewAny', IrregularidadHorizontal::class);

        $irregularidadHorizontal = IrregularidadHorizontal::all();

        return IrregularidadHorizontalResource::collection($irregularidadHorizontal)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IrregularidadHorizontalRequest $request)
    {
        // Policy: Llama al método 'create' de la PermissionPolicy
        $this->authorize('create', IrregularidadHorizontal::class);

        $irregularidadHorizontal = IrregularidadHorizontal::create($request->validated());

        return IrregularidadHorizontalResource::make($irregularidadHorizontal)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(IrregularidadHorizontal $irregularidadHorizontal)
    {
        // Policy: Llama al método 'view' de la PermissionPolicy
        $this->authorize('view', $irregularidadHorizontal);

        return IrregularidadHorizontalResource::make($irregularidadHorizontal)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IrregularidadHorizontalRequest $request, IrregularidadHorizontal $irregularidadHorizontal)
    {
        // Policy: Llama al método 'update' de la PermissionPolicy
        $this->authorize('update', $irregularidadHorizontal);

        $irregularidadHorizontal->update($request->validated());

        return IrregularidadHorizontalResource::make($irregularidadHorizontal)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IrregularidadHorizontal $irregularidadHorizontal)
    {
        // Policy: Llama al método 'delete' de la PermissionPolicy
        $this->authorize('delete', $irregularidadHorizontal);

        $irregularidadHorizontal->delete();

        return IrregularidadHorizontalResource::make($irregularidadHorizontal)->response()->setStatusCode(204);
    }
}
