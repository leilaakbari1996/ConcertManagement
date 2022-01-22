<?php

namespace Database\Seeders;

use App\Models\SeatClass;
use Illuminate\Database\Seeder;

class seatClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SeatClass::query()->insert([
            ['title' => 'first class'],
            ['title' => 'secend class'],
            ['title' => 'third class'],
            ['title' => 'forth class']
        ]);
    }
}
