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
        		'name' => 'admin', 
        		'display_name' => 'Administrtor',
        		'description' => 'User have access to everything.'
        	],
        	[
        		'name' => 'page-read',
        		'display_name' => 'Read Pages',
        		'description' => 'User can only access to read wiki pages.'
        	],
        	[
        		'name' => 'page-write',
        		'display_name' => 'Update page',
        		'description' => 'User can update, delete or insert new pages in wiki.'
        	],
        	[
        		'name' => 'comment-add',
        		'display_name' => 'Add Comment',
        		'description' => 'Add comments to page and wiki.'
        	],
        	[
        		'name' => 'invite-users',
        		'display_name' => 'Invite Users',
        		'description' => 'Invite users to team.'
        	],
        ];

        foreach ($permission as $key => $value) {
        	Permission::create($value);
        }
    }
}
