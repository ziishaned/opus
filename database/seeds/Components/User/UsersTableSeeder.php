<?php

namespace Database\Seeds\Components\User;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class UsersTableSeeder extends Seeder
{
	/**
     * Path to users.json file.
     * 
     * @var string
     */
    private $usersFilePath = 'database/seeds/Components/User/users.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = $this->getUsers();
        
        foreach ($users as $user) {
		    User::insert([
     			'name'		 	=> $user['name'],
			    'first_name' 	=> $user['first_name'],
			    'last_name'  	=> $user['last_name'],
			    'slug'  	 	=> str_slug($user['name'], '_'),
			    'email' 	 	=> $user['email'],
			    'password' 	 	=> $user['password'],
			    'profile_image' => $user['profile_image'],
			    'timezone' 		=> $user['timezone'],
                'created_at'    => Carbon::now(), 
                'updated_at'    => Carbon::now()
            ]); 
        }
    }

    /**
     * Get the users from json file. 
     * 
     * @return array $users
     */
    private function getUsers()
    {
        $users = file_get_contents(base_path($this->usersFilePath));

        return json_decode($users, true);
    }
}
