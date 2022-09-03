<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\stages;

class stagesSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        stages::create([
            'name_ar'=>'المرحلة الابتدائية',
            'name_en'=>'primary stage',
            'is_active'=>1
        ]);
        stages::create([
            'name_ar'=>'المرحلة الاعدادية',
            'name_en'=>'primary stage',
            'is_active'=>1
        ]);
        stages::create([
            'name_ar'=>'المرحلة الثانوية',
            'name_en'=>'primary stage',
            'is_active'=>1
        ]);
    }
}
