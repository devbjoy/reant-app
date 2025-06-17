<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'view permission', 'group' => 'permission'],
            ['name' => 'add permission', 'group' => 'permission'],
            ['name' => 'edit permission', 'group' => 'permission'],
            ['name' => 'delete permission', 'group' => 'permission'],
            ['name' => 'view permission trash', 'group' => 'permission'],
            ['name' => 'restore permission', 'group' => 'permission'],
            ['name' => 'force delete permission', 'group' => 'permission'],

            ['name' => 'view role', 'group' => 'role'],
            ['name' => 'add role', 'group' => 'role'],
            ['name' => 'edit role', 'group' => 'role'],
            ['name' => 'delete role', 'group' => 'role'],
            ['name' => 'view role trash', 'group' => 'role'],
            ['name' => 'restore role', 'group' => 'role'],
            ['name' => 'force delete role', 'group' => 'role'],
            ['name' => 'view role permission', 'group' => 'role'],


            ['name' => 'view user', 'group' => 'user'],
            ['name' => 'add user', 'group' => 'user'],
            ['name' => 'edit user', 'group' => 'user'],
            ['name' => 'delete user', 'group' => 'user'],
            ['name' => 'view user trash', 'group' => 'user'],
            ['name' => 'restore user', 'group' => 'user'],
            ['name' => 'force delete user', 'group' => 'user'],

            ['name' => 'view company setting', 'group' => 'company setting'],
            ['name' => 'edit company setting', 'group' => 'company setting'],


        ];

        foreach ($permissions as $perm) {
            \App\Models\Permission::firstOrCreate($perm);
        }
    }
}
