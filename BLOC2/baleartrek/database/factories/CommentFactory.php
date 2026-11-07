<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\Meeting;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => $this->faker->sentence(),
            'user_id' => User::inRandomOrder()->value('id'),
            'meeting_id' => Meeting::inRandomOrder()->value('id'),
            'score' => $this->faker->numberBetween(0, 5),
            'status' => $this->faker->randomElement(['y', 'n']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
