<?php

namespace Database\Seeds\Components\User;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class UsersTeamsTableSeeder extends Seeder
{
	/**
     * Path to user_teams.json file.
     * 
     * @var string
     */
    private $userTeamsFilePath = 'database/seeds/Components/User/user_teams.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTeams = $this->getUserTeams();
        
        foreach ($userTeams as $userTeam) {
		    DB::table('user_teams')->insert([
     			'user_id' 	 => $userTeam['user_id'],
			    'team_id' 	 => $userTeam['team_id'],
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ]); 
        }
    }

    /**
     * Get the user teams from json file. 
     * 
     * @return array $userTeams
     */
    private function getUserTeams()
    {
        $userTeams = file_get_contents(base_path($this->userTeamsFilePath));

        return json_decode($userTeams, true);
    }
}
