<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ResultsController extends Controller
{
	public function __construct()
	{
		$this->middleware('redirectIfGameNotOver');
	}

	public function win()
	{
		$game = session('game');

		return view('games.win', compact('game'));
	}

	public function loss()
	{
		$game = session('game');

		return view('games.loss', compact('game'));
	}
}
