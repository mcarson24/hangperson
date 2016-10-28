<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

	/**
	 * @Given /^I start a new game with the word "(.*)"$/
	 */
	public function iStartANewGameWithTheWord($word)
	{
		$this->visit('new');
		$this->fillField('word', $word);
		$this->pressButton('newGame');
		$this->assertPageAddress('show');
	}

	/**
	 * @When /^I guess "(.*)"$/
	 */
	public function iGuess($letter)
	{
		$this->fillField('letter', $letter);
		$this->pressButton('guessLetter');
	}

	/**
	 * @When /^I make the following guesses "(.*)"$/
	 *
	 * @param $guesses
	 */
	public function iMakeTheFollowingGuesses($guesses)
	{
		$guesses = explode(',', $guesses);

		foreach	($guesses as $guess)
		{
			$this->visit('show');
			$this->iGuess($guess);
		}
	}

	/**
	 * @Then /^The word should read "(.*)"$/
	 */
	public function theWordShouldRead($expectedWord)
	{
		$this->visit('show');

		$this->assertPageContainsText($expectedWord);
	}

	/**
	 * @Then /^The wrong guesses should include "(.*)"$/
	 */
	public function theWrongGuessesShouldInclude($wrongGuesses)
	{
		$this->visit('show');
		$this->assertElementContainsText('span.guesses', $wrongGuesses);
	}
}
