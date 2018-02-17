<?php

use App\Models\Energy;
use Illuminate\Database\Seeder;

class EnergiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $energies = ['Eau', 'Electricité HP', 'Electricité HC', 'Gaz'];

        foreach ($energies as $key => $energy) {
            $new_energy = new Energy();
            $new_energy->name = $energy;
            $new_energy->save();
        }
    }
}
