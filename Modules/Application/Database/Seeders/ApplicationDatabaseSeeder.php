<?php

namespace Modules\Application\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ApplicationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {

            $this->command->call('migrate:refresh');
            $this->command->warn("Data cleared, starting from blank database.");
            $this->command->warn("");
            $this->command->warn("---------------------------------------");
            $this->command->warn("");

            $this->initPermission();
            $this->initAdminUser();
            $this->initRoles();

            $this->command->warn('All done :)');
        }

    }

    public function initPermission()
    {
        $permissions = [
            'users-list',
            'users-create',
            'users-edit',
            'users-delete',
            'roles-list',
            'roles-create',
            'roles-edit',
            'roles-delete',
            'permissions-list',
            'permissions-create',
            'permissions-edit',
            'permissions-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $this->command->info('Default permission added successfully');
    }

    public function initAdminUser()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret')
        ]);


        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }

    public function initRoles()
    {
        $role = Role::create(['name' => 'Stockist' , 'guard_name' => 'staff' ]);
        $role = Role::create(['name' => 'Checkin Staff' , 'guard_name' => 'staff' ]);
        $role = Role::create(['name' => 'Checkout Staff' , 'guard_name' => 'staff' ]);
        $role = Role::create(['name' => 'Technician Supervisor', 'guard_name' => 'staff' ]);
        $role = Role::create(['name' => 'Technician', 'guard_name' => 'staff' ]);
        $role = Role::create(['name' => 'Directors', 'guard_name' => 'staff' ]);
        $role = Role::create(['name' => 'Sub Distributor', 'guard_name' => 'staff' ]);
        $role = Role::create(['name' => 'LCO', 'guard_name' => 'staff' ]);
    }
}
