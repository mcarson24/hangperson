@extends('layout')

@section('content')

    <h1 id="title">Hangman</h1>

    <form action="{{ action('GameController@create') }}" method="POST">
        {{ csrf_field() }}
        <button type="submit">New Game</button>
    </form>

@endsection