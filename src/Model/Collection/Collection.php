<?php declare(strict_types = 1);

namespace SupportPal\ApiClient\Model\Collection;

use SupportPal\ApiClient\Model\Model;

class Collection
{
    /**
     * @var int
     */
    private $count;

    /**
     * @var Model[]
     */
    private $models;

    /**
     * Response constructor.
     * @param int $count
     * @param Model[] $models
     */
    public function __construct(int $count, array $models)
    {
        $this->count = $count;
        $this->models = $models;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return Model[]
     */
    public function getModels(): array
    {
        return $this->models;
    }

    /**
     * @param \Closure $closure
     * @return Collection
     */
    public function map(\Closure $closure): Collection
    {
        $value = array_map($closure, $this->getModels());

        return new self($this->getCount(), $value);
    }

    /**
     * @param \Closure $closure
     * @return Collection
     */
    public function filter(\Closure $closure): Collection
    {
        $value = array_filter($this->getModels(), $closure);

        return new self(count($value), $value);
    }
}
