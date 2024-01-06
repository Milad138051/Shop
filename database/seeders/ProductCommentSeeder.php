<?php

namespace Database\Seeders;

use App\Models\Market\Product;
use App\Models\Content\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $products=Product::all();

        foreach($products as $product)
        {
            DB::table('comments')->insert([
                'body'=>'comment body',
                'author_id'=>1,
                'commentable_id'=>$product->id,
                'commentable_type'=>'App\Models\Market\product',
                'approved'=>1,
                'status'=>1
    
            ]);
        } 
       }
}
