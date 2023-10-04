<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Exception;
//use Illuminate\Database\Query\Builder;

trait HelperTrait
{

    function pointLocation($polygons_db)
    {

        $all_polygons = [];
        $polygons = str_replace("},{", "}/{", $polygons_db);
        $pieces = explode("/", $polygons);
        if (!empty($pieces)) {
            foreach ($pieces as $piece) {
                $str = '[' . $piece . ']';
                $str = str_replace('{ lat', '{"lat', $str);
                $str = str_replace(':', '":"', $str);
                $str = str_replace(',', '","', $str);
                $str = str_replace('}', ' "}', $str);
                $str = str_replace(' ', '', $str);
                $str = str_replace('lng', 'lng', $str);
                $all_polygons[] = json_decode($str, true)[0];
            }
        }
        return $all_polygons;
    }

    function pointLocationV2($polygons_db)
    {

        $str = json_encode($polygons_db);
        $str = str_replace('{"', '{', $str);
        $str = str_replace('"}', '}', $str);
        $str = str_replace('"lat:"', 'lat:', $str);
        $str = str_replace('"lng:"', 'lng:', $str);
        $str = str_replace('","', ',', $str);
        $str = str_replace('":"', ':', $str);
        return $str;
    }

    public function uploadImage($image, $folder_path = "", $is_upload = 1)
    {
        $upload = "/uploads/";
        if ($folder_path != "") {
            $upload = "/uploads/" . $folder_path . "/";
        }
        $name = str_random(8);
        $path = public_path() . $upload;

        if ($is_upload == 0) {
            $extension = pathinfo($image, PATHINFO_EXTENSION);
        } else {
            $extension = $image->getClientOriginalExtension();
        }
        $filename = $name . '.' . $extension;
        if ($is_upload == 0) {
            $img = Image::make($image);
        } else {
            $img = Image::make($image->getRealPath());
        }
        // $img->resize(100, 100);
        $img->save($path . $filename);
        return $upload . $filename;
    }

    public function deleteFile($file)
    {
        if ($file != NULL && $file != "") {
            return File::delete(public_path() . $file);
        }
    }




    public function oldUploadFile($file, $folder_path = "")
    {
        $upload = "/uploads/files/";
        if ($folder_path != "") {
            $upload = "/uploads/files/" . $folder_path . "/";
        }
        $name = str_random(8);
        $path = public_path() . $upload;
        $extension = $file->getClientOriginalExtension();
        $filename = $name . '.' . $extension;
        $file->store($path, $filename);
        return $upload . $filename;
    }

    public function contentImage($content_replace, $image_before = 'src="../../uploads')
    {
        // $image_after = "src=" . $this->site_url . "/uploads";
        $image_after = "src=/uploads";
        $content = str_replace($image_before, $image_after, $content_replace);
        return stripslashes($content);
    }

    public function getImage($image)
    {
        if ($image != "" && $image != NULL) {
            return str_replace(url(''), "", $image);
        }
    }

    public function getImagePath($request, $folder_path = "posts", $file = "image", $is_upload = 1)
    {
        $path = NULL;
        if ($request->hasFile($file)) {
            $image = $request->file($file);
            $path = $this->uploadImage($image, $folder_path, $is_upload);
        }
        return $path;
    }

    public function getName($name_ar, $name_en)
    {
        return array(
            'ar' => htmlspecialchars($name_ar, ENT_NOQUOTES, "UTF-8"),
            'en' => trim(filter_var($name_en, FILTER_SANITIZE_STRING))
        );
    }

    public function getContent($name_ar, $name_en)
    {
        return array(
            'ar' => trim($name_ar),
            'en' => trim($name_en),
        );
    }

    public function whereID($data_all, int $id, $table = NULL)
    {
        return $id > 0 ? $data_all->where(($table ? $table . '.' : '') . 'id', $id) : $data_all;
    }

    public function whereUser($data_all, int $user_id, $table = NULL)
    {
        return $user_id > 0 ? $data_all->where(($table ? $table . '.' : '') . 'user_id', $user_id) : $data_all;
    }

    public function whereSearch($data_all, $search, $table)
    {
        if ($search != 'ar' && $search != 'en' && $search != "") {
            $searchValues = preg_split('/\s+/', $search, -1, PREG_SPLIT_NO_EMPTY);
            $data_all->where(function ($query) use ($searchValues, $table) {
                foreach ($searchValues as $value) {
                    $query->orWhere($table . ".name", 'like', '%' . $value . '%');
                    //->orWhere($table.'.content', 'like', '%' . $value . '%');
                }
            });
        }
        return $data_all;
    }

    public function whereActive($data_all, int $active, $table = NULL)
    {
        return $active > -1 ? $data_all->where(($table ? $table . '.' : '') . 'active', $active) : $data_all;
    }

    public function whereFeature($data_all, int $feature, $table = NULL)
    {
        return $feature > -1 ? $data_all->where(($table ? $table . '.' : '') . 'feature', $feature) : $data_all;
    }

