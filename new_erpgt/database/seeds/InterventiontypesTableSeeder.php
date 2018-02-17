<?php

use App\Models\Interventiontype;
use Illuminate\Database\Seeder;

class InterventiontypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Curative', 'Préventive', 'Dépannage'];
        $i = 0;
        foreach ($types as $key => $type) {
            $i += 1;
            $new_type = new Interventiontype();
            $new_type->name = $type;
            $new_type->order = $i;
            $new_type->save();
        }
    }
}
