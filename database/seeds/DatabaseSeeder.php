<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GuidesTableSeeder::class);
        $this->call(HotelsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        // $this->call(ToursTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        // $this->call(ActivityDatesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(BookingsTableSeeder::class);
        // $this->call(BankAccountsTableSeeder::class);
    }
}
