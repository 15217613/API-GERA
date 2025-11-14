<?php

namespace App\Http\Controllers;

use App\Models\EPostsismicaDetallada;
use App\Http\Requests\EPostsismicaDetalladaRequest;
use App\Http\Resources\EPostsismicaDetalladaResource;

class EPostsismicaDetalladaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EPostsismicaDetalladaPolicy
        $this->authorize('viewAny', EPostsismicaDetallada::class);

        $ePostsismicaDetallada = EPostsismicaDetallada::all();

        return EPostsismicaDetalladaResource::collection($ePostsismicaDetallada)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EPostsismicaDetalladaRequest $request)
    {
        // Policy: Llama al método 'create' de la EPostsismicaDetalladaPolicy
        $this->authorize('create', EPostsismicaDetallada::class);

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

        $ePostsismicaDetallada = EPostsismicaDetallada::create($data);

        return new EPostsismicaDetalladaResource($ePostsismicaDetallada);
    }

    /**
     * Display the specified resource.
     */
    public function show(EPostsismicaDetallada $ePostsismicaDetallada)
    {
        // Policy: Llama al método 'view' de la EPostsismicaDetalladaPolicy
        $this->authorize('view', $ePostsismicaDetallada);

        return new EPostsismicaDetalladaResource($ePostsismicaDetallada);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EPostsismicaDetalladaRequest $request, EPostsismicaDetallada $ePostsismicaDetallada)
    {
        // Policy: Llama al método 'update' de la EPostsismicaDetalladaPolicy
        $this->authorize('update', $ePostsismicaDetallada);

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

        $ePostsismicaDetallada->update($data);

        return new EPostsismicaDetalladaResource($ePostsismicaDetallada);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EPostsismicaDetallada $ePostsismicaDetallada)
    {
        // Policy: Llama al método 'delete' de la EPostsismicaDetalladaPolicy
        $this->authorize('delete', $ePostsismicaDetallada);

        $ePostsismicaDetallada->delete();

        return EPostsismicaDetalladaResource::make($ePostsismicaDetallada)->response()->setStatusCode(204);
    }
}
