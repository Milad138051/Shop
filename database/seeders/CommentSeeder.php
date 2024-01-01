<?php

namespace Database\Seeders;

use App\Models\Content\Comment;
use App\Models\Content\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('truncate comments');

        $posts=Post::all();

        foreach($posts as $post)
        {
            Comment::factory(2)->create([
                'commentable_id'=>$post->id,
            ]);
        }
    }
}
