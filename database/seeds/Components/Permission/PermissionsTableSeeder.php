<?php

namespace Database\Seeds\Components\Permission;

use App\Models\Permission;
use Illuminate\Database\Seeder;

/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class PermissionsTableSeeder extends Seeder
{
	/**
     * Path to permissions.json file.
     * 
     * @var string
     */
    private $permissionsFilePath = 'database/seeds/Components/Permission/permissions.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = $this->getPermissions();
        
        foreach ($permissions as $permission) {
		    Permission::create([
                'name' => $permission['name']
            ]); 
        }
    }

    /**
     * Get the permissions from json file. 
     * 
     * @return array $permissions
     */
    private function getPermissions()
    {
        $permissions = file_get_contents(base_path($this->permissionsFilePath));

        return json_decode($permissions, true);
    }
}
