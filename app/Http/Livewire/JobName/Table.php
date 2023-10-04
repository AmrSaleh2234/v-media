<?php

namespace App\Http\Livewire\JobName;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\Hr\JobName;
use App\Services\JobNameService;
use Livewire\Component;

class Table extends BasicTable
{
    protected $listeners = ['refreshJopNames' => '$refresh','confirmDelete'];
    public function render()
    {
        $service = new JobNameService();
        return view('livewire.job-name.table',[
            'jobNames' => $service->search($this->search)
                ->with('jobType')
                ->withCount('employees')
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
        ]);
    }

    public function create()
    {
        $this->emitTo('job-name.modal-form','createJobName',);
    }
    public function edit(int $jobNameId)
    {
        $this->emitTo('job-name.modal-form','editJobName',$jobNameId);
    }


    public function confirmDelete($id)
    {
        $jobName = JobName::find($id);
        if ($jobName->employees()->exists()) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.job-name'),'relation'=>__('names.employee')])]);
            return ;
        }else{
            $jobName->delete();
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.deleted',['model'=>__('names.job-name')])]);
        }
        // Perform the deletion action



        // Refresh the component to reflect the updated data

        $this->emitSelf('$refresh');
    }
}
