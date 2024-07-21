<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class UsersSeeder extends Seeder
{ 
    public function run()
    {
   
    Users::insert([
        'id' => Str::uuid()->toString(),
        'first_name' => 'kalp',
        'email' => 'kalp@theopeneyes.com',
        'pin' =>random_int(100000, 999999),
        'created_by' => '1',
        'updated_by' => '1'
    ]);
    Users::insert([
        'id' => Str::uuid()->toString(),
        'first_name' => 'mitesh',
        'email' => 'mitesh@theopeneyes.com',
        'pin' =>random_int(100000, 999999),
        'created_by' => '1',
        'updated_by' => '1'
    ]);
    Users::insert([
        'id' => Str::uuid()->toString(),
        'first_name' => 'john',
        'email' => 'john12@gmail.com',
        'pin' =>random_int(100000, 999999),
        'created_by' => '1',
        'updated_by' => '1'
    ]);
}
}
