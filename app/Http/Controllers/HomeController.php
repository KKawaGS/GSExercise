<?php

namespace App\Http\Controllers;

use App\Http\Services\SearchService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $searchService = new SearchService();
        $statData = $searchService->getStatsData('ZieLoNa MiLa', '>', 30);
        $secStatData = $searchService->getStatsData('ZiElonA Droga', '<', 30);

        usort($secStatData, fn($a, $b) => $b['compatibility'] <=> $a['compatibility']);

        return view('index', compact('statData', 'secStatData'));
    }
}
