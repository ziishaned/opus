<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GuestTest extends DuskTestCase
{
//    use DatabaseTransactions;

    public function testHomePageContainsLoginAndCreateTeamLinks()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('home')
                ->assertSee('Opus')
                ->assertSeeLink('Login Team')
                ->assertSeeLink('Create Team');
        });
    }

    public function testLoginLinkWork()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('home')
                ->assertSeeLink('Login Team')
                ->clickLink('Login Team')
                ->assertRouteIs('team.login')
                ->assertSee('Login');
        });
    }

    public function testCreateTeamLinkWork()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('home')
                ->assertSeeLink('Create Team')
                ->clickLink('Create Team')
                ->assertRouteIs('team.create')
                ->assertSee('Create a Team');
        });
    }
}
