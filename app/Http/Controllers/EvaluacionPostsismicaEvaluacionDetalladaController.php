<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPostsismicaEvaluacionDetallada;
use App\Http\Requests\EvaluacionPostsismicaEvaluacionDetalladaRequest;
use App\Http\Resources\EvaluacionPostsismicaEvaluacionDetalladaResource;

class EvaluacionPostsismicaEvaluacionDetalladaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EvaluacionPostsismicaEvaluacionDetalladaPolicy
        $this->authorize('viewAny', EvaluacionPostsismicaEvaluacionDetallada::class);

        $evaluacionPostsismicaEvaluacionDetallada = EvaluacionPostsismicaEvaluacionDetallada::all();

        return EvaluacionPostsismicaEvaluacionDetalladaResource::collection($evaluacionPostsismicaEvaluacionDetallada)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluacionPostsismicaEvaluacionDetalladaRequest $request)
    {
        // Policy: Llama al método 'create' de la EvaluacionPostsismicaEvaluacionDetalladaPolicy
        $this->authorize('create', EvaluacionPostsismicaEvaluacionDetallada::class);

        $evaluacionPostsismicaEvaluacionDetallada = EvaluacionPostsismicaEvaluacionDetallada::create($request->validated());

        return EvaluacionPostsismicaEvaluacionDetalladaResource::make($evaluacionPostsismicaEvaluacionDetallada)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPostsismicaEvaluacionDetallada $postsismica_ed)
    {
        // Policy: Llama al método 'view' de la EvaluacionPostsismicaEvaluacionDetalladaPolicy
        $this->authorize('view', $postsismica_ed);

        return EvaluacionPostsismicaEvaluacionDetalladaResource::make($postsismica_ed)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluacionPostsismicaEvaluacionDetalladaRequest $request, EvaluacionPostsismicaEvaluacionDetallada $postsismica_ed)
    {
        // Policy: Llama al método 'update' de la EvaluacionPostsismicaEvaluacionDetalladaPolicy
        $this->authorize('update', $postsismica_ed);

        $postsismica_ed->update($request->validated());

        return EvaluacionPostsismicaEvaluacionDetalladaResource::make($postsismica_ed)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPostsismicaEvaluacionDetallada $postsismica_ed)
    {
        // Policy: Llama al método 'delete' de la EvaluacionPostsismicaEvaluacionDetalladaPolicy
        $this->authorize('delete', $postsismica_ed);

        $postsismica_ed->delete();

        return EvaluacionPostsismicaEvaluacionDetalladaResource::make($postsismica_ed)->response()->setStatusCode(204);
    }
}