    public function whereStatus($data_all, $status, $table = NULL, $opertaion = "=")
    {
        $table = $table ? $table . '.' : '';
        if ($status) {
            $data_all->where($table . 'status', $opertaion, $status);
        }
        return $data_all;
    }

    public function whereType($data_all, $type, $table = NULL, $opertaion = "=")
    {
        $table = $table ? $table . '.' : '';
        if ($type) {
            $data_all->where($table . 'type', $opertaion, $type);
        }
        return $data_all;
    }

    public function whereEmail($data_all, $email, $table = NULL)
    {
        $table = $table ? $table . '.' : '';
        if ($email) {
            $data_all->where($table . 'email', $email);
        }
        return $data_all;
    }

    public function wherePhone($data_all, $phone, $table = NULL)
    {
        $table = $table ? $table . '.' : '';
        if ($phone) {
            $data_all->where($table . 'phone', $phone);
        }
        return $data_all;
    }

    public function whereName($data_all, $name, $table = NULL)
    {
        $table = $table ? $table . '.' : '';
        if ($name) {
            $data_all->where($table . 'name', $name);
        }
        return $data_all;
    }

    public function wherePhones($data_all, $phone, $table = NULL, $phone_type = ["phone", "phone_2", "phone_3"])
    {
        if ($phone != "" && !empty($phone_type)) {
            $table = $table ? $table . '.' : '';
            $data_all->where(function ($query) use ($phone, $phone_type, $table) {
                foreach ($phone_type as $value) {
                    $query->orWhere($table . $value, 'like', '%' . $phone . '%');
                }
            });
        }
        return $data_all;
    }

    public function whereParent($data_all, $parent, $id, $table = NULL, $is_parent_id = true)
    {
        $table = $table ? $table . '.' : '';
        if ($is_parent_id == true) {
            if ($parent == false) {
                if ($id > 0) {
                    $data_all->where($table . '.parent_id', $id);
                } else {
                    $data_all->whereNull($table . '.parent_id');
                }
            } else {
                $data_all->where($table . '.id', $id);
            }
        } else {
            $data_all->whereNotNull('parent_id');
        }
        return $data_all;
    }

    public function whereLike($data_all, $name, $column = "name", $table = "users", $start_with = false)
    {

        if ($name != 'ar' && $name != 'en' && $name != "") {
            $searchValues = preg_split('/\s+/', $name, -1, PREG_SPLIT_NO_EMPTY);
            $data_all->where(function ($query) use ($searchValues, $table, $column, $start_with) {
                foreach ($searchValues as $value) {
                    if ($start_with != false) {
                        $query->orWhere($table . "." . $column, 'like', $value . '%');
                    } else {
                        $query->orWhere($table . "." . $column, 'like', '%' . $value . '%');
                    }
                }
            });
        }

        return $data_all;
    }


    public function dateFilter($data_all, $date_start, $date_end, $table = "users", $column_start = "created_at", $column_end = "created_at", $is_range = "no", $operator_start = ">=", $operator_end = "<=")
    {
        if ($date_start != '' || $date_end != '') {
            if ($date_start == $date_end) {
                if ($is_range == "no") {
                    $operator_start = $operator_end = "=";
                }
                $data_all->whereDate($table . '.' . $column_start, $operator_start, $date_start);
                $data_all->whereDate($table . '.' . $column_end, $operator_end, $date_end);
            } else {
                if ($date_start != '') {
                    $data_all->whereDate($table . '.' . $column_start, $operator_start, $date_start);
                }
                if ($date_end != '' && ($date_start == '' || $date_end > $date_start)) {
                    $data_all->whereDate($table . '.' . $column_end, $operator_end, $date_end);
                }
            }
        }
        return $data_all;
    }

    public function whereRead($data_all, $is_read = -1, $table = NULL)
    {
        return $is_read > 0 ? $data_all->where(($table ? $table . '.' : '') . 'is_read', $is_read) : $data_all;
    }

    public function getInputKey($input, $except_array = [])
    {
        foreach ($input as $key => $value) {
            if (!in_array($key, $except_array)) {
                $input[$key] = stripslashes(trim(filter_var($value, FILTER_SANITIZE_STRING)));
            }
        }
        return $input;
    }

    public function whereFieldName($data_all, $name = "", $field = "name", $table = NULL)
    {
        $table = $table ? $table . '.' : '';
        if ($name) {
            $data_all->where($table . $field, $name);
        }
        return $data_all;
    }

    public function whereFieldActive($data_all, $name = -1, $field = "active", $table = NULL)
    {
        return $name > -1 ? $data_all->where(($table ? $table . '.' : '') . $field, $name) : $data_all;

    }

    public function whereFieldModel($data_all, $name = 0, $field = "user_id", $table = NULL)
    {
        return $name > 0 ? $data_all->where(($table ? $table . '.' : '') . $field, $name) : $data_all;
    }
}
