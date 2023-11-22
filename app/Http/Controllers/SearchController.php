<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Services\SearchService;

class SearchController extends Controller
{
    public function search(SearchRequest $request, SearchService $searchService)
    {
        $filters = $request->validated();

        $results = $searchService->applyFilters($filters);

        return response()->json($results);
    }
}