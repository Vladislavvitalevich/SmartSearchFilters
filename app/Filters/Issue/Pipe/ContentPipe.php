<?php

namespace App\Filters\Issue\Pipe;

use App\Filters\Issue\Pipe\BasePipe;
use Illuminate\Database\Query\Builder;
use Closure;

class ContentPipe extends BasePipe
{
    /**
     * The name of the filter variable at the request
     * 
     * @var string
     */
    const NAME = 'content';

    /**
     * List of available conditions that might be applied to the values
     * 
     * @var array
     */
    const CONDITIONS = [
        self::CONDITION_CONTAINS,
        self::CONDITION_DOESNT_CONTAIN,
    ];

    /**
     * @inheritdoc
     */
    public function filter(Builder $builder, Closure $next)
    {
        if (! $this->request->filled(self::NAME) ) {
            return $next($builder);
        }

        $filter = $this->request->input(self::NAME);

        info(self::NAME.'-'.json_encode($filter));

        switch ($filter['condition']) {
            case self::CONDITION_CONTAINS:
                $builder->where('description', 'like', '%'.$filter['value'].'%');
                break;

            case self::CONDITION_DOESNT_CONTAIN:
                $builder->where('description', 'not like', '%'.$filter['value'].'%');
                break;
        }

        return $next($builder);
    }
}