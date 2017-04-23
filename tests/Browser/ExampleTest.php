<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function test_home_page_contains_login_and_create_links()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Opus')
                    ->assertSeeLink('Login Team')
                    ->assertSeeLink('Create Team');
        });
    }
}
