<?php
namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Models\schools;
use Illuminate\Support\Facades\Auth;

class GeneralSettingController 
{
    static function changeLang($lang)
    {
        session()->put('lang', $lang);
        \Config::set('app.locale',$lang);
        return back();
    }
    function changeStatus($model, $col_name, $id  )
    {
        $modelClass= "App\Models\\{$model}";
        $record=$modelClass::find($id);
        
        $record->update([$col_name=>$record->$col_name?0:1]);

        if($model== 'school_timetables'){

            $school_all_timetables= $modelClass::where('schools_id',AuthLogged()->id)->where('is_active',1)->get();
           
            if($school_all_timetables->count() > 1){
                $modelClass::where('schools_id',AuthLogged()->id)
                ->where('is_active',1)
                ->where('id','!=',$record->id)
               ->update(['is_active'=>0]);  //active only this
               
               return $record;
           }else if($school_all_timetables->count() == 0){
            
                $record->update(['is_active'=>1]);  //active only this

           }
       }
    }

    function deleteRecord(Request $request)
    {
        $model= "App\Models\\".str_replace('-','',$request->model) ;
        if($request->has('id'))
            $model::destroy($request->id);
        if($request->has('ids'))
            $model::destroy( explode(',', $request->ids)) ;
        return response()->json(['status'=>200]);
    }

    function loginToSchool(schools $school)
    {
        Auth::logout();
        Auth::guard('school')->login($school);
        return redirect(route('home'));
    }
}
