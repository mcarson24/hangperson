<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfGameNotOver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	$game = session('game');

		if ($game->gameStatus() == 'play')
		{
			return back();
		}

        return $next($request);
    }
}
