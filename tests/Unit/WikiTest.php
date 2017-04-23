<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Wiki;
use Illuminate\Database\Eloquent\Model;

class WikiTest extends TestCase
{
    private $dispatcher;

    public function setUp() {
        parent::setUp();
        $this->dispatcher = Model::getEventDispatcher();
        Model::unsetEventDispatcher();
	}

	protected function tearDown()
    {
        parent::tearDown();
        Model::setEventDispatcher($this->dispatcher);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_wiki()
    {
        $users = factory(Wiki::class, 3)->create();

        $this->assertCount(3, $users);
    }
}
