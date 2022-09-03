<?php 
namespace App\Traits\services;

use App\Models\stages;
use App\Models\grades;
use App\Models\subjects;

trait create_default_subjects{
    private function create_default_subjects()
    {
        $default_subjects = json_decode(file_get_contents(public_path('/default_subjects.json')),true);
        $this->school->refresh();
        $stages= $this->school->stages;

        if($stages->where('name_en','primary stage')->count() > 0){
            $primary_stage= $stages->where('name_en','primary stage')->first();
            $primary_stage->refresh();
            foreach($default_subjects['primary_stage']['subjects'] as $default_subject){
                subjects::updateOrCreate([
                    'schools_id'=>$this->school->id,
                    'name_ar'=>$default_subject['name_ar'],
                    'name_en'=>$default_subject['name_en'],
                ]);
            }
        }
        if($stages->where('name_en','middle stage')->count() > 0){
            $middle_stage= $stages->where('name_en','middle stage')->first();
            $middle_stage->refresh();
            foreach($default_subjects['middle_stage']['subjects'] as $default_subject){
                subjects::updateOrCreate([
                    'schools_id'=>$this->school->id,
                    'name_ar'=>$default_subject['name_ar'],
                    'name_en'=>$default_subject['name_en'],
                ]);
            }
        }

        if($stages->where('name_en','secondary stage')->count() > 0){
            $secondary_stage= $stages->where('name_en','secondary stage')->first();
            $secondary_stage->refresh();
            foreach($default_subjects['secondary_stage']['subjects'] as $default_subject){
                subjects::updateOrCreate([
                    'schools_id'=>$this->school->id,
                    'name_ar'=>$default_subject['name_ar'],
                    'name_en'=>$default_subject['name_en'],
                ]);
            }
            foreach($default_subjects['secondary_stage_engineering']['subjects'] as $default_subject){
                subjects::updateOrCreate([
                    'schools_id'=>$this->school->id,
                    'name_ar'=>$default_subject['name_ar'],
                    'name_en'=>$default_subject['name_en'],
                ]);
            }
            foreach($default_subjects['secondary_stage_health']['subjects'] as $default_subject){
                subjects::updateOrCreate([
                    'schools_id'=>$this->school->id,
                    'name_ar'=>$default_subject['name_ar'],
                    'name_en'=>$default_subject['name_en'],
                ]);
            }
            foreach($default_subjects['secondary_stage_business']['subjects'] as $default_subject){
                subjects::updateOrCreate([
                    'schools_id'=>$this->school->id,
                    'name_ar'=>$default_subject['name_ar'],
                    'name_en'=>$default_subject['name_en'],
                ]);
            }
            foreach($default_subjects['secondary_stage_shar']['subjects'] as $default_subject){
                subjects::updateOrCreate([
                    'schools_id'=>$this->school->id,
                    'name_ar'=>$default_subject['name_ar'],
                    'name_en'=>$default_subject['name_en'],
                ]);
            }
        }

    }

}