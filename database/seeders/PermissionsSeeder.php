<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list homeroomteachers']);
        Permission::create(['name' => 'view homeroomteachers']);
        Permission::create(['name' => 'create homeroomteachers']);
        Permission::create(['name' => 'update homeroomteachers']);
        Permission::create(['name' => 'delete homeroomteachers']);

        Permission::create(['name' => 'list lessons']);
        Permission::create(['name' => 'view lessons']);
        Permission::create(['name' => 'create lessons']);
        Permission::create(['name' => 'update lessons']);
        Permission::create(['name' => 'delete lessons']);

        Permission::create(['name' => 'list raports']);
        Permission::create(['name' => 'view raports']);
        Permission::create(['name' => 'create raports']);
        Permission::create(['name' => 'update raports']);
        Permission::create(['name' => 'delete raports']);

        Permission::create(['name' => 'list scores']);
        Permission::create(['name' => 'view scores']);
        Permission::create(['name' => 'create scores']);
        Permission::create(['name' => 'update scores']);
        Permission::create(['name' => 'delete scores']);

        Permission::create(['name' => 'list semesters']);
        Permission::create(['name' => 'view semesters']);
        Permission::create(['name' => 'create semesters']);
        Permission::create(['name' => 'update semesters']);
        Permission::create(['name' => 'delete semesters']);

        Permission::create(['name' => 'list students']);
        Permission::create(['name' => 'view students']);
        Permission::create(['name' => 'create students']);
        Permission::create(['name' => 'update students']);
        Permission::create(['name' => 'delete students']);

        Permission::create(['name' => 'list studentclasses']);
        Permission::create(['name' => 'view studentclasses']);
        Permission::create(['name' => 'create studentclasses']);
        Permission::create(['name' => 'update studentclasses']);
        Permission::create(['name' => 'delete studentclasses']);

        Permission::create(['name' => 'list teachers']);
        Permission::create(['name' => 'view teachers']);
        Permission::create(['name' => 'create teachers']);
        Permission::create(['name' => 'update teachers']);
        Permission::create(['name' => 'delete teachers']);

        Permission::create(['name' => 'list timetables']);
        Permission::create(['name' => 'view timetables']);
        Permission::create(['name' => 'create timetables']);
        Permission::create(['name' => 'update timetables']);
        Permission::create(['name' => 'delete timetables']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@arroqy.ac.id')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
