<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        // Validate the search request
        $request->validate([
            'destination' => 'required|string|max:255',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'rooms' => 'required|integer|min:1|max:10',
            'adults' => 'required|integer|min:1|max:20',
            'children' => 'nullable|integer|min:0|max:20'
        ]);

        // Prepare search parameters
        $searchParams = [
            'destination' => $request->destination,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'rooms' => $request->rooms,
            'adults' => $request->adults,
            'children' => $request->children ?? 0
        ];

        // Redirect to search results page with parameters
        return redirect()->route('search.results', $searchParams);
    }
}
