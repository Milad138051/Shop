<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Content\PostCategory;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('truncate post_categories');
        $names=['دسته 1','دسته 2','دسته 3','دسته 4','دسته 5'];

        foreach($names as $name)
        {
            PostCategory::factory(1)->create([
                'name'=>$name,
            ]);
        }
    }
}
