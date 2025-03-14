<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use App\Models\LeadStatus;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password'),
            'profile' => 'user.avif',
            'team_id' => '0'
        ]);

        $writer = User::create([
            'name'=>'writer',
            'email'=>'writer@writer.com',
            'password'=>bcrypt('password'),
            'profile' => 'user.avif',
            'team_id' => '1'
        ]);

        $team = Team::create([
            'name'=>'writer',
            'team_lead_id'=>'1',
            'publish' => '1'
        ]);

        $admin_role = Role::create(['name' => 'admin']);
        $writer_role = Role::create(['name' => 'writer']);

        $permission = Permission::create(['name' => 'Post access']);
        $permission = Permission::create(['name' => 'Post edit']);
        $permission = Permission::create(['name' => 'Post create']);
        $permission = Permission::create(['name' => 'Post delete']);

        $permission = Permission::create(['name' => 'Category access']);
        $permission = Permission::create(['name' => 'Category edit']);
        $permission = Permission::create(['name' => 'Category create']);
        $permission = Permission::create(['name' => 'Category delete']);

        $permission = Permission::create(['name' => 'Brand access']);
        $permission = Permission::create(['name' => 'Brand edit']);
        $permission = Permission::create(['name' => 'Brand create']);
        $permission = Permission::create(['name' => 'Brand delete']);


        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role delete']);

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User delete']);
        $permission = Permission::create(['name' => 'User status']);


        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission delete']);
        

        $permission = Permission::create(['name' => 'Mail access']);
        $permission = Permission::create(['name' => 'Mail edit']);


        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);

        $admin_role->givePermissionTo(Permission::all());

        $status = LeadStatus::create(['status' => 'New']);
        $status = LeadStatus::create(['status' => 'Converted']);
        $status = LeadStatus::create(['status' => 'Pending']);
        $status = LeadStatus::create(['status' => 'Invalid']);
        $status = LeadStatus::create(['status' => 'Follow-up']);
        $status = LeadStatus::create(['status' => 'Duplicate']);
        $status = LeadStatus::create(['status' => 'Payment Pending']);
        $status = LeadStatus::create(['status' => 'Paid']);
    }
}
