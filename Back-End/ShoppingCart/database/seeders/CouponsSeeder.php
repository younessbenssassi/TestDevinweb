<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          \App\Models\Coupon::create([
          'discount_code' => 'TestDevinweb',
          'percentage_value' => '10'
        ]);

    }
}
