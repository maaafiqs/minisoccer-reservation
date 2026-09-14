<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Field;

class FieldSeeder extends Seeder
{
    public function run(): void
    {
        Field::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Lapangan Sintetis Premium B',
                'description' => 'Lapangan sintetis dengan kualitas standar FIFA.',
                'image' => null,
                'weekday_day_price' => 120000,
                'weekday_night_price' => 150000,
                'weekend_price' => 200000,
                'is_active' => 1,
            ]
        );

        Field::updateOrCreate(
            ['id' => 2],
            [
                'name' => 'Lapangan Sintetis Premium A',
                'description' => 'Lapangan utama rumput monofilament empuk dengan pencahayaan LED 1200 Lux.',
                'image' => null,
                'weekday_day_price' => 120000,
                'weekday_night_price' => 150000,
                'weekend_price' => 200000,
                'is_active' => 1,
            ]
        );
    }
}
