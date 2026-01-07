<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPresismica;
use App\Http\Requests\EvaluacionPresismicaRequest;
use App\Http\Resources\EvaluacionPresismicaResource;

class EvaluacionPresismicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EvaluacionPresismicaPolicy
        $this->authorize('viewAny', EvaluacionPresismica::class);

        $evaluacionPresismica = EvaluacionPresismica::all();

        return EvaluacionPresismicaResource::collection($evaluacionPresismica)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluacionPresismicaRequest $request)
    {
        // Policy: Llama al método 'create' de la EvaluacionPresismicaPolicy
        $this->authorize('create', EvaluacionPresismica::class);

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

        $evaluacionPresismica = EvaluacionPresismica::create($data);

        return new EvaluacionPresismicaResource($evaluacionPresismica);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPresismica $evaluacionPresismica)
    {
        // Policy: Llama al método 'view' de la EvaluacionPresismicaPolicy
        $this->authorize('view', $evaluacionPresismica);

        return new EvaluacionPresismicaResource($evaluacionPresismica);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluacionPresismicaRequest $request, EvaluacionPresismica $evaluacionPresismica)
    {
        // Policy: Llama al método 'update' de la EvaluacionPresismicaPolicy
        $this->authorize('update', EvaluacionPresismica::class);

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

        $evaluacionPresismica->update($data);

        return new EvaluacionPresismicaResource($evaluacionPresismica);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPresismica $evaluacionPresismica)
    {
        // Policy: Llama al método 'delete' de la EvaluacionPresismicaPolicy
        $this->authorize('delete', $evaluacionPresismica);

        $evaluacionPresismica->delete();

        return EvaluacionPresismicaResource::make($evaluacionPresismica)->response()->setStatusCode(204);
    }
}
