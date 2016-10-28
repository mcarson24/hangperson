<?php

namespace App\Http\Controllers;

use App\Hangman;
use Illuminate\Http\Request;

use App\Http\Requests;

class GameController extends Controller
{
    //  Show game state, allow player to enter guess; may redirect to Win or Lose			GET /show
	//	Display form that can generate `POST /create`										GET /new
	//	Start new game; redirects to Show Game after changing state							POST /create
	//	Process guess; redirects to Show Game after changing state							POST /guess
	//	Show "you win" page with button to start new game									GET /win
	//	Show "you lose" page with button to start new game									GET /lose

	protected $game;

	public function __construct()
	{
		$this->game = new Hangman();
	}

	public function new()
	{
		$game = $this->game;

		return view('games.new', compact('game'));
	}

}
