<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
        	[
        		'name' => 'administrator', 
        		'display_name' => 'Administrator',
        		'description' => 'User have access to everything.'
        	],
        	[
        		'name' => 'viewer',
        		'display_name' => 'Viewer',
        		'description' => 'User can only view pages.'
        	],
        	[
        		'name' => 'editor',
        		'display_name' => 'Editor',
        		'description' => 'User can update, delete or insert new pages in wiki.'
        	],
        ];

        foreach ($permission as $key => $value) {
        	Permission::create($value);
        }
    }
}
