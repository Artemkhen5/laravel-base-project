<?php

namespace App\Http\Resources;

use App\DTO\IndexResponseDTO;
use App\Http\IndexParams;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollectionResource extends BaseCollectionResource
{
    public $collects = PostResource::class;
}
