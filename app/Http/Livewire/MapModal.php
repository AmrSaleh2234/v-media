<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Basic\Modal;
use Livewire\Component;

class MapModal extends Modal
{

    public $modal_id;
    public $title_in;

    public function mount($modal_id = null, $title_in = null) {
        $this->modal_id = $modal_id;
        $this->title_in = $title_in;
    }
    public function render()
    {
        return view('livewire.map-modal');
    }
}
