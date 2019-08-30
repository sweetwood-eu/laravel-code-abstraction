<?php


namespace SweetwoodEU\Laravel\CodeAbstraction\Abstractions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

abstract class Query
{
    abstract protected function query(): Builder;

    public function __invoke(): Collection
    {
        return $this->run();
    }

    public function run(): Collection
    {
        return $this->query()->get();
    }

    public function count(): int
    {
        return $this->query()->count();
    }

    public function builder(): Builder
    {
        return $this->query();
    }

    public function paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null): LengthAwarePaginator
    {
        return $this->query()->paginate($perPage, $columns, $pageName, $page);
    }
}