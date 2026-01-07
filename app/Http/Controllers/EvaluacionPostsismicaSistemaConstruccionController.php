<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPostsismicaSistemaConstruccion;
use App\Http\Requests\EvaluacionPostsismicaSistemaConstruccionRequest;
use App\Http\Resources\EvaluacionPostsismicaSistemaConstruccionResource;

class EvaluacionPostsismicaSistemaConstruccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EvaluacionPostsismicaSistemaConstruccionPolicy
        $this->authorize('viewAny', EvaluacionPostsismicaSistemaConstruccion::class);

        $evaluacionPostsismicaSistemaConstruccion = EvaluacionPostsismicaSistemaConstruccion::all();

        return EvaluacionPostsismicaSistemaConstruccionResource::collection($evaluacionPostsismicaSistemaConstruccion)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluacionPostsismicaSistemaConstruccionRequest $request)
    {
        // Policy: Llama al método 'create' de la EvaluacionPostsismicaSistemaConstruccionPolicy
        $this->authorize('create', EvaluacionPostsismicaSistemaConstruccion::class);

        $evaluacionPostsismicaSistemaConstruccion = EvaluacionPostsismicaSistemaConstruccion::create($request->validated());

        return EvaluacionPostsismicaSistemaConstruccionResource::make($evaluacionPostsismicaSistemaConstruccion)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPostsismicaSistemaConstruccion $postsismica_sc)
    {
        // Policy: Llama al método 'view' de la EvaluacionPostsismicaSistemaConstruccionPolicy
        $this->authorize('view', $postsismica_sc);

        return EvaluacionPostsismicaSistemaConstruccionResource::make($postsismica_sc)->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluacionPostsismicaSistemaConstruccionRequest $request, EvaluacionPostsismicaSistemaConstruccion $postsismica_sc)
    {
        // Policy: Llama al método 'update' de la EvaluacionPostsismicaSistemaConstruccionPolicy
        $this->authorize('update', $postsismica_sc);

        $postsismica_sc->update($request->validated());

        return EvaluacionPostsismicaSistemaConstruccionResource::make($postsismica_sc)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPostsismicaSistemaConstruccion $postsismica_sc)
    {
        // Policy: Llama al método 'delete' de la EvaluacionPostsismicaSistemaConstruccionPolicy
        $this->authorize('delete', $postsismica_sc);

        $postsismica_sc->delete();

        return EvaluacionPostsismicaSistemaConstruccionResource::make($postsismica_sc)->response()->setStatusCode(204);
    }
}
