<?php

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = ['Schneider', 'Legrand', 'Powerware', 'Osram', 'Philips', 'Daikin', 'France Air', 'Atlantic', 'IDS', 'Portalp', 'Defcassiopee', 'Thorn', 'Aldes', 'Thermosreen', 'Tube 4', 'Grundig', 'Ciat', 'Mitsubishi', 'Split', 'Delchi', 'Thermor', 'Samson', 'Power Edge', 'France VMC', 'CR Remeha', 'Trane', 'Merlin Gerin', 'Mazda', 'HSBC', 'Nugelec', 'Kauffel', 'Cisco', 'VRV', 'Canalair'];

        foreach ($brands as $key => $brand) {
            $new_brand = new Brand();
            $new_brand->name = $brand;
            $new_brand->save();
        }
    }
}
