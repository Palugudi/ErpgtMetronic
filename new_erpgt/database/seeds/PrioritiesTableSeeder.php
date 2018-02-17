<?php

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priorities = ['Normal', 'R1', 'R2', 'R3'];
        $i = 0;
        foreach ($priorities as $key => $priority) {
            $i += 1;
            $new_priority = new Priority();
            $new_priority->name = $priority;
            $new_priority->order = $i;
            $new_priority->save();
        }
    }
}
