<?php

namespace App;

use InvalidArgumentException;

class Hangman
{
	protected $word;

	protected $guesses = '';

	protected $wrong_guesses = '';

	protected $valid = true;

	protected $displayWord = '';

	public function __construct($word)
    {
        $this->word = $word;
    }

	/**
	 * Makes a guess.
	 *
	 * @param $letter
	 * @return bool
	 */
	public function guess($letter)
	{
		$letter = strtolower($letter);

		if (!$this->isAValidGuess($letter))
		{
			throw new InvalidArgumentException();
		}

		if ($this->letterHasNotBeenGuessedYet($letter))
		{
			$this->storeValidGuess($letter);
		}
		return false;
	}

	public function word()
    {
        return $this->word;
    }

	public function guesses()
    {
        return $this->guesses;
    }

	public function wrong_guesses()
    {
        return $this->wrong_guesses;
    }

	public function gameStatus()
	{
		if (strpos($this->displayWord, '-') === FALSE)
		{
			return 'win';
		}

		if (strlen($this->wrong_guesses) == 7)
		{
			return 'loss';
		}
		return 'play';
	}

	public function wordWithGuesses()
	{
		$word = str_split($this->word);

		foreach	($word as $letter)
		{
			if (strpos($this->guesses, $letter) !== FALSE)
			{
				$this->displayWord .= $letter;
			}
			else
			{
				$this->displayWord .= '-';
			}
		}

		return $this->displayWord;
	}

	public function valid()
	{
		return $this->valid;
	}

	private function isAValidGuess($letter)
	{
		if (!ctype_alpha($letter))
		{
			return false;
		}
		if (strlen($letter) != 1)
		{
			return false;
		}

		return true;
	}

	private function letterHasNotBeenGuessedYet($letter)
	{
		return ! (preg_match("/{$letter}/", $this->guesses) || preg_match("/{$letter}/", $this->wrong_guesses));
	}

	private function storeValidGuess($letter)
	{
		if (strpos($this->word, $letter) !== false)
		{
			return $this->guesses .= $letter;
		}
		return $this->wrong_guesses .= $letter;
	}
}
