<?php

use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Booking::class, 20)->create()->each(function ($booking) {
            $timesPaymented = $booking->paymented / ($booking->paymented + $booking->debt) * $booking->times_payment;
            factory(App\Models\TimesPayment::class, $timesPaymented)->create([
                'booking_id' => $booking->id,
                'cash' => $booking->paymented / ($timesPaymented),
            ]);
        });
    }
}
