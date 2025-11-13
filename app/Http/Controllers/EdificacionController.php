<?php

namespace App\Http\Controllers;

use App\Models\Edificacion;
use Illuminate\Http\Request;
use App\Http\Requests\EdificacionRequest;
use App\Http\Resources\EdificacionResource;

class EdificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EdificacionPolicy
        $this->authorize('viewAny', Edificacion::class);

        $edificacion = Edificacion::all();

        return EdificacionResource::collection($edificacion)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EdificacionRequest $request)
    {
        // Policy: Llama al método 'create' de la EdificacionPolicy
        $this->authorize('create', Edificacion::class);

        $edificacion = Edificacion::create($request->validated());

        return new EdificacionResource($edificacion);
    }

    /**
     * Display the specified resource.
     */
    public function show(Edificacion $edificacion)
    {
        // Policy: Llama al método 'view' de la EdificacionPolicy
        $this->authorize('view', $edificacion);

        return new EdificacionResource($edificacion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EdificacionRequest $request, Edificacion $edificacion)
    {
        // Policy: Llama al método 'update' de la EdificacionPolicy
        $this->authorize('update', Edificacion::class);

        $edificacion->update($request->validated());

        return new EdificacionResource($edificacion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Edificacion $edificacion)
    {
        // Policy: Llama al método 'delete' de la EdificacionPolicy
        $this->authorize('delete', $edificacion);

        $edificacion->delete();

        return EdificacionResource::make($edificacion)->response()->setStatusCode(204);
    }
}
