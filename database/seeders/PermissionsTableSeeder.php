<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */
        $Permissionitems = [
            [
                'name'        => 'Can View Posts',
                'slug'        => 'view.posts',
                'description' => 'Can view posts',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Posts',
                'slug'        => 'create.posts',
                'description' => 'Can create new posts',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Posts',
                'slug'        => 'edit.posts',
                'description' => 'Can edit posts',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Posts',
                'slug'        => 'delete.posts',
                'description' => 'Can delete posts',
                'model'       => 'Permission',
            ],
        ];

        /*
         * Add Permission Items
         *
         */
        foreach ($Permissionitems as $Permissionitem) {
            $newPermissionitem = config('roles.models.permission')::where('slug', '=', $Permissionitem['slug'])->first();
            if ($newPermissionitem === null) {
                $newPermissionitem = config('roles.models.permission')::create([
                    'name'          => $Permissionitem['name'],
                    'slug'          => $Permissionitem['slug'],
                    'description'   => $Permissionitem['description'],
                    'model'         => $Permissionitem['model'],
                ]);
            }
        }
    }
}
