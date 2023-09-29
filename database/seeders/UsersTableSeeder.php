<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin
            [
                'name'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('barry1710'),
                'role'=>'admin',
                'status'=>'active',
            ],
            // User
            [
                'name'=>'user',
                'email'=>'user@gmail.com',
                'password'=>Hash::make('barry1710'),
                'role'=>'user',
                'status'=>'active',
            ],
        ]);
        DB::table('book_areas')->insert([
            // Admin
            [
                'image'=>'Hello',
                'short_title'=>'admin@gmail.com',
                'short_description'=>'gfgfg',
                'main_title'=>'admgfgfin',
                'link_url'=>'getaff',
            ],
        ]);
    }
}
