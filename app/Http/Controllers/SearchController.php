<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Services\SearchService;
use Illuminate\View\View;

class SearchController extends Controller
{
    //search for requested book title with age restricted reviews
    public function search(SearchRequest $request) : View
    {
        $validatedData = $request->validated();
        $searchParams = $validatedData['search'];

        $searchService = new SearchService();
        $statData = $searchService->getStatsData($searchParams['bookTitle'], $searchParams['condition'], $searchParams['propertyValue']);

        return view('search.index', ['statData'=>$statData]);
    }

    public function index() : View
    {
        return view('search.search');
    }

}
