<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_users')->delete();
        
        \DB::table('admin_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'dev',
                'email' => 'dev@sudo.vn',
                'password' => '$2y$10$DXAr7b4CgSOpNqCc60dlvOnFJpHtuxxSiufsrK8xGe80QJIy1Oavy',
                'position' => NULL,
                'display_name' => 'Sudo Developer',
                'phone' => NULL,
                'address' => NULL,
                'birthday' => NULL,
                'avatar' => NULL,
                'infomation' => NULL,
                'social' => NULL,
                'capabilities' => NULL,
                'remember_token' => '8z1dWDXE7s6NOZXo0si5MZLCAFJSojiIVCO8SEFoGT7l9MsGJGtbFpslZmlg',
                'status' => 1,
                'created_at' => '2021-07-05 14:12:20',
                'updated_at' => '2021-07-05 14:12:20',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'sudo',
                'email' => 'sudo@sudo.vn',
                'password' => '$2y$10$HD5gbpCkEe1x/ktxTou2rOezPBoddqnypfv9q6IDuwrBKjGK3PuHK',
                'position' => 'CEO',
                'display_name' => 'Sudo Ecommerce',
                'phone' => NULL,
                'address' => NULL,
                'birthday' => NULL,
                'avatar' => NULL,
                'infomation' => NULL,
                'social' => '{"social_name":"","social_link":""}',
                'capabilities' => '["on","products_index","products_create","products_edit","products_restore","products_delete","on","product_categories_index","product_categories_create","product_categories_edit","product_categories_restore","product_categories_delete","on","attributes_index","attributes_create","attributes_edit","attributes_restore","attributes_delete","on","brands_index","brands_create","brands_edit","brands_restore","brands_delete","on","slides_index","slides_create","slides_edit","slides_restore","slides_delete","on","orders_index","orders_create","orders_edit","orders_restore","orders_delete","on","customers_index","customers_create","customers_edit","customers_restore","customers_delete","on","shippings_index","shippings_create","shippings_edit","shippings_restore","shippings_delete","on","taxes_index","taxes_create","taxes_edit","taxes_restore","taxes_delete","on","posts_index","posts_create","posts_edit","posts_restore","posts_delete","on","post_categories_index","post_categories_create","post_categories_edit","post_categories_restore","post_categories_delete","on","pages_index","pages_create","pages_edit","pages_restore","pages_delete","on","tags_index","tags_create","tags_edit","tags_restore","tags_delete","on","sync_links_index","sync_links_create","sync_links_edit","sync_links_restore","sync_links_delete","on","comments_index","comments_create","comments_edit","comments_restore","comments_delete","on","contacts_index","contacts_edit","contacts_restore","contacts_delete","on","email_registers_index","email_registers_edit","email_registers_restore","email_registers_delete","on","call_me_back_index","call_me_back_create","call_me_back_edit","call_me_back_restore","call_me_back_delete","on","admin_users_index","admin_users_create","admin_users_edit","admin_users_restore","admin_users_delete","on","settings_general","settings_home","settings_menu","settings_contact","settings_overview","on","media_index","on","system_logs_index","system_logs_show"]',
                'remember_token' => NULL,
                'status' => 1,
                'created_at' => '2021-07-05 14:12:20',
                'updated_at' => '2021-07-05 15:00:48',
            ),
        ));
        
        
    }
}