<?php

namespace App\Http\Controllers;

use App\Models\EPresismicaDetallada;
use App\Http\Requests\EPresismicaDetalladaRequest;
use App\Http\Resources\EPresismicaDetalladaResource;

class EPresismicaDetalladaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EdificacionPolicy
        $this->authorize('viewAny', EPresismicaDetallada::class);

        $edificacion = EPresismicaDetallada::all();

        return EPresismicaDetalladaResource::collection($edificacion)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EPresismicaDetalladaRequest $request)
    {
        // Policy: Llama al método 'create' de la EPresismicaDetalladaPolicy
        $this->authorize('create', EPresismicaDetallada::class);

        // Valida los campos
        $data = $request->validated();

        // Convertir imágenes a binario (base64)
        if ($request->hasFile('croquis')) {
            $croquis = file_get_contents($request->file('croquis')->getRealPath());
            $data['croquis'] = base64_encode($croquis);
        }

        if ($request->hasFile('fotografia')) {
            $fotografia = file_get_contents($request->file('fotografia')->getRealPath());
            $data['fotografia'] = base64_encode($fotografia);
        }

        $ePresismicaDetallada = EPresismicaDetallada::create($data);

        return new EPresismicaDetalladaResource($ePresismicaDetallada);
    }

    /**
     * Display the specified resource.
     */
    public function show(EPresismicaDetallada $ePresismicaDetallada)
    {
        // Policy: Llama al método 'view' de la EPresismicaDetalladaPolicy
        $this->authorize('view', $ePresismicaDetallada);

        return new EPresismicaDetalladaResource($ePresismicaDetallada);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EPresismicaDetalladaRequest $request, EPresismicaDetallada $ePresismicaDetallada)
    {
        // Policy: Llama al método 'update' de la EPresismicaDetalladaPolicy
        $this->authorize('update', $ePresismicaDetallada);

        $data = $request->validated();

        // Convertir imágenes a binario solo si se enviaron nuevas
        if ($request->hasFile('croquis')) {
            $croquis = file_get_contents($request->file('croquis')->getRealPath());
            $data['croquis'] = base64_encode($croquis);
        }

        if ($request->hasFile('fotografia')) {
            $fotografia = file_get_contents($request->file('fotografia')->getRealPath());
            $data['fotografia'] = base64_encode($fotografia);
        }

        $ePresismicaDetallada->update($data);

        return new EPresismicaDetalladaResource($ePresismicaDetallada);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EPresismicaDetallada $ePresismicaDetallada)
    {
        // Policy: Llama al método 'delete' de la EPresismicaDetalladaPolicy
        $this->authorize('delete', $ePresismicaDetallada);

        $ePresismicaDetallada->delete();

        return EPresismicaDetalladaResource::make($ePresismicaDetallada)->response()->setStatusCode(204);
    }
}
