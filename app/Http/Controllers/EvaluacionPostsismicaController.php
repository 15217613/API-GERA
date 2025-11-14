<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPostsismica;
use App\Http\Requests\EvaluacionPostsismicaRequest;
use App\Http\Resources\EvaluacionPostsismicaResource;

class EvaluacionPostsismicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la GradoDanioPolicy
        $this->authorize('viewAny', EvaluacionPostsismica::class);

        $evaluacionPostsismica = EvaluacionPostsismica::all();

        return EvaluacionPostsismicaResource::collection($evaluacionPostsismica)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluacionPostsismicaRequest $request)
    {
        // Policy: Llama al método 'create' de la GradoDanioPolicy
        $this->authorize('create', EvaluacionPostsismica::class);

        $evaluacionPostsismica = EvaluacionPostsismica::create($request->validated());

        return new EvaluacionPostsismicaResource($evaluacionPostsismica);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPostsismica $evaluacionPostsismica)
    {
        // Policy: Llama al método 'view' de la GradoDanioPolicy
        $this->authorize('view', $evaluacionPostsismica);

        return new EvaluacionPostsismicaResource($evaluacionPostsismica);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluacionPostsismicaRequest $request, EvaluacionPostsismica $evaluacionPostsismica)
    {
        // Policy: Llama al método 'update' de la GradoDanioPolicy
        $this->authorize('update', EvaluacionPostsismica::class);

        $evaluacionPostsismica->update($request->validated());

        return new EvaluacionPostsismicaResource($evaluacionPostsismica);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPostsismica $evaluacionPostsismica)
    {
        // Policy: Llama al método 'delete' de la GradoDanioPolicy
        $this->authorize('delete', $evaluacionPostsismica);

        $evaluacionPostsismica->delete();

        return EvaluacionPostsismicaResource::make($evaluacionPostsismica)->response()->setStatusCode(204);
    }
}
