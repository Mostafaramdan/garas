<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

use App\Models\AppSetting;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppSetting::create([
            'email'     => 'Garas@mgdsoft.com',
            'phone'     => '009600000000',
            'Classrooms_Count' => 30,
            'time_of_classroom' => Carbon::now()->format('H:i:s'),
            'start_day' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
