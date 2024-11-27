<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        // Fetch data from the orang table
        $surveys = Survey::all(); // Or use any other query you need, such as Orang::paginate(10)

        // Pass the data to the view
        return view('survey.index', compact('surveys'));
    }

}