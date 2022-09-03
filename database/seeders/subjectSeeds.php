<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\subjects;

class subjectSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        subjects::create([
            'name_ar'=>'لغة عربية',
            'name_en'=>'arabic ',
            'created_at'=>now(),
        ]);
    }
}
