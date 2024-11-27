<?php

namespace App\Http\Controllers;

use App\Models\masukan;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        // Fetch data from the orang table
        $requests = masukan::all(); // Or use any other query you need, such as Orang::paginate(10)

        // Pass the data to the view
        return view('requests.index', compact('requests'));
    }

}