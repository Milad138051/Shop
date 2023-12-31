<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        			  
        DB::statement('truncate posts');
       
        Post::factory(20)->create([
            'author_id'=>1,
            'category_id'=>rand(1,5),
        ]);
    }
}
