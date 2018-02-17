<?php

use App\Models\Site;
use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site = new Site();
		$site->name = 'BORELY';
		$site->address = 'rue des camions';
		$site->postal_code = '13011';
		$site->city = 'Marseille';
        $site->save();
    }
}
