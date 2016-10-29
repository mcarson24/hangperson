<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ResultsController extends Controller
{
    public function win()
	{
		return view('games.win');
	}

	public function loss()
	{
		return view('games.loss');
	}
}
