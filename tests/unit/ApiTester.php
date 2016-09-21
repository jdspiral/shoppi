<?php

use Faker\Factory as Faker;

class ApiTester extends TestCase {

    protected $fake;

    protected $times;

    function __construct()
    {
        $this->fake = Faker::create();
    }

    protected function times($count)
    {
        $this->times = $count;

        return $this;
    }

    protected function getJson($uri)
    {
        return json_decode($this->call('GET', $uri)->getContent());
    }

}