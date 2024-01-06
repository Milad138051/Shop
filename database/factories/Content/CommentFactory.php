<?php

namespace Database\Factories\Content;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'body'=>fake()->text(),
            'author_id'=>1,
            'commentable_type'=>'App\Models\Content\Post',
            'approved'=>1,
            'status'=>1

        ];
    }
}
