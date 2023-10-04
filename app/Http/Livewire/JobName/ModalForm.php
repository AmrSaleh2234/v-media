<?php

namespace App\Http\Livewire\JobName;

use App\Http\Livewire\Basic\Modal;
use App\Models\Hr\JobName;
use App\Models\Hr\JobType;
use Livewire\Component;

class ModalForm extends Modal
{
    protected $listeners = ['editJobName' => 'edit','createJobName' => 'create' ];

    protected $rules = [
        'name' => 'required',
        'active' => 'required',
        'job_type_id' => 'required|exists:job_types,id'
    ];
    public $jobName ;
    public $name , $job_type_id , $jobTypes ;

    public $active = 1;

    public $title = 'create' ;
    public $button = 'save' ;
    public $color = 'primary';

    public function mount($modal_id = null) {
        $this->modal_id = $modal_id;
        $this->jobTypes = JobType::active()->get(['id','name']);
    }

    public function render()
    {
        return view('livewire.job-name.modal-form');
    }

    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validated =  $this->validate();
        if (!$this->jobName){
           $exists= JobName::where('name',$this->name)->where('job_type_id',$this->job_type_id)->first();
           if ($exists){
               $this->dispatchBrowserEvent('toastr',
                   ['type' => 'warning',  'message' =>__('message.exists',['model'=>__('names.job-name')])]);
               return ;
           }
            JobName::create($validated);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.created',['model'=>__('names.job-name')])]);
        }else{
            $this->jobName->update($validated);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.job-name')])]);
        }
        $this->emitTo('job-name.table','refreshJopNames');
        $this->reset('name','active','job_type_id');
        $this->close($this->modal_id);
    }

    public function create()
    {
        $this->loading = true ;
        $this->reset('job_type_id','name','active','jobName');
        $this->title = 'create';
        $this->button = 'save';
        $this->color = 'primary';
        $this->open();
//        sleep(.5);
        $this->loading = false ;
    }
    public function edit(int $jobNameId)
    {
        $this->loading = true ;
        $this->reset('jobName','name','active','job_type_id');
        $this->jobName = JobName::where('id', $jobNameId)->first();
        $this->name =  $this->jobName->name;
        $this->active =  $this->jobName->active;
        $this->job_type_id =  $this->jobName->job_type_id;
        $this->title = 'edit';
        $this->button = 'update';
        $this->color = 'primary';
//        $this->dispatchBrowserEvent('openModal');
        $this->open();
//        sleep(.5);
        $this->loading = false ;
    }
}
