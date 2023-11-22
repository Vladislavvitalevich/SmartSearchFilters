<?php

namespace App\Filters\Issue;

use Illuminate\Pipeline\Pipeline;

class IssuePipeline extends Pipeline
{
    /**
     * The method to call on each pipe.
     *
     * @var string
     */
    protected $method = 'filter';
}