<?php

use Illuminate\Database\Seeder;

class ActivityDatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ActivityDate::class, 30)->create();
    }
}
