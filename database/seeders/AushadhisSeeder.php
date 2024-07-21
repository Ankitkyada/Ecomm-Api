<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\aushadhis;
use Illuminate\Support\Str; 



class AushadhisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
        public function run()
    {
   
    aushadhis::insert([
        'aushadhi_group_id' => Str::uuid()->toString(),
        'created_by' => '1',
        'updated_by' => '1'
    ]);
    aushadhis::insert([
        'aushadhi_group_id' => Str::uuid()->toString(),
        'created_by' => '1',
        'updated_by' => '1'
    ]);
    aushadhis::insert([
        'aushadhi_group_id' => Str::uuid()->toString(),
        'created_by' => '1',
        'updated_by' => '1'
    ]);
    aushadhis::insert([
        'aushadhi_group_id' => Str::uuid()->toString(),
        'created_by' => '1',
        'updated_by' => '1'
    ]);
}

}
