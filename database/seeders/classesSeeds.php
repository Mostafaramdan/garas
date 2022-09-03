<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\classes;
use App\Models\grades;

class classesSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        classes::create([
            'name_ar'=>'1/أ ',
            'name_en'=>'1/A',
            'code'=>'12345',
            'grades_id'=>grades::first()->id
        ]);
    }
}
