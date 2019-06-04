<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => config('setting.password_test'),
        'description' => $faker->paragraph(2),
        // 'avatar' => $faker->image($dir = '/tmp', $width = 320, $height = 240),
        'remember_token' => str_random(10),
        'group_id' => 2,
    ];
});

$factory->define(App\Models\Hotel::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
    ];
});

$factory->define(App\Models\Guide::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mail' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'password' => config('setting.password_test'),
        'phone' => config('setting.password_test'),
        'category_id' => 1,
        // 'is_admin' => false,
    ];
});

$factory->define(App\Models\BankAccount::class, function (Faker $faker) {
    return [
        'user_id' => App\Models\User::all()->random()->id,
        'card_number' => $faker->creditCardNumber(),
        'bank_name' => implode('', $faker->words(2)),
    ];
});


$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => implode('', $faker->words(2)),
        'parent_id' => config('setting.parent_id'),
    ];
});

$factory->define(App\Models\Tour::class, function (Faker $faker) {
    return [
        'category_id' => App\Models\Category::where('parent_id', '<>', config('setting.parent_id'))->get()->random()->id,
        'name' => implode('', $faker->words(2)),
        'description' => $faker->paragraph(2),
        'place' => $faker->sentence(),
        'time_start' => $faker->dateTime(),
        'time_finish' => $faker->dateTime(),
        'participants_min' => $faker->numberBetween(2, 5),
        'participants_max' => $faker->numberBetween(10, 15),
        'price' => $faker->numberBetween(1, 9) * 100,
        // 'picture' => $faker->unique()->image($dir = '/tmp', $width = 640, $height = 480),
    ];
});

$factory->define(App\Models\News::class, function (Faker $faker) {
    return [
        'tour_id' => App\Models\Tour::all()->random()->id,
        'title' => $faker->sentence(),
        'content' => $faker->paragraph(2),
        // 'picture' => $faker->unique()->image($dir = '/tmp', $width = 640, $height = 480),
    ];
});

$factory->define(App\Models\ActivityDate::class, function (Faker $faker) {
    return [
        'tour_id' => App\Models\Tour::all()->random()->id,
        'title' => $faker->sentence(),
        'detail' => $faker->paragraph(2),
        'time' => $faker->time(),
    ];
});

$factory->define(App\Models\Service::class, function (Faker $faker) {
    return [
        'activity_date_id' => App\Models\ActivityDate::all()->random()->id,
        'name' => $faker->sentence(),
        'content' => $faker->paragraph(2),
        'picture' => '2.jpg',
        'type' => (rand(0, 1)) ? 'food' : 'place',
    ];
});

$factory->define(App\Models\Review::class, function (Faker $faker) {

    $foodRate = $faker->numberBetween(1, 5);
    $placeRate = $faker->numberBetween(1, 5);
    $serviceRate = $faker->numberBetween(1, 5);

    return [
        'tour_id' => App\Models\Tour::all()->random()->id,
        'user_id' => $faker->numberBetween(1, 20),
        'food_rate' => $foodRate,
        'place_rate' => $placeRate,
        'service_rate' => $serviceRate,
        'total_rate' => ($foodRate + $placeRate + $serviceRate) / 3,
        'content' => $faker->paragraph(2),
    ];
});

$factory->define(App\Models\Comment::class, function (Faker $faker) {

    if (rand(0, 1)) {
        $type = 'review';
        $id = App\Models\Review::all()->random()->id;
    } else {
        $type = 'tour';
        $id = App\Models\Tour::all()->random()->id;
    }

    return [
        'name' => implode('', $faker->words(2)),
        'content' => $faker->paragraph(2),
        'parent_id' => config('setting.parent_id'),
        'commentable_id' => $id,
        'commentable_type' => $type,
    ];
});

$factory->define(App\Models\Booking::class, function (Faker $faker) {

    $tourId = App\Models\Tour::all()->random()->id;
    $numOfPeople = $faker->numberBetween(5, 10);
    $price = App\Models\Tour::where('id', $tourId)->first()->price * $numOfPeople;
    $timesPayment = rand(1, 3);
    $paymented = $price * (rand(1, $timesPayment) / $timesPayment);
    $debt = $price - $paymented;

    return [
        'first_name' => 'temp first_name',
        'last_name' => 'temp last_name',
        'address' => 'temp address',
        'phone' => 'temp phone',
        'identity_card' => 'temp identity_card',
        'requiments' => 'temp requiments',
        'confirm_code' => 'temp confirm_code',
        'tour_id' => $tourId,
        'user_id' => rand(1, 10),
        'number_of_people' => $numOfPeople,
        'number_of_children' => $numOfPeople,
        'status' => $faker->numberBetween(1, 3),
        'debt' => $debt,
    ];
});

$factory->define(App\Models\TimesPayment::class, function (Faker $faker) {
    return [
        'booking_id' => App\Models\Booking::all()->random()->id,
    ];
});
