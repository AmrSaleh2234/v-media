<?php

namespace App\Http\Livewire\JobType;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\Hr\JobType;
use App\Services\JobTypeService;
use Livewire\Component;

class Table extends BasicTable
{
    protected $listeners = ['refreshJopTypes' => '$refresh','confirmDelete'];
    public function render()
    {
        $service = new JobTypeService();
        return view('livewire.job-type.table',[
            'jobTypes' => $service->search($this->search)
                ->when($this->start_date,function ($query){
                    $query->where('created_at',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at',$this->end_date);
                })
                ->with(['jobNames' => fn($query) => $query->withCount('employees')])
                ->withCount('employees')
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
        ]);
    }

    public function create()
    {
        $this->emitTo('job-type.modal-form','createJobType',);
    }
    public function edit(int $jobTypeId)
    {
        $this->emitTo('job-type.modal-form','editJobType',$jobTypeId);
    }


    public function confirmDelete($id)
    {
        $jobType = JobType::find($id);
        if ($jobType->jobNames()->exists()) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.job-type'),'relation'=>__('names.job-name')])]);
            return ;
        } elseif($jobType->jobGrades()->exists()) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.job-type'),'relation'=>__('names.job-grade')])]);
            return ;
        }else{
            $jobType->delete();
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.deleted',['model'=>__('names.job-type')])]);
        }
        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }
}
