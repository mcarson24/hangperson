<?php

namespace spec\App;

use App\WordGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WordGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(WordGenerator::class);
    }

    function it_generates_a_random_word()
	{
		$this->generateWord();
		$this->word()->shouldNotBe('');
	}
}
