<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VariableController extends Controller
{
    public function index()
    {
        // Fetch data from the orang table
        $variables = variable::all(); // Or use any other query you need, such as Orang::paginate(10)

        // Pass the data to the view
        return view('people.index', compact('people'));
    }

}