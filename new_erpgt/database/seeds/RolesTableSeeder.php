<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'Un admin';
        $role_admin->intern_role = 1;
        $role_admin->save();

        $role_player = new Role();
        $role_player->name = 'Manager';
        $role_player->description = 'Un manager';
        $role_player->intern_role = 1;
        $role_player->save();

        $role_player = new Role();
        $role_player->name = 'Client';
        $role_player->description = 'Un client';
        $role_player->intern_role = 1;
        $role_player->save();

        $role_manager = new Role();
        $role_manager->name = 'Planneur';
        $role_manager->description = 'Un planneur';
        $role_manager->intern_role = 1;
        $role_manager->save();

        $role_coach = new Role();
        $role_coach->name = 'FM';
        $role_coach->description = 'Un facility manager';
        $role_coach->intern_role = 1;
        $role_coach->save();

        $role_coach = new Role();
        $role_coach->name = 'Technicien';
        $role_coach->description = 'Un technicien';
        $role_coach->intern_role = 1;
        $role_coach->save();

        $role_extern_contact = new Role();
        $role_extern_contact->name = 'Contact externe';
        $role_extern_contact->description = 'Un contact externe';
        $role_extern_contact->intern_role = 0;
        $role_extern_contact->save(); 
    }
}
