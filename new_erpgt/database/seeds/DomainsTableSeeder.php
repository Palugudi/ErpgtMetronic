<?php

use App\Models\Domain;
use Illuminate\Database\Seeder;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domains')->truncate();

        $domain = new Domain();
		$domain->name = 'Contrôle d\'accès';
		$domain->picture = 'key.png';
        $domain->color = '009933';
        $domain->save();

        $domain = new Domain();
		$domain->name = 'Portes automatiques';
		$domain->picture = 'doors.png';
        $domain->color = 'ff99cc';
        $domain->save();

        $domain = new Domain();
		$domain->name = 'CVC';
		$domain->picture = 'cvc.png';
        $domain->color = 'ff3300';
        $domain->save();

        $domain = new Domain();
		$domain->name = 'Electricité';
		$domain->picture = 'electricity.png';
        $domain->color = 'cc33ff';
        $domain->save();

        $domain = new Domain();
		$domain->name = 'Ascenseurs';
		$domain->picture = 'elevator.png';
        $domain->color = '0033cc';
        $domain->save();

        $domain = new Domain();
		$domain->name = 'Sécurité Incendie';
		$domain->picture = 'fire_safety.png';
        $domain->color = '009999';
        $domain->save();

        $domain = new Domain();
		$domain->name = 'Eclairage';
		$domain->picture = 'lights.png';
        $domain->color = '660066';
        $domain->save();

        $domain = new Domain();
		$domain->name = 'Plomberie';
		$domain->picture = 'plumbing.png';
        $domain->color = 'cc9900';
        $domain->save();

        $domain = new Domain();
		$domain->name = 'Surveillance';
		$domain->picture = 'camera.png';
        $domain->color = '333300   ';
        $domain->save();

        $domain = new Domain();
		$domain->name = 'Serveur';
		$domain->picture = 'server.png';
        $domain->color = 'ffff00';
        $domain->save();
    }
}
