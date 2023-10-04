<?php

namespace App\Http\Livewire\Basic;

use App\Services\MainService;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class BasicForm extends Component {

    public $title = 'create' ;
    public $button = 'create' ;
    public $color = 'primary';

    public $lang = 'ar';

    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

   public function store($model,$validatedData) {
        try {
            $model->create($validatedData);
            return $model;
        } catch(Exception $e) {
            return $e->getMessage();
        }
   }

   public function update($model,$validatedData) {
        try {
            $model->update($validatedData);
            return $model;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($model, $rel) {
        if($model->$rel) {
            return 0;
        } else {
            $model->delete();
            return 1;
        }
    }
}
