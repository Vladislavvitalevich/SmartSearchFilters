<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SearchService;
use App\Filters\Issue\Pipe\StatusPipe;
use App\Filters\Issue\Pipe\EstimatePipe;
use App\Filters\Issue\Pipe\ContentPipe;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * @var Collection
     */
    private Collection $filters;

    public function __construct() 
    {
        $this->filters = collect([
            StatusPipe::class,
            EstimatePipe::class,
            ContentPipe::class
        ]); 
    }

    /**
     * @return JsonResponse
     */
    public function getFilters(): JsonResponse
    {   
        $filters = $this->filters
            ->map(function($filter){
                return [
                    'name' => $filter::NAME,
                    'conditions' => $filter::CONDITIONS,
                    'values' => $filter::values()
                ];
            });

        return response()->json($filters);
    }

    /**
     * Search through issues using pipeline by filters
     * 
     * @param SearchService $searchService
     * @param Request $request
     * @return JsonResponse
     */
    public function search(SearchService $searchService, Request $request): JsonResponse
    {
        $issueQueryBuilder = DB::table('issues');

        $issues = $searchService
            ->withFilters($this->filters)
            ->filter($issueQueryBuilder);

        return response()->json($issues);
    }
}