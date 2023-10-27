<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $userIds = User::all()->pluck('id')->toArray();
        $postIds = Post::all()->pluck('id')->toArray();

        return [
            'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'body' => $this->faker->text(50),
            'user_id' => $this->faker->randomElement($userIds),
            'post_id' => $this->faker->randomElement($postIds),
        ];
    }
}
