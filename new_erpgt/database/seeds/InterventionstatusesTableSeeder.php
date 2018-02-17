<?php

use App\Models\Interventionstatus;
use Illuminate\Database\Seeder;

class InterventionstatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['Ouvert', 'Pris acte', 'En cours', 'Fermé', 'Incomplet'];
        $i = 0;
        foreach ($statuses as $key => $status) {
            $i += 1;
            $new_status = new Interventionstatus();
            $new_status->name = $status;
            $new_status->order = $i;
            $new_status->save();
        }
    }
}
