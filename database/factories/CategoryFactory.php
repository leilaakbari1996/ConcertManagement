<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'fake Category ' . bcrypt(Carbon::now()->timestamp)//I use the bcrypt method because I want the title to be unique
        ];
    }
}
