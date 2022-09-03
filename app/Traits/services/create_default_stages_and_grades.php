<?php 
namespace App\Traits\services;

use App\Models\stages;
use App\Models\grades;

trait create_default_stages_and_grades{

    public function create_default_stages_and_grades()
    {
        $stages= collect($this->request->stages);
        !$stages->contains('primary') ?:$this->create_primary_stage_primary();
        !$stages->contains('middle') ?:$this->create_preparatory_stage();
        !$stages->contains('secondary') ?:$this->create_secondary_stage();
    }
    private function create_primary_stage_primary()
    {
        $stage= stages::create([
            'name_ar'=>'المرحلة الابتدائية',
            'name_en'=>'primary stage',
            'schools_id'=>$this->school->id,
            'is_active'=>1
        ]);

        grades::insert([
            [
                'name_ar'=>'الصف الاول الابتدائي.',
                'name_en'=>'grade one ',
                'stages_id'=>$stage->id
            ],[
                'name_ar'=>'الصف الثاني الابتدائي',
                'name_en'=>'grade two ',
                'stages_id'=>$stage->id
            ],[
                'name_ar'=>'الصف الثالث الابتدائي',
                'name_en'=>'grade three ',
                'stages_id'=>$stage->id
            ],[
                'name_ar'=>'الصف الرابع الابتدائي',
                'name_en'=>'grade fourth ',
                'stages_id'=>$stage->id
            ],[
                'name_ar'=>'الصف الخامس الابتدائي',
                'name_en'=>'grade fiveth ',
                'stages_id'=>$stage->id
            ],[
                'name_ar'=>'الصف السادس الابتدائي',
                'name_en'=>'grade sixth ',
                'stages_id'=>$stage->id
            ]
        ]);
    }

    private function create_preparatory_stage()
    {
        $stage= stages::create([
            'name_ar'=>'المرحلة الاعدادية',
            'name_en'=>'middle stage',
            'schools_id'=>$this->school->id,
            'is_active'=>1
        ]);

        grades::insert([
            [
                'name_ar'=>'الصف الاول الاعدادي',
                'name_en'=>'grade one middle',
                'stages_id'=>$stage->id
            ],[
                'name_ar'=>'الصف الثاني الاعدادي',
                'name_en'=>'grade two middle',
                'stages_id'=>$stage->id
            ],[
                'name_ar'=>'الصف الثالث الاعدادي',
                'name_en'=>'grade three middle',
                'stages_id'=>$stage->id
            ]
        ]);
    }

    private function create_secondary_stage()
    {
        $stage= stages::create([
            'name_ar'=>'المرحلة الثانوية',
            'name_en'=>'secondary stage',
            'schools_id'=>$this->school->id,
            'is_active'=>1
        ]);

        grades::insert([
            [
            'name_ar'=>'الصف الاول الثانوي',
            'name_en'=>'grade one secondary',
            'stages_id'=>$stage->id
            ],


            [
                'name_ar'=>'الصف الثاني الثانوي - مسار علوم الحاسب والهندسة',
                'name_en'=>'grade two secondary - Computer Science and Engineering',
                'stages_id'=>$stage->id
            ],
            [
                'name_ar'=>'الصف الثاني الثانوي - مسار الصحة والحياة',
                'name_en'=>'grade two secondary - Health and Life',
                'stages_id'=>$stage->id
            ],
            [
                'name_ar'=>'الصف الثاني الثانوي - مسار إدارة الاعمال',
                'name_en'=>'grade two secondary - Business Administration',
                'stages_id'=>$stage->id
            ],
            [
                'name_ar'=>'الصف الثاني الثانوي - المسار الشرعي',
                'name_en'=>"grade two secondary - Shar'i",
                'stages_id'=>$stage->id
            ],


            [
                'name_ar'=>'الصف الثالث الثانوي - مسار علوم الحاسب والهندسة',
                'name_en'=>'grade two secondary - Computer Science and Engineering',
                'stages_id'=>$stage->id
            ],
            [
                'name_ar'=>'الصف الثالث الثانوي - مسار الصحة والحياة',
                'name_en'=>'grade two secondary - Health and Life',
                'stages_id'=>$stage->id
            ],
            [
                'name_ar'=>'الصف الثالث الثانوي - مسار إدارة الاعمال',
                'name_en'=>'grade two secondary - Business Administration',
                'stages_id'=>$stage->id
            ],
            [
                'name_ar'=>'الصف الثالث الثانوي - المسار الشرعي',
                'name_en'=>"grade two secondary - Shar'i",
                'stages_id'=>$stage->id
            ],
        ]);
    }
}