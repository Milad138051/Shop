<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\CommentSeeder;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\PostCategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        // $this->call(UserSeeder::class);
         $this->call(PostCategorySeeder::class);
         $this->call(PostSeeder::class);
         $this->call(CommentSeeder::class);

         Schema::enableForeignKeyConstraints();
    }
}
