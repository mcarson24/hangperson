Feature: Game Over
    As a user playing hangman
    So that I can be happy
    I want to know when a game is over

Scenario:
    Given I start a new game with the word "foobar"
    Then I make the following guesses "f,o,b,a,r"
    Then I should see "You Win!"

Scenario:
    Given I start a new game with the word "zebra"
    Then I make the following guesses "i,s,u,c,k,h,a,r"
    Then I guess "d"
    Then I should see "Sorry, you lose!"

Scenario:
    Given I start a new game with the word "apple"
    When I go to "win"
    Then I should be on "show"
    Then I should not see "win"
    Then I go to "loss"
    Then I should be on "show"
    Then I should not see "lose"