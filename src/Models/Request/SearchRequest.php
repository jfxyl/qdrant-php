<?php
/**
 * SearchParams
 *
 * @since     Mar 2023
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Qdrant\Models\Request;

use Qdrant\Models\Filter\Filter;
use Qdrant\Models\Traits\ProtectedPropertyAccessor;
use Qdrant\Models\VectorStructInterface;

class SearchRequest
{
    use ProtectedPropertyAccessor;

    protected ?Filter $filter = null;

    protected array $params = [];

    protected ?int $limit = null;

    protected ?int $offset = null;

    protected $withVector = null;

    protected $withPayload = null;

    protected ?float $scoreThreshold = null;

    protected ?string $name = null;

    protected VectorStructInterface $vector;

    public function __construct(VectorStructInterface $vector)
    {
        $this->vector = $vector;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setFilter(Filter $filter): self
    {
        $this->filter = $filter;

        return $this;
    }

    public function setScoreThreshold(float $scoreThreshold): self
    {
        $this->scoreThreshold = $scoreThreshold;

        return $this;
    }

    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function setOffset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    public function setWithPayload($withPayload): self
    {
        $this->withPayload = $withPayload;

        return $this;
    }

    public function setWithVector($withVector): self
    {
        $this->withVector = $withVector;

        return $this;
    }

    public function toArray(): array
    {
        $body = [
            'vector' => $this->vector->toSearchArray($this->name ?? $this->vector->getName()),
        ];

        if ($this->filter !== null && $this->filter->toArray()) {
            $body['filter'] = $this->filter->toArray();
        }
        if($this->scoreThreshold) {
            $body['score_threshold'] = $this->scoreThreshold;
        }
        if ($this->params) {
            $body['params'] = $this->params;
        }
        if ($this->limit) {
            $body['limit'] = $this->limit;
        }
        if ($this->offset) {
            $body['offset'] = $this->offset;
        }
        if ($this->withVector) {
            $body['with_vector'] = $this->withVector;
        }
        if ($this->withPayload) {
            $body['with_payload'] = $this->withPayload;
        }

        return $body;
    }

}