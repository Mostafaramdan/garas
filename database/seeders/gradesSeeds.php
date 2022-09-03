<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\grades;
use App\Models\stages;

class gradesSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        grades::create([
            'name_ar'=>'الصف الاول',
            'name_en'=>'stage one ',
            'stages_id'=>stages::find(1)->id
        ]);
        grades::create([
            'name_ar'=>'الصف الثاني',
            'name_en'=>'stage two ',
            'stages_id'=>stages::find(1)->id
        ]);
        grades::create([
            'name_ar'=>'الصف الثالث',
            'name_en'=>'stage three ',
            'stages_id'=>stages::find(1)->id
        ]);
        grades::create([
            'name_ar'=>'الصف الرابع',
            'name_en'=>'stage fourth ',
            'stages_id'=>stages::find(1)->id
        ]);
        grades::create([
            'name_ar'=>'الصف الخامس',
            'name_en'=>'stage fiveth ',
            'stages_id'=>stages::find(1)->id
        ]);
        grades::create([
            'name_ar'=>'الصف السادس',
            'name_en'=>'stage sixth ',
            'stages_id'=>stages::find(1)->id
        ]);

        grades::create([
            'name_ar'=>'الصف الاول',
            'name_en'=>'stage one ',
            'stages_id'=>stages::find(2)->id
        ]);
        grades::create([
            'name_ar'=>'الصف الثاني',
            'name_en'=>'stage two ',
            'stages_id'=>stages::find(2)->id
        ]);
        grades::create([
            'name_ar'=>'الصف الثالث',
            'name_en'=>'stage three ',
            'stages_id'=>stages::find(2)->id
        ]);

        grades::create([
            'name_ar'=>'الصف الاول',
            'name_en'=>'stage one ',
            'stages_id'=>stages::find(3)->id
        ]);
        grades::create([
            'name_ar'=>'الصف الثاني',
            'name_en'=>'stage two ',
            'stages_id'=>stages::find(3)->id
        ]);
        grades::create([
            'name_ar'=>'الصف الثالث',
            'name_en'=>'stage three ',
            'stages_id'=>stages::find(3)->id
        ]);
    }
}
