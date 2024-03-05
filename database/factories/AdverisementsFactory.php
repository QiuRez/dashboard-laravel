<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adverisements>
 */
class AdverisementsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'UserID' => 1,
        'CategoryID' => 1,
        'title' => Str::random(20),
        'description' => Str::random(50),
        'Status' => 'Одобрено',
        ];
    }
}
