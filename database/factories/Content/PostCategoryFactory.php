<?php

namespace Database\Factories\Content;

use Illuminate\Database\Eloquent\Factories\Factory;


class PostCategoryFactory extends Factory
{

    public function definition(): array
    {
        return [
            'description'=>fake()->text(),
            'status'=>1
        ];
    }
}
