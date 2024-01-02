<?php

namespace Database\Seeders;

use App\Models\Market\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('truncate brands');
        // $persianNames=['برند 1','برند 2','برند 3','برند 4','برند 5'];
        // $englishNames=['brand 1','brand 2','brand 3','brand 4','brand 5'];

        $arrays=[
        'brand 1'=>'برند 1',
        'brand 2'=>'برند 2',
        'brand 3'=>'برند 3',
        'brand 4'=>'برند 4',
        'brand 5'=>'برند 5'
        ];

        foreach($arrays as $key=>$i)
        {
            // foreach ($englishNames as $englishName) {
                Brand::factory(1)->create([
                    'original_name'=>$key,
                    'persian_name'=>$i
                ]);            
            // }
        }
    }
}
