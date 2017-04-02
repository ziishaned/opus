<?php

namespace Database\Seeds\Components\Role;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class RolesTableSeeder extends Seeder
{
	/**
     * Path to roles.json file.
     * 
     * @var string
     */
    private $rolesFilePath = 'database/seeds/Components/Role/roles.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   		$roles = $this->getRoles();
        
        foreach ($roles as $role) {
		    Role::insert([
                'name'       => $role['name'],
                'user_id'    => $role['user_id'],
                'team_id'    => $role['team_id'],
                'slug'       => str_slug($role['name'], '_'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]); 
        }
    }

    /**
     * Get the roles from json file. 
     * 
     * @return array $roles
     */
    private function getRoles()
    {
        $roles = file_get_contents(base_path($this->rolesFilePath));

        return json_decode($roles, true);
    }
}
