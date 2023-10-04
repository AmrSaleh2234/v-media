<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends MainModelSoft
{
    protected $table = 'settings';
    protected $fillable = [
        'group','type','key', 'value','locale','autoload','parent_id'
    ];

    protected $casts = ['value'=>'array'];
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
    public function insertSetting($type, $key,$value,$autoload = 1,$group = NULL,$locale = 'en',$parent_id = NULL) {

        $this->type    = $type;
        $this->key     = $key;
        $this->value   = $value;
        $this->group   = $group;
        $this->locale          = $locale;
        $this->autoload        = $autoload;
        $this->parent_id       = $parent_id;
        return $this->save();
    }

    public static function updateSetting($key,$value,$autoload =  1,$group = NULL,$locale = 'ar',$parent_id = NULL) {
        $setting = Static::where('type', $key)->where('key', $key)->first();
        if (isset($setting)) {
            $setting->value   = $value;
            $setting->group   = $group;
            $setting->autoload        = $autoload;
            $setting->parent_id       = $parent_id;
            return $setting->save();
        } else {
            $insert = new Setting();
            return $insert->insertSetting($key, $key,$value,$autoload,$group,$locale,$parent_id);
        }

    }

    public static function updateSettinglocale($key,$value,$autoload =  1,$group = NULL,$locale = 'ar',$parent_id = NULL) {
        $setting = Static::where('type', $key)->where('key', $key)->where('locale', $locale)->first();
        if (isset($setting)) {
            $setting->value   = $value;
            $setting->group   = $group;
            $setting->autoload        = $autoload;
            $setting->parent_id       = $parent_id;
            return $setting->save();
        } else {
            $insert = new Setting();
            return $insert->insertSetting($key, $key,$value,$autoload,$group,$locale,$parent_id);
        }

    }

    public function deleteSetting($type) {
        return Static::where('type', $type)->delete();

    }

    public function deleteSettingGroup($group) {
        return Static::where('group', $group)->delete();

    }

    public function deleteSettingParent($parent_id) {
        return Static::where('parent_id', $parent_id)->delete();

    }

    public function deleteSettingLocale($type,$locale = 'ar') {
        return Static::where('type', $type)->where('locale', $locale)->delete();

    }

    public function deleteSettingGroupLocale($group,$locale = 'ar') {
        return Static::where('group', $group)->where('locale', $locale)->delete();

    }

    public function deleteSettingParentLocale($parent_id,$locale = 'ar') {
        return Static::where('parent_id', $parent_id)->where('locale', $locale)->delete();

    }

    public function parentID() {
        return $this->belongsTo(Setting::class, 'parent_id')->withDefault(['name' => __('None')]);
    }
}
