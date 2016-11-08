<?php

namespace App;

use Goutte\Client;

class WordGenerator
{
	private $client;

	private $word_generator = 'https://randomword.com/';

	public function __construct()
	{
		$this->client = new Client();
	}

	public function word()
    {
        return $this->generateWord();
    }

    public function generateWord()
    {
        $crawler = $this->client->request('GET', $this->word_generator);

		return $crawler->filter('div#random_word')->text();
    }
}
