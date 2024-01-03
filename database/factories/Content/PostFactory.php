<?php

namespace Database\Factories\Content;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->title(),
            'summary'=>'...خلاصه',
            'body'=>fake()->text(),
            'status'=>1,
            'commentable'=>1,
            'published_at'=>now(),
            'tags'=>'tag1,tag2'
        ];
    }
}
