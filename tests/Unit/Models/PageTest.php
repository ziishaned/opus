<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;

class PageTest extends TestCase
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
        $pages = factory(Page::class, 3)->create();

        $this->assertCount(3, $pages);
    }

    public function testWikiCanUpdate()
    {
        $page = factory(Page::class, 1)->create()->first();

        $updated = Page::find($page->id)->update([
            'name' => 'opus',
        ]);

        $this->assertTrue($updated);
    }

    public function testWikiCanDelete()
    {
        $page = factory(Page::class, 1)->create()->first();

        $deleted = Page::find($page->id)->delete();

        $this->assertTrue($deleted);
    }
}
