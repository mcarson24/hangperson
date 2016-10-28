<form action="{{ action('GameController@create') }}" method="POST">
    <input type="text" id="word" name="word">
    {{ csrf_field() }}
    <button type="submit" id="newGame">New Game</button>
</form>