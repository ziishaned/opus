<?php

namespace Database\Seeds\Components\Team;

use Carbon\Carbon;
use App\Models\Team;
use Illuminate\Database\Seeder;

/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class TeamsTableSeeder extends Seeder
{
	/**
     * Path to teams.json file.
     * 
     * @var string
     */
    private $teamsFilePath = 'database/seeds/Components/Team/teams.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = $this->getTeams();
        
        foreach ($teams as $team) {
		    Team::insert([
                'name'       => $team['name'], 
                'slug'       => str_slug($team['name'], '_'), 
			    'team_logo'  => $team['team_logo'],
			    'user_id' 	 => $team['user_id'], 
                'created_at' => Carbon::now(), 
			    'updated_at' => Carbon::now()
            ]); 
        }
    }

    /**
     * Get the teams from json file. 
     * 
     * @return array $teams
     */
    private function getTeams()
    {
        $teams = file_get_contents(base_path($this->teamsFilePath));

        return json_decode($teams, true);
    }
}
