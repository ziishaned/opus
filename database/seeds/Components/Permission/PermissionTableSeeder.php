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
		   	],
			[
		   		'name' => 'view_page',
		   	],
			[
		   		'name' => 'add_page',
		   	],
		   	[
		        'name' => 'delete_page',
			],
		   	[
		        'name' => 'add_comment',
		    ],
		   	[
	           'name' => 'delete_comment',
	       	],
		];

		foreach ($permission as $key => $value) {
			Permission::create($value);
		}
    }
}