<?php

namespace App\Traits;

use FCM;
use App\Models\User;
use App\Models\Device;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\DB;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;
use LaravelFCM\Message\PayloadNotificationBuilder;

trait NotifiTrait
{

    use HelperTrait;
    protected $android_devices= ['android', 'all'];
    protected $android_device= ['android'];
    protected $ios_devices= ['apple', 'ios', 'all'];
    protected $ios_device= ['apple', 'ios'];
    public function notificationUserType($user_type = "all")
    {
        $user_ids = [];
        if (in_array($user_type,["client","employee","all"])) {
            User::active()->chunk(9999, function ($query) use (&$user_ids) {
                $user_ids +=  $query->pluck('id')->toArray();
            });
        }
        return $user_ids;
    }

    public function notificationUser($user_id, $title, $message, $type = "admin", $type_id = null, $status = null, $model = null, $image = null, $database = true, $firebase = true, $imei = null, $device = "all",$badge_count =1)
    {
        if (is_array($user_id)) {
            $user_ids = $user_id;
        } else {
            $user_ids[$user_id] = $user_id;
            $badge = DatabaseNotification::where('notifiable_id', $user_id)->where('notifiable_type', 'users')->whereNull('read_at')->count();
            $badge_count = (int) sum($badge,1);
        }
        $notifi = [
            'title' => $title,
            'body' => $message,
            'type' => $type,
            'type_id' => $type_id,
            'status' => $status,
            'model' => $model,
            'image' => $image
        ];

        $notifimobile = [
            'title' => $title,
            'body' => $message,
            'type' => $type,
            'type_id' => $type_id,
            'status' => $status,
            'model' => $model,
            'image' => $image,
            "sound"  => "default",
            // "status" => "done",
            "screen" => "screenA",
            'priority' => 'high',
            "mutable-content" => 1,
            "content-available" => 1,
            "badge"=> $badge_count,
        ];
        $notifi_success = 0;
        $devices = Device::whereIn('user_id', $user_ids)->whereNotNull('token');
        if ($imei != null) {
            $devices->where('imei', '<>', $imei);
        }
        if ($device != "all") {
            $devices->where('type', $device);
        }
        $device_count = $devices->count();
        if ($database == true) {
            // $model = 'App\Notifications\\'.ucfirst($type)."Notification";
            $model = 'App\Notifications\\' . NotificationsModel($type);
            User::active()->whereIn('id', $user_ids)->select('id')->chunk(9999, function ($query) use ($model, $notifi) {
                Notification::send($query, new $model($notifi));
            });
        }
        $ssl_certificate = DB::table('settings')->where('key', 'ssl_certificate')->value('value');
        if ($ssl_certificate != "yes") {
            $ssl_certificate = "no";
        }
        if ($device_count > 0 && $firebase == true && $ssl_certificate == "yes") {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60 * 30)->setPriority('high')->setMutableContent(1);
            $notificationBuilder = new PayloadNotificationBuilder();
            $notificationBuilder->setTitle($title)->setBody($message)->setBadge($badge_count)->setSound('default');
            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData($notifimobile);
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            return $this->notificationDevice($user_ids, $option, $notification, $data, $notifi_success, $imei, $device);
        }
        return $notifi_success;
    }

    public function notificationMessage($lang, $name_notify, $message_notify)
    {
        app()->setLocale("en");
        $name_en = __($name_notify);
        $content_en = __($message_notify);
        app()->setLocale("ar");
        $name_ar = __($name_notify);
        $content_ar = __($message_notify);
        app()->setLocale($lang);
        $title   = $this->getName($name_ar, $name_en);
        $message = $this->getName($content_ar, $content_en);
        $notify = ['title' => $title, 'message' => $message];
        return $notify;
    }

    public function notificationDevice($user_ids, $option, $notification, $data, $notifi_success, $imei, $device = "all")
    {
        $devices = Device::whereIn('user_id', $user_ids)->whereNotNull('token');
        if ($imei != null) {
            $devices->where('imei', '<>', $imei);
        }
        if ($device != "all") {
            $devices->where('type', $device);
        }
        $devices->chunk(99999, function ($query) use ($option, $notification, $data, &$notifi_success, $device) {
            if (in_array($device,$this->android_devices)) {
                $tokens     = $query->whereIn('type', $this->android_device)->pluck('token')->toArray();
                if (!empty($tokens)) {
                    $downstream_response = FCM::sendTo($tokens, $option, null, $data);
                    $notifi_success += $downstream_response->numberSuccess();
                    $delete_tokens  = $downstream_response->tokensToDelete();
                    if (!empty($delete_tokens)) {
                        Device::whereIn('token', $delete_tokens)->delete();
                    }
                }
            }
            if (in_array($device,$this->ios_devices)) {
                $tokens_ios = $query->whereIn('type',$this->ios_device)->pluck('token')->toArray();
                if (!empty($tokens_ios)) {
                    $downstream_response_ios = FCM::sendTo($tokens_ios, $option, $notification, $data);
                    $notifi_success += $downstream_response_ios->numberSuccess();
                    $delete_tokens_ios  = $downstream_response_ios->tokensToDelete();
                    if (!empty($delete_tokens_ios)) {
                        Device::whereIn('token', $delete_tokens_ios)->delete();
                    }
                }
            }
            return $notifi_success;
        });
    }
}
