<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPostsismicaCondicionObservadaBase;
use App\Http\Requests\EvaluacionPostsismicaCondicionObservadaBaseRequest;
use App\Http\Resources\EvaluacionPostsismicaCondicionObservadaBaseResource;

class EvaluacionPostsismicaCondicionObservadaBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la EvaluacionPostsismicaCondicionObservadaBasePolicy
        $this->authorize('viewAny', EvaluacionPostsismicaCondicionObservadaBase::class);

        $evaluacionPostsismicaCondicionObservadaBase = EvaluacionPostsismicaCondicionObservadaBase::all();

        return EvaluacionPostsismicaCondicionObservadaBaseResource::collection($evaluacionPostsismicaCondicionObservadaBase)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluacionPostsismicaCondicionObservadaBaseRequest $request)
    {
        // Policy: Llama al método 'create' de la EvaluacionPostsismicaCondicionObservadaBasePolicy
        $this->authorize('create', EvaluacionPostsismicaCondicionObservadaBase::class);

        $evaluacionPostsismicaCondicionObservadaBase = EvaluacionPostsismicaCondicionObservadaBase::create($request->validated());

        return new EvaluacionPostsismicaCondicionObservadaBaseResource($evaluacionPostsismicaCondicionObservadaBase);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionPostsismicaCondicionObservadaBase $postsismica_cob)
    {
        // Policy: Llama al método 'view' de la EvaluacionPostsismicaCondicionObservadaBasePolicy
        $this->authorize('view', $postsismica_cob);

        return new EvaluacionPostsismicaCondicionObservadaBaseResource($postsismica_cob);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluacionPostsismicaCondicionObservadaBaseRequest $request, EvaluacionPostsismicaCondicionObservadaBase $postsismica_cob)
    {
        // Policy: Llama al método 'update' de la EvaluacionPostsismicaCondicionObservadaBasePolicy
        $this->authorize('update', $postsismica_cob);

        $postsismica_cob->update($request->validated());

        return new EvaluacionPostsismicaCondicionObservadaBaseResource($postsismica_cob);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluacionPostsismicaCondicionObservadaBase $postsismica_cob)
    {
        // Policy: Llama al método 'delete' de la EvaluacionPostsismicaCondicionObservadaBasePolicy
        $this->authorize('delete', $postsismica_cob);

        $postsismica_cob->delete();

        return EvaluacionPostsismicaCondicionObservadaBaseResource::make($postsismica_cob)->response()->setStatusCode(204);
    }
}
