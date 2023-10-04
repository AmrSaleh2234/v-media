<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends MainModelSoft
{
    use HasFactory;

    protected $table = 'attachments';
    protected $fillable = [ 'user_id', 'attachable_id', 'attachable_type','type', 'path','size','original_name','extension'];

    public function attachable()
    {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'attachable')->withTrashed();
    }

    protected function size(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => size($value),
//            set: fn (string $value) => $value,
        );
    }


    public function insertattachment($user_id, $attachable_id,$attachable_type, $type, $key, $value) {

        $this->user_id = $user_id;
        $this->attachable_id = $attachable_id;
        $this->attachable_type = $attachable_type;
        $this->type  = $type;
        $this->key   = $key;
        $this->value = $value;
        return $this->save();
    }

    public static function updateattachment($user_id,$attachable_id,$attachable_type, $type, $key, $value) {
        $attachment = static::where('user_id', $user_id)->where('attachable_id', $attachable_id)->where('attachable_type', $attachable_type)->where('type', $type)->first();
        $attachment_id = 0;
        if (isset($attachment)) {
            $attachment->key = $key;
            $attachment->value = $value;
            $attachment->save();
            $attachment_id = $attachment->id;
        } else {
            $insert = new attachment();
            $insert->insertattachment($user_id,$attachable_id,$attachable_type, $type, $key, $value);
            $attachment_id = $insert->id;
        }
        return $attachment_id;
    }

    public static function deleteattachmentable($attachable_id,$attachable_type) {
        return static::where('attachable_id', $attachable_id)->where('attachable_type', $attachable_type)->delete();
    }

    public static function deleteattachment($attachable_id,$attachable_type, $type) {
        return static::where('attachable_id', $attachable_id)->where('attachable_type', $attachable_type)->where('type', $type)->delete();
    }

    public static function foundattachment($user_id,$attachable_id,$attachable_type,$type) {
        $attachment = static::where('user_id', $user_id)->where('attachable_id', $attachable_id)->where('attachable_type', $attachable_type)->where('type', $type)->first();
        if (isset($attachment)) {
            return $attachment->id;
        } else {
            return 0;
        }
    }
}
