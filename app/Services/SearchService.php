
<?php

namespace App\Services;

use App\Models\Issue;
use Illuminate\Pipeline\Pipeline;

class SearchService
{
    public function applyFilters(array $filters)
    {
        return app(Pipeline::class)
            ->send(Issue::query())
            ->through([
                // \App\Filters\TitleFilter::class,
                // \App\Filters\AssignerFilter::class,
                // \App\Filters\AssigneeFilter::class,
                // Добавьте другие фильтры в соответствии с вашими потребностями
            ])
            ->thenReturn()
            ->get();
    }
}