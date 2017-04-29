<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $data = [
        'email'      => 'opus@info.com',
        'first_name' => 'opus',
        'last_name'  => 'admin',
        'team_name'  => 'opus',
        'password'   => 'opusadmin',
    ];

    /** @test */
    public function it_can_see_login_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('team.login')
                ->assertSee('Login')
                ->assertSee('Team Name')
                ->assertInputValue('team_name', '')
                ->assertSee('Email')
                ->assertInputValue('email', '')
                ->assertSee('Password')
                ->assertInputValue('password', '');
        });
    }

    /** @test */
    public function it_can_login_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('team.create')
                ->type('email', $this->data['email'])
                ->type('first_name', $this->data['first_name'])
                ->type('last_name', $this->data['last_name'])
                ->type('password', $this->data['password'])
                ->type('password_confirmation', $this->data['password'])
                ->type('team_name', $this->data['team_name'])
                ->click('.btn[value=Submit]');
        });

        $this->browse(function (Browser $browser) {
            $browser->visitRoute('team.login')
                ->type('team_name', $this->data['team_name'])
                ->type('email', $this->data['email'])
                ->type('password', $this->data['password'])
                ->click('.btn[value=Login]')
                ->assertSee('Activities')
                ->assertRouteIs('dashboard', [$this->data['team_name']]);
        });

    }
}
