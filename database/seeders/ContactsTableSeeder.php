<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contacts')->delete();
        
        \DB::table('contacts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Sudo 1',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn1',
                'subject' => 'Khởi tạo dữ liệu mẫu 1',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 1',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Sudo 2',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn2',
                'subject' => 'Khởi tạo dữ liệu mẫu 2',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 2',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Sudo 3',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn3',
                'subject' => 'Khởi tạo dữ liệu mẫu 3',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 3',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Sudo 4',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn4',
                'subject' => 'Khởi tạo dữ liệu mẫu 4',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 4',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Sudo 5',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn5',
                'subject' => 'Khởi tạo dữ liệu mẫu 5',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 5',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Sudo 6',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn6',
                'subject' => 'Khởi tạo dữ liệu mẫu 6',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 6',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Sudo 7',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn7',
                'subject' => 'Khởi tạo dữ liệu mẫu 7',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 7',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Sudo 8',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn8',
                'subject' => 'Khởi tạo dữ liệu mẫu 8',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 8',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Sudo 9',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn9',
                'subject' => 'Khởi tạo dữ liệu mẫu 9',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 9',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Sudo 10',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn10',
                'subject' => 'Khởi tạo dữ liệu mẫu 10',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 10',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Sudo 11',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn11',
                'subject' => 'Khởi tạo dữ liệu mẫu 11',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 11',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Sudo 12',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn12',
                'subject' => 'Khởi tạo dữ liệu mẫu 12',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 12',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Sudo 13',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn13',
                'subject' => 'Khởi tạo dữ liệu mẫu 13',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 13',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Sudo 14',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn14',
                'subject' => 'Khởi tạo dữ liệu mẫu 14',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 14',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Sudo 15',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn15',
                'subject' => 'Khởi tạo dữ liệu mẫu 15',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 15',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Sudo 16',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn16',
                'subject' => 'Khởi tạo dữ liệu mẫu 16',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 16',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Sudo 17',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn17',
                'subject' => 'Khởi tạo dữ liệu mẫu 17',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 17',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Sudo 18',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn18',
                'subject' => 'Khởi tạo dữ liệu mẫu 18',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 18',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Sudo 19',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn19',
                'subject' => 'Khởi tạo dữ liệu mẫu 19',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 19',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Sudo 20',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn20',
                'subject' => 'Khởi tạo dữ liệu mẫu 20',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 20',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Sudo 21',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn21',
                'subject' => 'Khởi tạo dữ liệu mẫu 21',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 21',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Sudo 22',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn22',
                'subject' => 'Khởi tạo dữ liệu mẫu 22',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 22',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Sudo 23',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn23',
                'subject' => 'Khởi tạo dữ liệu mẫu 23',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 23',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Sudo 24',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn24',
                'subject' => 'Khởi tạo dữ liệu mẫu 24',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 24',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Sudo 25',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn25',
                'subject' => 'Khởi tạo dữ liệu mẫu 25',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 25',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Sudo 26',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn26',
                'subject' => 'Khởi tạo dữ liệu mẫu 26',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 26',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Sudo 27',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn27',
                'subject' => 'Khởi tạo dữ liệu mẫu 27',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 27',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Sudo 28',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn28',
                'subject' => 'Khởi tạo dữ liệu mẫu 28',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 28',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Sudo 29',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn29',
                'subject' => 'Khởi tạo dữ liệu mẫu 29',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 29',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Sudo 30',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn30',
                'subject' => 'Khởi tạo dữ liệu mẫu 30',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 30',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Sudo 31',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn31',
                'subject' => 'Khởi tạo dữ liệu mẫu 31',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 31',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Sudo 32',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn32',
                'subject' => 'Khởi tạo dữ liệu mẫu 32',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 32',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Sudo 33',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn33',
                'subject' => 'Khởi tạo dữ liệu mẫu 33',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 33',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Sudo 34',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn34',
                'subject' => 'Khởi tạo dữ liệu mẫu 34',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 34',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Sudo 35',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn35',
                'subject' => 'Khởi tạo dữ liệu mẫu 35',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 35',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Sudo 36',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn36',
                'subject' => 'Khởi tạo dữ liệu mẫu 36',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 36',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Sudo 37',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn37',
                'subject' => 'Khởi tạo dữ liệu mẫu 37',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 37',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Sudo 38',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn38',
                'subject' => 'Khởi tạo dữ liệu mẫu 38',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 38',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Sudo 39',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn39',
                'subject' => 'Khởi tạo dữ liệu mẫu 39',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 39',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Sudo 40',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn40',
                'subject' => 'Khởi tạo dữ liệu mẫu 40',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 40',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Sudo 41',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn41',
                'subject' => 'Khởi tạo dữ liệu mẫu 41',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 41',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Sudo 42',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn42',
                'subject' => 'Khởi tạo dữ liệu mẫu 42',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 42',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Sudo 43',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn43',
                'subject' => 'Khởi tạo dữ liệu mẫu 43',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 43',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Sudo 44',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn44',
                'subject' => 'Khởi tạo dữ liệu mẫu 44',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 44',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Sudo 45',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn45',
                'subject' => 'Khởi tạo dữ liệu mẫu 45',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 45',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Sudo 46',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn46',
                'subject' => 'Khởi tạo dữ liệu mẫu 46',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 46',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Sudo 47',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn47',
                'subject' => 'Khởi tạo dữ liệu mẫu 47',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 47',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Sudo 48',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn48',
                'subject' => 'Khởi tạo dữ liệu mẫu 48',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 48',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Sudo 49',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn49',
                'subject' => 'Khởi tạo dữ liệu mẫu 49',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 49',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Sudo 50',
                'phone' => '0123456789',
                'email' => 'info@sudo.vn50',
                'subject' => 'Khởi tạo dữ liệu mẫu 50',
                'content' => 'Khởi tạo nội dung dữ liệu mẫu 50',
                'status' => 1,
                'created_at' => '2021-07-05 15:00:20',
                'updated_at' => '2021-07-05 15:00:20',
            ),
        ));
        
        
    }
}