<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['Fonctionnel', 'Hors Service', 'Vétuste', 'Neuf'];

        foreach ($statuses as $key => $status) {
            $new_status = new Status();
            $new_status->name = $status;
            $new_status->save();
        }
    }
}
