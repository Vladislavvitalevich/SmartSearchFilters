<?php

namespace App\Filters\Issue\Pipe;

use App\Contracts\Pipelines\Issue\IssuePipe;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Closure;
use Illuminate\Support\Collection;


abstract class BasePipe implements IssuePipe
{
    const CONDITION_IS = 'is';
    const CONDITION_IS_NOT = 'is_not';
    const CONDITION_IN = 'in';
    const CONDITION_NOT_IN = 'not_in';
    const CONDITION_CONTAINS = 'contains';
    const CONDITION_DOESNT_CONTAIN = 'dn_contain';

    /**
     * @param Request $request
     */
    public function __construct(protected Request $request)
    {
        
    }

    /**
     * Get list of available filter values
     * 
     * @return null|Collection
     */
    public static function values(): ?Collection
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    abstract public function filter(Builder $builder, Closure $next): ?Closure;
}