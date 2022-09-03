<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use  App\Http\Requests\Api\sendNotificationRequest;
use App\Models\classes;
use App\Models\students;
use App\Models\teachers;
use App\Notifications\notificationController;

class alertTeacherToclassRoom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:alertTeachers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $notificationController = new notificationController(
            teachers::all(),
            ['content'=>'the content of notification from schdule'],
            ['type'=>'teacherToClass','teachers_id'=>teachers::first()->id]
        );
        \Log::info('now is: ' . date('Y-m-d H:i:s') . ' the content of notification from schdule' );
        return 0;
    }
}
