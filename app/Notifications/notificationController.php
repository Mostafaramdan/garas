<?php

namespace App\Notifications;

use App\Models\notifications;
use App\Models\notify;
use Illuminate\Database\Eloquent\Collection;

class notificationController
{
    private array $content, $types;
    private Collection $targets;
    private notifications $notifications;

    function __construct ($targets,$content,$types)
    {
        $this->targets = $targets;
        $this->content = $content;
        $this->types = $types;
        $this->createNotification();
    }
    private function createNotification()
    {
        $data=[];
        foreach($this->types as $k=>$v){
            $data[$k]=$v;
        }
        foreach($this->content as $k=>$v){
            $data[$k]=$v;

        }
        $this->notifications = notifications::create($data);
        $this->notify_target();

    }

    private function notify_target()
    {
        $data=[];
        foreach($this->targets as $target){
            $data[]=[
                'notifications_id'=>$this->notifications->id,
                $target->getTable().'_id'=>$target->id,
            ];
        }
        notify::insert($data);

    }

	public static function sendFCM() {
		$url = 'https://fcm.googleapis.com/fcm/send';
		$registration_ids= collect($this->targets)->pluck('firebaseToken');

		$fields = [
            "registration_ids" => $registration_ids ,
			"notification" => [
				"title" =>"Gars",
				"body" => $this->notification->content,
				"icon" => "myicon",
				"sound" => "notify.mp3"
			]
		];
		$fields = json_encode ( $fields );
		$key = 'AAAAHy8tKgQ:APA91bGnFzdgmfd7r69WVbD-rdQDCiCaYde6fqXeB1iVYs0HjOT0ZJsRW5iOLcHBoia8L8B2H-WP902OBZDsf4lXwuuZF7Zon2ha0KoYfhVFak_IHpEtJ0kwZFzTpfXvDwUM8bLBvF0h';
		$headers = [
			'Authorization: key='.$key,
			'Content-Type: application/json'
		];
		$ch = curl_init();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
	}

}

