<?php

	use Illuminate\Support\Facades\Auth;
	use App\Models\schools;
	use App\Models\admins;
	use App\Models\school_timetables;

	//singloTon desgin pattern
	class Authentication{
		private static $Auth;
		private function __construct()
		{
			
		}

		public static function getAuth()
		{
			if(!self::$Auth)
			{

				if(Auth::check()){

					self::$Auth= admins::find(Auth::user()->id);
				
				}elseif( Auth::guard('school')->check()){
					self::$Auth= schools::
						without(['class_rooms_in_days','grade_subject','subjects','stages'])
						->whereId(Auth::guard('school')->user()->id)
						->first();
					$school_timetableId= school_timetables::orderBy('id','DESC')
                                    ->where('is_active',1)
									->where('schools_id',self::$Auth->id)
                                    ->get(['id'])
                                    ->first();
					
					self::$Auth->last_school_timetableId =$school_timetableId->id??0;

				}else{ 

					self::$Auth= NULL;

				}
			}
			return self::$Auth;
		}

		public static function setAuth($auth)
		{
			if(!self::$Auth)
				self::$Auth= $auth;
		}

	}