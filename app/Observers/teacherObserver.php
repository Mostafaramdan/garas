<?php
namespace App\Observers;

use App\Models\teachers;
use App\Models\tokens;
use App\Http\Controllers\Apis\Helper\helper;

class teacherObserver
{
    function createToken(teachers $teacher)
    {
        tokens::where('deviceId',request()->deviceId)
            ->where('teachers_id',$teacher->id)
            ->delete();
        $token=tokens::create([
            'teachers_id'=>$teacher->id,
            'apiToken'=>helper::UniqueRandomXChar(69,'apiToken',[tokens::class]),
            'created_at'=>now(),
            'deviceId'=>request()->deviceId
        ]);

        $teacher->apiToken= $token->apiToken;
    }
    function creating(teachers $teacher)
    {
        $teacher->code= UniqueRandomXDigits(5,'code',['teachers']);
        $teacher->schools_id= AuthLogged()->id;
    }
   
}
