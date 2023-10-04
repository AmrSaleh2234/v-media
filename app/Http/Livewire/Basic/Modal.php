<?php

namespace App\Http\Livewire\Basic;

use Livewire\Component;

class Modal extends Component
{
    public $updateMode = false;
    public $loading = true;
    public $modal_id ;

    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function open()
    {
        $this->updateMode = true;
    }

    public function close($modal_id)
    {
        $this->updateMode = false;
        $this->dispatchBrowserEvent('closeModal',['id'=>$modal_id]);
    }

}
