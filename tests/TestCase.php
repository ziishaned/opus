<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $dispatcher;

    protected function setUp()
    {
        parent::setUp();
        $this->dispatcher = Model::getEventDispatcher();
        Model::unsetEventDispatcher();
    }

    protected function tearDown()
    {
        parent::tearDown();
        Model::setEventDispatcher($this->dispatcher);
    }
}
