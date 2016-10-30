@extends('layout')

@section('content')

    <h1>You Win!</h1>

    <h2>{{ $game->word() }}</h2>

    @include('games.partials.newGame')

@endsection