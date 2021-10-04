<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function search(Request $request) : View
    {
        $validatedData = $request->validate([
            'search' => ['required', 'max:255', 'regex:/^[\w ]{3,}[|][\w ]+[<>]\s*\d+\s*$/']
        ]);

        return view('index');
    }

    public function index() : View
    {
        return view('index');
    }
}
