<?php

namespace App\Http\Livewire\JobType;

use App\Http\Livewire\Basic\Modal;
use App\Models\Hr\Job;
use App\Models\Hr\JobType;
use Livewire\Component;

class ModalForm extends Modal
{
    protected $listeners = ['editJobType' => 'edit','createJobType' => 'create' ];

    protected $rules = [
        'name' => 'required',
        'active' => 'required'
    ];

    public $jobType ;
    public $name ;
    public $active = 1;

    public $title = 'create' ;
    public $button = 'save' ;
    public $color = 'primary';

    public function mount($modal_id = null) {
        $this->modal_id = $modal_id;
    }

    public function render()
    {
        return view('livewire.job-type.modal-form');
    }

    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validated =  $this->validate();
        if (!$this->jobType){
            $exists= JobType::where('name',$this->name)->first();
            if ($exists){
                $this->dispatchBrowserEvent('toastr',
                    ['type' => 'warning',  'message' =>__('message.exists',['model'=>__('names.job-type')])]);
                return ;
            }
            JobType::create($validated);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.created',['model'=>__('names.job-type')])]);
        }else{
            $this->jobType->update($validated);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.job-type')])]);
        }
        $this->emitTo('job-type.table','refreshJopTypes',$validated);
        $this->reset('name','active','jobType');
        $this->close('JobTypeModal');
    }

    public function create()
    {
        $this->loading = true ;
        $this->reset();
        $this->title = 'create';
        $this->button = 'save';
        $this->color = 'primary';
        $this->open();
        sleep(.5);
        $this->loading = false ;
    }
    public function edit(int $jobTypeId)
    {
        $this->loading = true ;
        $this->reset('jobType','name','active');
        $this->jobType = JobType::where('id', $jobTypeId)->first();
        $this->name =  $this->jobType->name;
        $this->active =  $this->jobType->active;
        $this->title = 'edit';
        $this->button = 'update';
        $this->color = 'primary';
//        $this->dispatchBrowserEvent('openModal');
        $this->open();
        sleep(.5);
        $this->loading = false ;
    }
}
