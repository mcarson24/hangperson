@extends('layout')

@section('content')

    <h1>New Game</h1>

    <p>{{ $game->word() }}</p>

@endsection