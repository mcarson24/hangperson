<?php

namespace App;

use InvalidArgumentException;

class Hangman
{
	protected $word;

	protected $guesses = '';

	protected $wrongGuesses = '';

	protected $valid = true;

	protected $displayWord = '';

	public function __construct($word = null)
    {
        $this->word = $word ?? $this->createRandomWord();
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

	/**
	 * The word to guess.
	 *
	 * @return mixed
	 */
	public function word()
    {
        return $this->word;
    }

	/**
	 * The guesses that are in the hidden word.
	 *
	 * @return string
	 */
	public function guesses()
    {
        return $this->guesses;
    }

	/**
	 * The guesses that are not in the hidden word.
	 *
	 * @return string
	 */
	public function wrongGuesses()
    {
        return $this->wrongGuesses;
    }

	/**
	 * Returns the current game's status ('win', 'lose', or 'play')
	 *
	 * @return string
	 */
	public function gameStatus()
	{
		$this->wordWithGuesses();

		if (strpos($this->displayWord, '-') === FALSE)
		{
			return 'win';
		}

		if (strlen($this->wrongGuesses) == 7)
		{
			return 'loss';
		}
		return 'play';
	}

	/**
	 * Returns a string with the un-guessed letters hidden (as dashes)
	 * and the guessed letters displayed.
	 *
	 * @return string
	 */
	public function wordWithGuesses()
	{
		$word = str_split($this->word);

		$this->displayWord = '';

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

	/**
	 * Is the current guess valid?
	 *
	 * @return bool
	 */
	public function valid()
	{
		return $this->valid;
	}

	/**
	 * Determine if the letter has already been guessed.
	 *
	 * @param $letter
	 * @return bool
	 */
	public function letterHasAlreadyBeenGuessed($letter)
	{
		return ! $this->letterHasNotBeenGuessedYet($letter);
	}

	/**
	 * Fetches a random word from wordnik.com
	 *
	 * @return string
	 */
	private function createRandomWord()
	{
		$randomWordSite = file_get_contents('https://wordnik.com/words?random=true');

		// The beginning of the random word.
		$beginningOfWord = strpos($randomWordSite, "var word = '") + strlen("var word = '");

		// The end of the random word.
		$endOfWord = strpos($randomWordSite, "';\nvar random");

		$word = substr($randomWordSite, $beginningOfWord, ($endOfWord - $beginningOfWord));

		// If the random word contains a hyphen get a different one.
		if (preg_match("/[-']/i", $word))
		{
			return $this->createRandomWord();
		}

		return $word;
	}

	/**
	 * Determines if a letter is a valid guess.
	 *
	 * @param $letter
	 * @return bool
	 */
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

	/**
	 * Determines if a given letter been guessed yet.
	 *
	 * @param $letter
	 * @return bool
	 */
	private function letterHasNotBeenGuessedYet($letter)
	{
		return ! (preg_match("/{$letter}/", $this->guesses) || preg_match("/{$letter}/", $this->wrongGuesses));
	}

	/**
	 * Takes a valid guess and stores it in either the guesses or incorrect guesses string.
	 *
	 * @param $letter
	 * @return string
	 */
	private function storeValidGuess($letter)
	{
		if (strpos($this->word, $letter) !== false)
		{
			return $this->guesses .= $letter;
		}
		return $this->wrongGuesses .= $letter;
	}
}
