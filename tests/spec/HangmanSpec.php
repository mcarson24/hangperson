<?php

namespace spec\App;

use App\Hangman;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HangmanSpec extends ObjectBehavior
{
	private function guessSeveralLetters($letters)
	{
		$letters = str_split($letters);

		foreach ($letters as $letter)
		{
			$this->guess($letter);
		}
	}
    function it_has_the_correct_attributes()
	{
		$this->beConstructedWith('glorp');
		$this->word()->shouldReturn('glorp');
		$this->guesses()->shouldReturn('');
		$this->wrong_guesses()->shouldReturn('');
	}

	function it_changes_the_correct_guess_list_after_a_correct_guess()
	{
		$this->beConstructedWith('garlpy');
		$this->guess('a');

		$this->valid()->shouldReturn(true);
		$this->guesses()->shouldReturn('a');
		$this->wrong_guesses()->shouldReturn('');
	}

	function it_changes_the_wrong_guess_list_after_an_incorrect_guess()
	{
		$this->beConstructedWith('garlpy');
		$this->guess('z');

		$this->valid()->shouldReturn(true);
		$this->guesses()->shouldReturn('');
		$this->wrong_guesses()->shouldReturn('z');
	}

	function it_does_not_change_guess_list_if_the_letter_has_already_been_guessed()
	{
		$this->beConstructedWith('garlpy');
		$this->guessSeveralLetters('aq');
		$this->guess('a');
		$this->guess('q');

		$this->guesses()->shouldReturn('a');
		$this->wrong_guesses()->shouldReturn('q');

		$this->guess('a')->shouldReturn(false);
		$this->guess('q')->shouldReturn(false);
	}

	function it_is_case_insensitive()
	{
		$this->beConstructedWith('garply');
		$this->guess('t');
		$this->guess('T');

		$this->guess('g');
		$this->guess('G');

		$this->guesses()->shouldReturn('g');
		$this->wrong_guesses()->shouldReturn('t');
	}

	function it_handles_empty_guesses()
	{
		$this->beConstructedWith('garply');
		$this->shouldThrow('InvalidArgumentException')->duringGuess('');
	}

	function it_handles_invalid_guesses()
	{
		$this->beConstructedWith('garply');
		$this->shouldThrow('InvalidArgumentException')->duringGuess('%');
	}

	function it_handles_null_guesses()
	{
		$this->beConstructedWith('garply');
		$this->shouldThrow('InvalidArgumentException')->duringGuess(null);
	}

	function it_displays_the_word_with_correct_guesses_bn()
	{
		$this->beConstructedWith('banana');

		$testCases = [
			'bn' => 'b-n-n-',
			'def' => '------',
			'ban' => 'banana',
		];

		$this->guessSeveralLetters('bn');
		$this->wordWithGuesses()->shouldreturn('b-n-n-');
	}

	function it_displays_the_word_with_incorrect_guesses_def()
	{
		$this->beConstructedWith('banana');

		$this->guessSeveralLetters('def');
		$this->wordWithGuesses()->shouldreturn('------');
	}

	function it_displays_the_word_with_correct_guesses_ban()
	{
		$this->beConstructedWith('banana');

		$this->guessSeveralLetters('ban');
		$this->wordWithGuesses()->shouldreturn('banana');
	}

	function it_displays_the_word_with_correct_guesses_a()
	{
		$this->beConstructedWith('banana');

		$this->guess('a');
		$this->guessSeveralLetters('xyz');
		$this->wordWithGuesses()->shouldreturn('-a-a-a');
	}

	function it_shows_the_correct_game_status_on_a_win()
	{
		$this->beConstructedWith('dog');
		$this->guessSeveralLetters('dog');
		$this->wordWithGuesses()->shouldReturn('dog');
		$this->gameStatus()->shouldReturn('win');
	}

	function it_shows_loss_as_the_game_status_after_7_incorrect_guesses()
	{
		$this->beConstructedWith('dog');
		$this->guessSeveralLetters('tuvwxyz');
		$this->wordWithGuesses()->shouldReturn('---');
		$this->gameStatus()->shouldReturn('loss');
	}

	function it_shows_continued_play_as_the_game_status_when_the_game_has_not_been_won_or_lost()
	{
		$this->beConstructedWith('dog');
		$this->guessSeveralLetters('do');
		$this->wordWithGuesses()->shouldReturn('do-');
		$this->gameStatus()->shouldReturn('play');
	}
}
