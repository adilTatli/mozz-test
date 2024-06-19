<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Get Available Permissions.
         */
        $permissions = config('roles.models.permission')::all();

        /**
         * Attach Permissions to Roles.
         */
        $roleAdmin = config('roles.models.role')::where('name', '=', 'Admin')->first();
        foreach ($permissions as $permission) {
            $roleAdmin->attachPermission($permission);
        }

        $roleModerator = config('roles.models.role')::where('name', '=', 'Moderator')->first();
        $permissionView = config('roles.models.permission')::where('slug', '=', 'view.posts')->first();
        $permissionEdit = config('roles.models.permission')::where('slug', '=', 'edit.posts')->first();
        $roleModerator->attachPermission($permissionView);
        $roleModerator->attachPermission($permissionEdit);
    }
}
