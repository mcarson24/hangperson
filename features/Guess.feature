Feature: Guess Correct Letter
  As a player playing Hangman
  So that I can make progress to correctly solving and winning Hangman
  I want to see when I have correctly guessed a letter

Scenario: Guess correct letter that occurs once in the word
  Given I start a new game with the word "garply"
  When I guess "r"
  Then I should see "r" in the "span.word" element

Scenario: Guess correct letter that occurs multiple times in the word
  Given I start a new game with the word "animal"
  When I guess "a"
  Then I should see "a---a-" in the "span.word" element

Scenario: Guess incorrect letter
  Given I start a new game with the word "xylophone"
  When I guess "a"
  Then I should see "a" in the "span.guesses" element

Scenario: Multiple correct and incorrect guesses
  Given I start a new game with the word "foobar"
  When I make the following guesses "a,z,x,o"
  Then The word should read "-oo-a-"
  And The wrong guesses should include "zx"
