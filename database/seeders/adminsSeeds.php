<?php

namespace Database\Seeders;

use App\Models\admins;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class adminsSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        admins::create([
            'name'=>'demo',
            'email'=>'demo@magdsoft.com',
            'password'=>bcrypt('123456'), 
            'is_active'=>1,
            'phone' => "+966532653262",
            'created_at'=>now()
        ]);
    }
}
