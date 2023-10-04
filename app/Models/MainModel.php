<?php

namespace App\Models;

use App\Traits\Commentable;
use App\Traits\Emojiable;
use App\Traits\HasAddress;
use App\Traits\HasAttachments;
use App\Traits\HasContacts;
use App\Traits\HasDevice;
use App\Traits\HasMessages;
use App\Traits\HasTicket;
use App\Traits\Taggable;
use App\Traits\WorkAtTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MainModel extends Model implements HasMedia
{
    use HasFactory, HasAddress, HasAttachments, HasContacts, Emojiable, HasMessages, Taggable, Commentable, WorkAtTrait ,HasTicket ,HasDevice;
    use InteractsWithMedia;

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function scopeMax($query, $max = 0)
    {
        return $query->where('max_amount', '>', $max);
    }

    public function scopeActive($query, $active = 1)
    {
        return $query->where('active', $active);
    }

    public function scopeApp($query, $active = 1)
    {
        return $query->where('app', $active);
    }

    public function scopeWebsite($query, $active = 1)
    {
        return $query->where('website', $active);
    }

    public function scopeIsFeatured($query, $active = 1)
    {
        return $query->where('is_featured', $active);
    }

    public function scopeNotEnded($query, $date = null)
    {
        return $query->where('end_at','>', Carbon::now());
    }

    public function scopePublished($query, $timezone = 'UTC')
    {
        return $query->where('published_at','<', Carbon::now($timezone));
    }

    public function scopeImage($query,$image ='image')
    {
        return $query->where('type',$image);
    }
    public function scopeVideo($query,$video ='video')
    {
        return $query->where('type',$video);
    }

    public function scopeDraft($query, $draft = 1)
    {
        return $query->where('draft', $draft);
    }

    public function scopeNotMe($query)
    {
        return $query->where('id', '<>', auth()->id());
    }

    public function scopeExclude($query, $value = [])
    {
        return $query->select(array_diff($this->fillable, (array) $value));
    }

    public function scopeRead($query, $is_read = 0)
    {
        return $query->where('is_read', $is_read);
    }

    public function scopeIsClient($query, $is_client = 1)
    {
        return $query->where('is_client', $is_client);
    }

    public function scopeProjectId($query, $project_id = 0)
    {
        return $query->where('project_id', $project_id);
    }

    public function scopeFinish($query, $finish = 1)
    {
        return $query->where('finish', $finish);
    }

    public function scopePaid($query, $is_paid = 1)
    {
        return $query->where('is_paid', $is_paid);
    }

    public function scopeStatus($query, $status = 'request')
    {
        return $query->where('status', $status);
    }

    public function scopeOfType($query, $type = 'client')
    {
        return $query->where('type', $type);
    }

    public function scopeOfTypeArray($query, $type)
    {
        return $query->whereIn('type', $type);
    }

    public function scopeOffer($query, $offer = 1)
    {
        return $query->where('offer', $offer);
    }

    public function scopeSale($query, $sale = 1)
    {
        return $query->where('sale', $sale);
    }

    public function scopeConfirmed($query, $confirmed = 1)
    {
        return $query->where('confirmed', $confirmed);
    }


    public static function updateParentIDType($id, $parent_id, $type = 'posts')
    {
        $model = static::findOrFail($id);
        if ($model->type == $type) {
            $model->parent_id = $parent_id;
            return $model->save();
        }
    }

    public static function updateOrderIDType($id, $order_id, $type = 'posts')
    {
        $model = Static::findOrFail($id);
        if ($model->type == $type) {
            $model->order_id = $order_id;
            return $model->save();
        }
    }

    public static function updateImageType($id, $image, $type = 'posts')
    {
        $model = Static::findOrFail($id);
        if ($model->type == $type) {
            $model->image = $image;
            return $model->save();
        }
    }

    public static function updateUserIDType($id, $model_id, $type = 'posts')
    {
        $model = Static::findOrFail($id);
        if ($model->type == $type) {
            $model->user_id = $model_id;
            return $model->save();
        }
    }

    public static function updateTimeType($id, $model_id, $type = 'posts')
    {
        $model = Static::findOrFail($id);
        if ($model->type == $type) {
            $model->update_at = new Carbon();
            $model->update_by = $model_id;
            return $model->save();
        }
    }

    public static function updateLinkType($id, $link, $type = 'posts')
    {
        $model = Static::findOrFail($id);
        if ($model->type == $type) {
            $model->link = $link;
            return $model->save();
        }
    }

    public static function updateActiveType($id, $active, $type = 'posts')
    {
        $model = Static::findOrFail($id);
        if ($model->type == $type) {
            $model->active = $active;
            return $model->save();
        }
    }

    public static function updateReadType($id, $type = 'posts')
    {
        $model = Static::findOrFail($id);
        if ($model->type == $type) {
            $model->is_read = 1;
            return $model->save();
        }
    }

    public static function countChildType($parent_id, $type = 'posts')
    {
        return Static::where('parent_id', $parent_id)->where('type', $type)->where('active', 1)->count();
    }

    public static function countUnReadType($type = 'posts')
    {
        return Static::where('type', $type)->where('is_read', 0)->count();
    }

    public static function foundDataType($name, $column = 'name', $type = 'posts')
    {
        $model = Static::where($column, $name)->where('type', $type)->first();
        if (isset($model)) {
            return $model->id;
        } else {
            return 0;
        }
    }

    public static function foundDataActiveType($name, $column = 'name', $type = 'posts')
    {
        $model = Static::where($column, $name)->where('type', $type)->where('active', 1)->first();
        if (isset($model)) {
            return $model->id;
        } else {
            return 0;
        }
    }

    public static function updateImage($id, $image)
    {
        $model = Static::findOrFail($id);
        $model->image = $image;
        return $model->save();
    }

    public static function updateParentID($id, $parent_id)
    {
        $model = Static::findOrFail($id);
        $model->parent_id = $parent_id;
        return $model->save();
    }

    public static function updateOrderID($id, $order_id)
    {
        $model = Static::findOrFail($id);
        $model->order_id = $order_id;
        return $model->save();
    }

    public static function updateUserID($id, $model_id)
    {
        $model = Static::findOrFail($id);
        $model->user_id = $model_id;
        return $model->save();
    }

    public static function updateBy($id, $user_id)
    {
        $model = Static::findOrFail($id);
        $model->update_at = new Carbon();
        $model->update_by = $user_id;
        return $model->save();
    }

    public static function updateAt($id)
    {
//        return Static::where('id', $id)->update(['updated_at'=>new Carbon()]);
        $model = Static::findOrFail($id);
        $model->updated_at = new Carbon();
        return $model->save();
    }

    public static function createAt($id)
    {
//        return Static::where('id', $id)->update(['updated_at'=>new Carbon()]);
        $model = Static::findOrFail($id);
        $model->created_at = new Carbon();
        return $model->save();
    }

    public static function updateLink($id, $link)
    {
        $model = Static::findOrFail($id);
        $model->link = $link;
        return $model->save();
    }

    public static function updateActive($id, $active, $column = 'active')
    {
        $model = Static::findOrFail($id);
        $model->$column = $active;
        return $model->save();
    }

    public static function updateCount($id, $column = 'view_count')
    {
        return Static::where('id', $id)->increment($column);
    }

    public static function updateRead($id)
    {
        $model = Static::findOrFail($id);
        $model->is_read = 1;
        return $model->save();
    }

    public static function updateReply($id)
    {
        $model = Static::findOrFail($id);
        $model->is_reply = 1;
        return $model->save();

    }

    public static function countUnRead()
    {
        return Static::where('is_read', 0)->count();
    }

    public static function countUnReadAble($able_type = 'commentable_type', $type = "posts")
    {
        return Static::where($able_type, $type)->where('is_read', 0)->count();
    }

    public static function countUnReply()
    {
        return Static::where('is_reply', 0)->count();
    }

    public static function countChild($parent_id)
    {
        return Static::where('parent_id', $parent_id)->where('active', 1)->count();
    }

    public static function updateColumn($id, $column = "active", $column_value = 1)
    {
        $model = Static::findOrFail($id);
        $model->$column = $column_value;
        return $model->save();
    }

    public static function updateColumnTrash($id, $column, $column_value)
    {
        $model = Static::withTrashed()->findOrFail($id);
        $model->$column = $column_value;
        return $model->save();
    }

    public static function getData($id, $column = 'name')
    {
        $model = Static::where('id', $id)->first();
        if (isset($model)) {
            return $model->$column;
        }
    }

    public static function getDataLocale($id, $column = 'name', $locale = "ar")
    {
        $model = Static::where('id', $id)->first();
        if (isset($model)) {
            return $model->$column[$locale];
        }
    }

    public function getDataID($id, $column = 'name')
    {
        $model = Static::where('id', $id)->first();
        if (isset($model)) {
            return $model->$column;
        }
    }

    public function parentCount($id)
    {
        return Static::where('parent_id', $id)->count();
    }

//    public static function foundKey($name) {
//        $found = Static::where('name', $name)->first();
//        if (isset($found)) {
//            return $found->id;
//        } else {
//            return 0;
//        }
//    }


    public static function foundData($name, $column = 'name')
    {
        $model = Static::where($column, $name)->first();
        if (isset($model)) {
            return $model->id;
        } else {
            return 0;
        }
    }

    public static function foundDataLocale($name, $column = 'name', $locale = 'en')
    {
        $model = Static::where($column, $name)->where('locale', $locale)->first();
        if (isset($model)) {
            return $model->id;
        } else {
            return 0;
        }
    }

    public static function foundDataTypeActive($name, $type = "posts", $column = 'name')
    {
        $model = Static::where($column, $name)->where('type', $type)->where('active', 1)->first();
        if (isset($model)) {
            return $model->id;
        } else {
            return 0;
        }
    }

    public static function foundDataTypeActiveLocale($name, $column = 'name', $type = "posts", $locale = 'en')
    {
        $model = Static::where($column, $name)->where('type', $type)->where('locale', $locale)->where('active', 1)->first();
        if (isset($model)) {
            return $model->id;
        } else {
            return 0;
        }
    }

    public static function foundDataActive($name, $column = 'name')
    {
        $model = Static::where($column, $name)->where('active', 1)->first();
        if (isset($model)) {
            return $model->id;
        } else {
            return 0;
        }
    }

    public static function foundDataActiveLocale($name, $column = 'name', $locale = 'en')
    {
        $model = Static::where($column, $name)->where('locale', $locale)->where('active', 1)->first();
        if (isset($model)) {
            return $model->id;
        } else {
            return 0;
        }
    }

    public static function foundLink($link, $type = "posts")
    {
        $link_found = Static::where('link', $link)->where('type', $type)->first();
        if (isset($link_found)) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function foundLinkLocale($link, $type = "posts", $locale = "ar")
    {
        $link_found = Static::where('link', $link)->where('type', $type)->where('locale', $locale)->first();
        if (isset($link_found)) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function foundLinkNotID($id, $link, $type = "posts")
    {
        $link_found = Static::where('id', '<>', $id)->where('link', $link)->where('type', $type)->first();
        if (isset($link_found)) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function foundLinkLocaleNotID($id, $link, $type = "posts", $locale = "ar")
    {
        $link_found = Static::where('id', '<>', $id)->where('link', $link)->where('type', $type)->where('locale', $locale)->first();
        if (isset($link_found)) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function dateBetween($start, $end)
    {
        $count = Static::select(DB::raw('COUNT(*)  count'))->whereBetween(DB::raw('created_at'), [$start, $end])->get();
        return $count[0]->count;
    }

    public static function lastMonth()
    {
        $month = Carbon::now()->subMonth()->toDateString();
        $date = Carbon::now()->addDay()->toDateString();
        return Self::dateBetween($month, $date);
    }

    public static function lastWeek()
    {
        $week = Carbon::now()->subWeek()->toDateString();
        $date = Carbon::now()->addDay()->toDateString();
        return Self::dateBetween($week, $date);
    }

    public static function lastDay()
    {
        $day = Carbon::now()->subDay()->toDateString();
        $date = Carbon::now()->addDay()->toDateString();
        return Self::dateBetween($day, $date);
    }

    public static function dateBetweenType($start, $end, $type = 'posts')
    {
        $count = Static::select(DB::raw('COUNT(*)  count'))->where('type', $type)->whereBetween(DB::raw('created_at'), [$start, $end])->get();
        return $count[0]->count;
    }

    public static function lastMonthType($type = 'posts')
    {
        $month = Carbon::now()->subMonth()->toDateString();
        $date = Carbon::now()->addDay()->toDateString();
        return Self::dateBetweenType($month, $date, $type);
    }

    public static function lastWeekType($type = 'posts')
    {
        $week = Carbon::now()->subWeek()->toDateString();
        $date = Carbon::now()->addDay()->toDateString();
        return Self::dateBetweenType($week, $date, $type);
    }

    public static function lastDayType($type = 'posts')
    {
        $day = Carbon::now()->subDay()->toDateString();
        $date = Carbon::now()->addDay()->toDateString();
        return Self::dateBetweenType($day, $date, $type);
    }
}
