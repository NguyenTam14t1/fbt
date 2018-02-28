<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Category::class, 4)->create()->each(function ($cateParent) {
            factory(App\Models\Category::class, 3)->create([
                'parent_id' => $cateParent->id,
            ]);
        });
    }
}
