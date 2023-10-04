<?php

namespace App\Http\Livewire\Broker;

use App\Http\Livewire\Basic\BasicForm;
use App\Http\Livewire\Branch\Form;
use App\Models\Broker;
use Livewire\Component;

class BrokerForm extends BasicForm
{
    protected $rules = [
        'name' => 'required|string|max:191',
        'phone' => 'required|numeric',
        'accounting_method' => 'required|boolean',
        'percentage' => 'nullable|numeric|between:0,100'
    ];

    public $name ,$phone, $accounting_method = true ,$percentage ;
    public $broker ;

    public function mount($id = null){
        if ($id) {
            $this->broker = Broker::find($id);
            $this->name = $this->broker->name;
            $this->phone = $this->broker->phone;
            $this->accounting_method = $this->broker->accounting_method;
            $this->percentage = $this->broker->percentage;
            $this->title = 'edit';
            $this->button = 'update';
            $this->color = 'primary';
        }
    }
    public function render()
    {
        return view('livewire.broker.broker-form');
    }

    public  function save()
    {
        $validated =  $this->validate();
        if (!$validated['accounting_method']){
            $validated['percentage'] = 0 ;
        }
        if ($this->broker){
            $this->broker->update($validated);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.broker')])]);
        }else{
//            if (Element::where('name',$this->name)->exists()){
//                $this->emit('alert',
//                    ['type' => 'info',  'message' => 'The name has already been taken.']);
//                return back();
//            }
            $broker =  Broker::create($validated);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.created',['model'=>__('names.broker')])]);
        }
        $this->reset();
        return redirect()->route('admin.brokers.index')->with('success', __('تم إضافة وسيط بنجاح'));
    }
}
