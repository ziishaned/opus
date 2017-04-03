<?php

namespace Database\Seeds\Components\User;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class UsersRolesTableSeeder extends Seeder
{
	/**
     * Path to users_roles.json file.
     * 
     * @var string
     */
    private $usersRolesFilePath = 'database/seeds/Components/User/users_roles.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersRoles = $this->getUsersRoles();
        
        foreach ($usersRoles as $userRoles) {
		    DB::table('users_roles')->insert([
     			'role_id' 	 => $userRoles['role_id'],
			    'user_id' 	 => $userRoles['user_id'],
			    'team_id' 	 => $userRoles['team_id'],
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ]); 
        }
    }

    /**
     * Get the users roles from json file. 
     * 
     * @return array $usersRoles
     */
    private function getUsersRoles()
    {
        $usersRoles = file_get_contents(base_path($this->usersRolesFilePath));

        return json_decode($usersRoles, true);
    }
}
