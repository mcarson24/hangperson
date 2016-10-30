@extends('layout')

@section('content')

    <h1>Sorry, you lose!</h1>

    <h2>The word was {{ $game->word() }}</h2>

    @include('games.partials.newGame')

@endsection