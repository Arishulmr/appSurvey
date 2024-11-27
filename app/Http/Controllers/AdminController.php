<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function requests()
    {
        return view('request.index');
    }

    public function questionnaire()
    {
        return view('questionnaires.index');
    }

    public function survey()
    {
        return view('survey.index');
    }

    public function category()
    {
        return view('category.index');
    }

    public function variables()
    {
        return view('variables.index');
    }



    public function index()
    {
        return view('/');
    }
}