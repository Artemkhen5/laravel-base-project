<?php

namespace App\Http;

class IndexParams
{
    public const DEFAULT_RANGE = [0, 99];

    private array|null $range;
    private int|null $limit;
    private int|null $offset;

    public function __construct(
        ?array $range
    )
    {
        $this->range = $range ?? self::DEFAULT_RANGE;

        $start = min($this->range);
        $end = max($this->range);

        $this->offset = $start;
        $this->limit = $end + 1 - $start;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }
}
