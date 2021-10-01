<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function search(Request $request) : View
    {
        return view('index');
    }

    public function index() : View
    {
        return view('index');
    }
}
