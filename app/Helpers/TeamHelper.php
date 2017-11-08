<?php

namespace App\Helpers;
use DB;
use Carbon\Carbon;

class TeamHelper
{

    /**
     * Create admin role when a user create a team.
     *
     * @param $team
     * @return bool
     */
    public static function createAdminsRole($team)
    {
        // Create role
        $roleId = DB::table('roles')->insertGetId([
            'name'       => 'Admins',
            'slug'       => str_slug('Admins', '-'),
            'user_id'    => $team->user_id,
            'team_id'    => $team->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Implementing permissions on role
        $permissions = DB::table('permissions')->get();
        foreach ($permissions as $permission) {
            DB::table('role_permissions')->insert([
                'role_id'       => $roleId,
                'permission_id' => $permission->id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }

        // Inserting user into role.
        DB::table('users_roles')->insertGetId([
            'role_id'    => $roleId,
            'user_id'    => $team->user_id,
            'team_id'    => $team->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return true;
    }

}
