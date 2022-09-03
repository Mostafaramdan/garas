<?php

namespace App\Observers;

use App\Models\students;
use App\Models\tokens;
use App\Http\Controllers\Apis\Helper\helper;

class studentObserver
{
    function createToken(students $student)
    {
        tokens::where('deviceId',request()->deviceId)
                        ->where('students_id',$student->id)
                        ->delete();
        $token=tokens::create([
            'students_id'=>$student->id,
            'apiToken'=>helper::UniqueRandomXChar(69,'apiToken',[tokens::class]),
            'created_at'=>now(),
            'deviceId'=>request()->deviceId
        ]);
        $student->apiToken= $token->apiToken;

    }
}
