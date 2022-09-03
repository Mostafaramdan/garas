<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\teachers;
use App\Models\subjects;
use App\Models\teacher_subject;
use App\Models\class_rooms_tables;
use App\Models\classes;

class teacherSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        teachers::withoutEvents(function(){
            teachers::create([
                'name'=>'mohamed',
                'is_active'=>1,
                'created_at'=>now(),
                'code'=>12345
            ]);
        });

        subjects::create([
            'name_ar'=>'لغة عربية',
            'name_en'=>'arabic ',
            'created_at'=>now(),
        ]);
        teacher_subject::create([
            'teachers_id'=>teachers::first()->id,
            'subjects_id'=>subjects::first()->id,
        ]);
        class_rooms_tables::create([
            'day'=>'Monday',
            'teachers_id'=>teachers::first()->id,
            'subjects_id'=>subjects::first()->id,
            'classes_id'=>classes::first()->id,
            'class_number'=>'1',

        ]);
        
    }
}
