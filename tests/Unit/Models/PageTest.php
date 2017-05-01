<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Page;
use App\Models\User;
use App\Models\Wiki;
use App\Models\Comment;
use App\Models\PageTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PageTest extends TestCase
{
    use DatabaseTransactions;

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

    /** @test */
    public function it_can_create_wiki()
    {
        $pages = factory(Page::class, 3)->create();

        $this->assertCount(3, $pages);
    }

    /** @test */
    public function it_can_update_wiki()
    {
        $page = factory(Page::class, 1)->create()->first();

        $updated = Page::find($page->id)->update([
            'name' => 'Update name',
        ]);

        $this->assertTrue($updated);
    }

    /** @test */
    public function it_can_delete_wiki()
    {
        $page = factory(Page::class, 1)->create()->first();

        $deleted = Page::find($page->id)->delete();

        $this->assertTrue($deleted);
    }

    /** @test */
    public function a_page_belongs_to_a_user()
    {
        $page = factory(Page::class, 1)->create()->first();

        $this->assertInstanceOf(BelongsTo::class, $page->user());
    }

    /** @test */
    public function a_page_belongs_to_many_tags()
    {
        $page = factory(Page::class, 1)->create()->first();

        $this->assertInstanceOf(BelongsToMany::class, $page->tags());
    }

    /** @test */
    public function a_page_has_many_comments()
    {
        $page = factory(Page::class, 1)->create()->first();

        $this->assertInstanceOf(HasMany::class, $page->comments());
    }

    /** @test */
    public function a_page_belongs_to_a_wiki()
    {
        $page = factory(Page::class, 1)->create()->first();

        $this->assertInstanceOf(BelongsTo::class, $page->wiki());
    }

    /** @test */
    public function a_page_can_assigned_many_tags()
    {
        $page = factory(Page::class)->create()->first();

        factory(PageTags::class, 5)->create([
            'subject_id'   => $page->id,
            'subject_type' => Page::class,
        ]);

        $this->assertEquals(5, $page->tags->count());
    }

    /** @test */
    public function a_page_must_have_a_wiki()
    {
        $wiki = factory(Wiki::class)->create()->first();

        $page = factory(Page::class)->create([
            'wiki_id' => $wiki->id,
        ])->first();

        $this->assertEquals($page->wiki_id, $wiki->id);
    }

    /** @test */
    public function it_has_many_comments()
    {
        $page = factory(Page::class)->create()->first();

        factory(Comment::class, 20)->create([
            'subject_type' => Page::class,
            'subject_id' => $page->id,
        ])->first();

        $this->assertEquals(20, $page->comments->count());
    }

    /** @test */
    public function it_has_a_user()
    {
        $user = factory(User::class)->create()->first();

        $page = factory(Page::class)->create([
            'user_id' => $user->id
        ])->first();

        $this->assertEquals($user->id, $page->user->id);
    }
}
