<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 1)->create([
            'name' => 'admin',
            'password' => 'admin',
            'email' => 'admin@admin.com',
            'is_admin' => true,
        ]);

        factory(App\Models\User::class, 1)->create([
            'name' => 'user',
            'password' => '123456',
            'email' => 'user@user.com',
            'description' => 'profile user',
            'is_admin' => false,
        ]);

        factory(App\Models\User::class, 1)->create([
            'name' => 'Nguyen Tam',
            'password' => '123456',
            'email' => 'nguyentam14t1@gmail.com',
            'description' => 'profile user',
            'is_admin' => false,
        ]);

        factory(App\Models\User::class, 20)->create()->each(function ($user) {
            if (rand(0, 1)) {
                $type = 'review';
                $id = App\Models\Review::all()->random()->id;
            } else {
                $type = 'comment';
                $id = App\Models\Comment::all()->random()->id;
            }

            $user->likes()->create([
                'user_id' => $user->id,
                'likeable_id' => $id,
                'likeable_type' => $type,
            ]);
        });
    }
}
