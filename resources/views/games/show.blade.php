@extends('layout')

@section('content')

    <h1>Guess A Letter</h1>

    <h2><span class="word">{{ $game->wordWithGuesses() }}</span></h2>

    <h2><span class="guesses">{{ $game->wrongGuesses() }}</span></h2>

    <h4 class="{{ $message ?? 'hide' }}">You have already guessed that letter.</h4>

    <hr>

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>

    @endif


    <form action="{{ action('GameController@guess') }}" method="POST">
        <input type="text" id="letter" name="letter" autofocus>
        {{ csrf_field() }}
        <button type="submit" id="guessLetter">Guess Letter</button>
    </form>

    @include('games.partials.newGame')

@endsection