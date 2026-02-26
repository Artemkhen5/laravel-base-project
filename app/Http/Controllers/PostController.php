<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostIndexRequest;
use App\Http\Resources\PostCollectionResource;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

final class PostController extends Controller
{
    public function __construct(private PostRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PostIndexRequest $request)
    {
        $params = $request->getParams();
        $dto = $this->repository->index($params);
        return new PostCollectionResource($params, $dto);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
