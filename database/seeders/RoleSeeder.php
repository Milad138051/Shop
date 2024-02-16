<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('truncate roles');
		$roles=['content-admin','market-admin','super-admin','acl-admin','ticket-admin'];
		foreach($roles as $role){
		     DB::table('roles')->insert([
            'name' =>$role,
            'description' => 'توضیحات',
            'status' => 1,
        ]); 	
		}
    }
}
