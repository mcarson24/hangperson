Feature: Reveal Word
  As a user playing hangman
  So that I know what the word was
  I want to be able to see the word when the game is over

Scenario:
  Given I start a new game with the word "hello"
  Then I make the following guesses "h,e,l,o"
  Then I should be on "win"
  Then I should see text matching "hello"

Scenario:
  Given I start a new game with the word "lose"
  Then I make the following guesses "q,w,e,r,t,y,u,i"
  Then I should be on "loss"
  Then I should see text matching "The word was lose"