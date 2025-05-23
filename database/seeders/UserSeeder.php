<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminlocal'),
            'role' => 'admin'
        ],
        [
            'name' => 'waluyo',
            'email' => 'waluyo@gmail.com',
            'password' => Hash::make('waluyolocal'),
            'role' => 'operator'
        ],
        [
            'name' => 'sukamto',
            'email' => 'sukamto@gmail.com',
            'password' => Hash::make('sukamto'),
            'role' => 'user'
        ]

    ]);
    }
}
