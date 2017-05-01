<?php

namespace tests\Unit;

use Tests\TestCase;
use App\Models\Wiki;
use Illuminate\Database\Eloquent\Model;

class WikiTest extends TestCase
{
    protected $dispatcher;

    public function setUp()
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

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateWiki()
    {
        $wikis = factory(Wiki::class, 3)->create();
        $this->assertCount(3, $wikis);
    }

    public function testWikiCanUpdate()
    {
        $wiki    = factory(Wiki::class, 1)->create()->first();
        $updated = Wiki::find($wiki->id)->update([
            'name' => 'opus',
        ]);
        $this->assertTrue($updated);
    }

    public function testWikiCanDelete()
    {
        $wiki    = factory(Wiki::class, 1)->create()->first();
        $deleted = Wiki::find($wiki->id)->delete();
        $this->assertTrue($deleted);
    }
}
