<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Group::class, 1)->create([
            'name' => 'admin',
        ]);

        factory(App\Models\Group::class, 1)->create([
            'name' => 'user',
        ]);

        factory(App\Models\Group::class, 1)->create([
            'name' => 'guide',
        ]);
    }
}
