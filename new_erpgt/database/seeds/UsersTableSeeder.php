<?php

use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Admin')->first();
    	$role_manager = Role::where('name', 'Manager')->first();
    	$role_client = Role::where('name', 'Client')->first();
    	$role_planneur = Role::where('name', 'Planneur')->first();
    	$role_FM = Role::where('name', 'FM')->first();
    	$role_technicien = Role::where('name', 'Technicien')->first();

        $admin = new User();
        $admin->first_name = 'admin';
        $admin->last_name = 'erpgt';
        $admin->email = 'admin@erpgt.com';
        $admin->password = bcrypt('admin');
        $admin->map_creator = 1;
        $admin->intern_contact = 1;
        $admin->first_connection = 1;
        $admin->save();
        $admin->roles()->attach($role_admin);

        $admin = new User();
        $admin->first_name = 'Jerome';
        $admin->last_name = 'Mansbendel';
        $admin->email = 'contact@dealeo.fr';
        $admin->password = bcrypt('oasis91300');
        $admin->map_creator = 1;
        $admin->intern_contact = 1;
        $admin->first_connection = 1;
        $admin->save();
        $admin->roles()->attach($role_admin);

        $admin = new User();
        $admin->first_name = 'demo';
        $admin->last_name = 'demo';
        $admin->email = 'demo@erpgt.com';
        $admin->password = bcrypt('31031968');
        $admin->map_creator = 1;
        $admin->intern_contact = 1;
        $admin->first_connection = 1;
        $admin->save();
        $admin->roles()->attach($role_admin);

        $manager = new User();
        $manager->first_name = 'manager';
        $manager->last_name = 'erpgt';
        $manager->email = 'manager@erpgt.com';
        $manager->password = bcrypt('manager');
        $manager->map_creator = 1;
        $manager->intern_contact = 1;
        $manager->first_connection = 1;
        $manager->save();
        $manager->roles()->attach($role_manager);

        $client = new User();
        $client->first_name = 'client';
        $client->last_name = 'erpgt';
        $client->email = 'client@erpgt.com';
        $client->password = bcrypt('client');
        $client->map_creator = 1;
        $client->intern_contact = 1;
        $client->first_connection = 1;
        $client->save();
        $client->roles()->attach($role_client);

        $planneur = new User();
        $planneur->first_name = 'planneur';
        $planneur->last_name = 'erpgt';
        $planneur->email = 'planneur@erpgt.com';
        $planneur->password = bcrypt('planneur');
        $planneur->map_creator = 1;
        $planneur->intern_contact = 1;
        $planneur->first_connection = 1;
        $planneur->save();
        $planneur->roles()->attach($role_planneur);

        $FM = new User();
        $FM->first_name = 'FM';
        $FM->last_name = 'erpgt';
        $FM->email = 'FM@erpgt.com';
        $FM->password = bcrypt('FM');
        $FM->map_creator = 1;
        $FM->intern_contact = 1;
        $FM->first_connection = 1;
        $FM->save();
        $FM->roles()->attach($role_FM);

        $technicien = new User();
        $technicien->first_name = 'technicien';
        $technicien->last_name = 'erpgt';
        $technicien->email = 'technicien@erpgt.com';
        $technicien->password = bcrypt('technicien');
        $technicien->map_creator = 1;
        $technicien->intern_contact = 1;
        $technicien->first_connection = 1;
        $technicien->save();
        $technicien->roles()->attach($role_technicien);
    }
}
