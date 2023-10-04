<?php
namespace App\Services\FCM;

use App\Models\Device;
use App\Models\User;

class FCMService {

    public function sendNotification($to = [], $title = null, $body = null, $type = null, $id = null, $link = null, $toType = "Client" ) {



        if($toType == "Client") {
            if(count($to) == 0) {
                 $to = Device::where('owner_type', 'clients')->pluck('token');
            } else {
                 $to = Device::where('owner_type', 'clients')->whereIn('owner_id', $to)->pluck('token');
            }
            fcm()
                ->to($to)
                ->priority('high')
                ->timeToLive(0)
                ->notification([
                    'title' => $title,
                    'body' => $body,
                ])
                ->data([
                    "type" => $type, // service , project , other
                    "id" => $id,
                    "link" => $link
                ])
            ->send();

            // create notification here ya badr dont forget thaat
            // Notification::create([

            // ]);
            return;
        } else {
             $url = 'https://fcm.googleapis.com/fcm/send';

             if(count($to) == 0) {
                $FcmToken = Device::where('owner_type', 'users')->pluck('token');
             } else {
                $FcmToken = Device::where('owner_type', 'users')->whereIn('owner_id', $to)->pluck('token');
             }


             $serverKey =
             'AAAArnXaTYo:APA91bG4YXH_5Jn_QmjbWml9qvJS1sVIfghnKWPWru341k_-rygViWhwjRnsC2tZzb2Ohld0OU3n8WXTxt6jnM2ZrWmIXEbM592i3qaDTbn_0sS7mjKkqrVwiAKO43sSaGxgNSUIOpiN';

             $data = [
             "registration_ids" => $FcmToken,
             "notification" => [
                "title" => $title,
                "body" => $body,
             ]
             ];
             $encodedData = json_encode($data);

             $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
             ];

             $ch = curl_init();

             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
             curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
             // Disabling SSL Certificate support temporarly
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
             // Execute post
             $result = curl_exec($ch);
             if ($result === FALSE) {
             die('Curl failed: ' . curl_error($ch));
             }
             // Close connection
             curl_close($ch);
             // FCM response
             return;
        }


    }

}
