<?php

namespace App\Filters\Issue\Pipe;

use App\Filters\Issue\Pipe\BasePipe;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Closure;

class EstimatePipe extends BasePipe
{
    /**
     * The name of the filter variable at the request
     * 
     * @var string
     */
    const NAME = 'story_points';

    /**
     * List of available conditions that might be applied to the values
     * 
     * @var array
     */
    const CONDITIONS = [
        self::CONDITION_IN,
        self::CONDITION_NOT_IN,
        self::CONDITION_IS,
        self::CONDITION_IS_NOT
    ];

    /**
     * @inheritdoc
     */
    public static function values(): ?Collection
    {
        return collect(range(1, 8))
            ->map(function($points){
                return [
                    'id' => $points,
                    'label' => $points.' '.(Str::of('point')->plural($points)->ucfirst()),
                ];
            });
    }

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
            case self::CONDITION_IN:
                $builder->whereIn('story_points', $filter['value']);
                break;

            case self::CONDITION_NOT_IN:
                $builder->whereNotIn('story_points', $filter['value']);
                break;
            
            case self::CONDITION_IS:
                $builder->where('story_points', $filter['value']);
                break;

            case self::CONDITION_IS_NOT:
                $builder->where('story_points', '<>', $filter['value']);
                break;
        }

        return $next($builder);
    }
}