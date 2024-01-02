<?php

namespace Database\Seeders;

use App\Models\Market\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('truncate categories');
        $names=['دسته محصول 1','دسته محصول 2','دسته محصول 3','دسته محصول 4','دسته محصول 5'];

        foreach($names as $name)
        {
            Category::factory(1)->create([
                'name'=>$name,
            ]);
        }
    }
}
