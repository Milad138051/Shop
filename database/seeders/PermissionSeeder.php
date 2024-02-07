<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('truncate permissions');
		$permissions=[
		'create-post','edit-post','delete-post','show-post',
		'create-postCategory','edit-postCategory','delete-postCategory','show-postCategory',
		'show-postComment','answer-postComment','approved-postComment',

		'create-productCategory','edit-productCategory','delete-productCategory','show-productCategory',
		'create-brand','edit-brand','delete-brand','show-brand',
		'create-product','edit-product','delete-product','show-product','guarantee-product','color-product','gallery-product',
        'create-property','edit-property','delete-property','show-property','value-option',
        'show-productComment','answer-productComment','approved-productComment',
        'show-questionAnswer','answer-questionAnswer','approved-questionAnswer',
		'create-delivery','edit-delivery','delete-delivery','show-delivery',
		'create-banner','edit-banner','delete-banner','show-banner',
		'create-copan','edit-copan','delete-copan','show-copan',
		'create-amazingSale','edit-amazingSale','delete-amazingSale','show-amazingSale',
		'create-commonDiscount','edit-commonDiscount','delete-commonDiscount','show-commonDiscount',
		'store-show',
		'payment-show',
		'order-show',
		'show-faq',
		'permission-show','role-show','users-show','admin-user-show','acl',
		'ticket-show','ticket-answer','ticket-change',
		'ticket-admin-show','ticket-admin-set',
		];
		foreach($permissions as $permission){
		     DB::table('permissions')->insert([
            'name' =>$permission,
            'description' => 'توضیحات',
            'status' => 1,
        ]); 	
		}
    }
}
