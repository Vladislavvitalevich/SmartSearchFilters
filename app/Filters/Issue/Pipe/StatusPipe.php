<?php

namespace App\Pipelines\Issue\Pipe;

use App\Filters\Issue\Pipe\BasePipe;
use Illuminate\Database\Query\Builder;
use Closure;
use Illuminate\Support\Collection;

class StatusPipe extends BasePipe
{
    /**
     * The name of the filter variable at the request
     * 
     * @var string
     */
    const NAME = 'status';

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
        return collect([
            [
                'id' => 'backlog',
                'label' => 'Backlog'
            ],
            [
                'id' => 'todo',
                'label' => 'ToDo'
            ],
            [
                'id' => 'in-progress',
                'label' => 'In Progress'
            ],
            [
                'id' => 'in-testing',
                'label' => 'In Testing'
            ],
            [
                'id' => 'done',
                'label' => 'Done'
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function filter(Builder $builder, Closure $next): ?Closure
    {
        if (! $this->request->filled(self::NAME) ) {
            return $next($builder);
        }

        $filter = $this->request->input(self::NAME);

        switch ($filter['condition']) {
            case self::CONDITION_IN:
                $builder->whereIn('status', $filter['value']);
                break;

            case self::CONDITION_NOT_IN:
                $builder->whereNotIn('status', $filter['value']);
                break;
            
            case self::CONDITION_IS:
                $builder->where('status', $filter['value']);
                break;

            case self::CONDITION_IS_NOT:
                $builder->where('status', '<>', $filter['value']);
                break;
        }

        return $next($builder);
    }
}