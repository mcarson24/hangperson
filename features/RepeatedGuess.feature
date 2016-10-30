Feature: Guess Repeated Letter
  Given I am a user playing hangman
  So that I can avoid wasting time on letters that I have already tried
  I want to be informed that I have already guessed a letter 
  
Scenario:
  Given I start a new game with the word "bumblebee"
  Then I guess "b"
  Then I guess "b" again
  Then The word should read "b--b--b--"
  And I should see text matching "You have already guessed that letter."

Scenario: guess incorrect letter that I have already tried
  Given I start a new game with the word "giraffe"
  Then I guess "z"
  Then I guess "z" again
  Then The word should read "-------"
  And I should see "You have already guessed that letter"

Scenario: guessing an incorrect letter does not count towards guesses
  Given I start a new game with the word "snake"
  Then I guess "z" 30 times in a row
  Then I am on "show"

Scenario: Guess a letter multiple times in uppercase
  Given I start a new game with the word "sauce"
  Then I guess "t"
  When I guess "T"
  And I should see "You have already guessed that letter"