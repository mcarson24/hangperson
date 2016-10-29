<?php

namespace App\Http\Controllers;

use App\Hangman;
use App\Http\Requests\GuessFormRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class GameController extends Controller {

	//  Show game state, allow player to enter guess; may redirect to Win or Lose			GET /show
	//	Display form that can generate `POST /create`										GET /new
	//	Start new game; redirects to Show Game after changing state							POST /create
	//	Process guess; redirects to Show Game after changing state							POST /guess
	//	Show "you win" page with button to start new game									GET /win
	//	Show "you lose" page with button to start new game									GET /lose

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		return view('games.index');
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function create(Request $request)
	{
		$game = $request->has('word') ? new Hangman($request->get('word')) : new Hangman();

		session(['game' => $game]);

		return redirect('show');
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show()
	{
		$game = session('game');

		return view('games.show', compact('game'));
	}

	/**
	 * @param GuessFormRequest $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function guess(GuessFormRequest $request)
	{
		$game = session('game');

		$letter = $request->get('letter');

		$game->guess($letter);

		if ($game->gameStatus() == 'win')
		{
			return redirect('win');
		}

		if ($game->gameStatus() == 'loss')
		{
			return redirect('loss');
		}

		return view('games.show', compact('game'));
	}
}
