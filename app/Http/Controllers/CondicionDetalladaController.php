<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondicionDetalladaRequest;
use Illuminate\Http\Request;

use App\Models\CondicionDetallada;
use App\Http\Resources\CondicionDetalladaResource;

class CondicionDetalladaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la CondicionBasePolicy
        $this->authorize('viewAny', CondicionDetallada::class);

        $condicionBase = CondicionDetallada::all();

        return CondicionDetalladaResource::collection($condicionBase)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CondicionDetalladaRequest $request)
    {
        // Policy: Llama al método 'create' de la CondicionBasePolicy
        $this->authorize('create', CondicionDetallada::class);

        $condicionDetallada = CondicionDetallada::create($request->validated());

        return new CondicionDetalladaResource($condicionDetallada);
    }

    /**
     * Display the specified resource.
     */
    public function show(CondicionDetallada $condicionDetallada)
    {
        // Policy: Llama al método 'view' de la CondicionBasePolicy
        $this->authorize('view', $condicionDetallada);

        return new CondicionDetalladaResource($condicionDetallada);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CondicionDetalladaRequest $request, CondicionDetallada $condicionDetallada)
    {
        // Policy: Llama al método 'update' de la CondicionBasePolicy
        $this->authorize('update', $condicionDetallada);

        $condicionDetallada->update($request->validated());

        return new CondicionDetalladaResource($condicionDetallada);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CondicionDetallada $condicionDetallada)
    {
        // Policy: Llama al método 'delete' de la CondicionBasePolicy
        $this->authorize('delete', $condicionDetallada);

        $condicionDetallada->delete();

        return CondicionDetalladaResource::make($condicionDetallada)->response()->setStatusCode(204);
    }
}
