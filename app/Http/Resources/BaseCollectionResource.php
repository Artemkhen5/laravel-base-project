<?php

namespace App\Http\Resources;

use App\DTO\IndexResponseDTO;
use App\Http\IndexParams;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class BaseCollectionResource extends ResourceCollection
{
    private int $offset;
    private int $limit;
    private int $total;
    public function __construct(private IndexParams $params, private IndexResponseDTO $dto)
    {
        parent::__construct($this->dto->getCollection());
        $this->offset = $this->params->getOffset();
        $this->limit = $this->params->getLimit();
        $this->total = $this->dto->getTotal();
    }

    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function withResponse(Request $request, JsonResponse $response)
    {
        return $response->withHeaders([
            'X-Total-Count' => $this->total,
            'X-Offset' => $this->offset,
            'X-Limit' => $this->limit,
        ]);
    }
}
