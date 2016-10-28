Feature: Guess Correct Letter
  As a player playing Hangman
  So that I can make progress to correctly solving and winning Hangman
  I want to see when I have correctly guessed a letter

Scenario: Guess correct letter that occurs once in the word
  Given I start a new game with the word "garply"
  When I guess "r"
  Then I should see "r" in the "span.word" element
