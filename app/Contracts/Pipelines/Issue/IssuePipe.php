<?php

namespace App\Contracts\Pipelines\Issue;

use Illuminate\Database\Query\Builder;
use Closure;

interface IssuePipe
{
    /**
     * @param Builder $builder
     * @param Closure $next
     * @return null|Closure
     */
    public function filter(Builder $builder, Closure $next): ?Closure;
}