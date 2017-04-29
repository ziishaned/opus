<?php

namespace Tests\Browser;

use Faker\Factory;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTeamTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $faker;

    public function setUp()
    {
        parent::setUp();
        $this->faker = Factory::create();
    }

    /** @test */
    public function it_can_see_create_team_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('team.create')
                ->assertSee('Create a Team')
                ->assertSee('Email')
                ->assertInputValue('email', '')
                ->assertSee('First name')
                ->assertInputValue('first_name', '')
                ->assertSee('Last name')
                ->assertInputValue('last_name', '')
                ->assertSee('Password')
                ->assertInputValue('password', '')
                ->assertSee('Confirm Password')
                ->assertInputValue('password_confirmation', '');
        });
    }

    /** @test */
    public function it_can_create_team()
    {
        $data = $this->getCreateTeamData();

        $this->browse(function (Browser $browser) use ($data) {
            $browser->visitRoute('team.create')
                ->assertSee('Create a Team')
                ->type('email', $data['email'])
                ->type('first_name', $data['first_name'])
                ->type('last_name', $data['last_name'])
                ->type('password', $data['password'])
                ->type('password_confirmation', $data['password'])
                ->type('team_name', $data['team_name'])
                ->click('.btn[value=Submit]')
                ->assertRouteIs('home');
        });

        $this->assertDatabaseHas('users', [
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
        ]);

        $this->assertDatabaseHas('teams', [
            'name' => $data['team_name'],
        ]);
    }

    private function getCreateTeamData()
    {
        return [
            'email'      => $this->faker->unique()->email,
            'first_name' => $this->faker->firstNameMale,
            'last_name'  => $this->faker->lastName,
            'team_name'  => $this->faker->company,
            'password'   => 'adminadmin',
        ];
    }
}
