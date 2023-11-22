<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;
use App\Filters\Issue\IssuePipeline;

class SearchService
{
    /**
     * @var Collection
     */
    protected Collection $filters;

    /**
     * @param Collection $filters
     * @return SearchService
     */
    public function withFilters(Collection $filters): SearchService
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * Filter issues according to requested criteria
     * 
     * @param Builder $builder
     * @return Collection
     */
    public function filter(Builder $builder): Collection
    {
        return app(IssuePipeline::class)
            ->send($builder)
            ->through($this->filters)
            ->then(function(Builder $builder){
                return $builder->paginate(10);
            });
    }
}