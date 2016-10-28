Feature: Start New Game
  As a player
  So I can play hangman
  I want to start a new game

Scenario: I start a new game
  Given I am on the homepage
  When I press "New Game"
  Then I should see "Guess A Letter"
  When I press "New Game"
  Then I should see "Guess A Letter"