<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public function render()
    {
        return view('livewire.counter');
    }

    public function toast()
    {
        $this->dispatchBrowserEvent('toast',
            ['type' => 'success',  'message' => 'Going Well!' ,'title'=>'title']);
    }
}
