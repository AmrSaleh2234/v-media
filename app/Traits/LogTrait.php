<?php

namespace App\Traits;

use App\Models\Log;

trait LogTrait
{
    public function updatedFields($model, $table)
    {
        $user =  auth()->user();
        if(is_null($user)) {
            return ;
        }
        $updated_fields = $model->getChanges();
        if (!empty($updated_fields)) {
            unset($updated_fields['created_at']);
            unset($updated_fields['updated_at']);
            unset($updated_fields['deleted_at']);
            if (!empty($updated_fields)) {
                foreach ($updated_fields as $key => $field) {
                    Log::create([
                        'user_id' => $user->id,
                        'loggable_id' => $model->id,
                        'loggable_type' => $table,
                        'key'  => $key,
                        'value_old' => $model->getOriginal($key),
                        'value' => $field,
                    ]);
                }
            }
        }
    }
}
