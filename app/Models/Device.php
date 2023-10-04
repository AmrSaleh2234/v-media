<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends MainModel
{
    protected $fillable = [
        'owner_id','owner_type', 'imei', 'token', 'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function insertDevice($owner_id,$owner_type, $imei,$token,$type = NULL){
        $this->owner_id      = $owner_id;
        $this->owner_type      = $owner_type;
        $this->imei         = $imei;
        $this->token        = $token;
        $this->type         = $type;
        return $this->save();
    }

    public static function updateDevice($owner_id,$owner_type, $imei,$token,$type = NULL) {

        $device_update = static::where('owner_id', $owner_id)->where('owner_type',$owner_type)->where('imei', $imei)->first();
        if (isset($device_update)) {
            $device_update->token = $token;
            $device_update->type  = $type;
             $device_update->save();
            return $device_update ;
        } else {
            $device_insert = new Device();
            $device_insert->insertDevice($owner_id,$owner_type, $imei,$token,$type);
            return $device_insert ;
        }
    }

    public static function foundDevice($user_id, $imei) {
        $device_found = static::where('user_id', $user_id)->where('imei', $imei)->first();
        if (isset($device_found)) {
            return $device_found->id;
        } else {
            return 0;
        }
    }

    public static function deleteAllDevice($user_id) {
        return static::where('user_id', $user_id)->delete();
    }

    public static function deleteAllOtherDevice($user_id,$imei) {
        return static::where('user_id', $user_id)->where('imei','<>', $imei)->delete();
    }

    public static function deleteDevice($user_id, $imei) {
        return static::where('user_id', $user_id)->where('imei', $imei)->delete();
    }
}
