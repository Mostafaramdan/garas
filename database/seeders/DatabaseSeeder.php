<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(adminsSeeds::class);
        $this->call(AppSettingSeeder::class);
        // $this->call(stagesSeeds::class);
        // $this->call(gradesSeeds::class);
        // $this->call(classesSeeds::class);
        // $this->call(teacherSeeds::class);
       

    }
}
