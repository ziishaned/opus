<?php

namespace Database\Seeds\Components\Permission;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class RolePermissionsTableSeeder extends Seeder
{
	/**
     * Path to role_permissions.json file.
     * 
     * @var string
     */
    private $rolePermissionsFilePath = 'database/seeds/Components/Permission/role_permissions.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolePermissions = $this->getPermissions();
        
        foreach ($rolePermissions as $rolePermission) {
		    DB::table('role_permissions')->insert([
                "role_id"       => $rolePermission['role_id'],
                "permission_id" => $rolePermission['permission_id'],
                "created_at"    => Carbon::now(),
                "updated_at"    => Carbon::now(),
            ]); 
        }
    }

    /**
     * Get the role permissions from json file. 
     * 
     * @return array $rolePermissions
     */
    private function getPermissions()
    {
        $rolePermissions = file_get_contents(base_path($this->rolePermissionsFilePath));

        return json_decode($rolePermissions, true);
    }
}
