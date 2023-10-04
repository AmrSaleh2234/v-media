<?php

namespace App\Http\Livewire\JobGrade;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\Hr\JobGrade;
use App\Models\Hr\JobName;
use App\Services\JobGradeService;
use Livewire\Component;

class JobGradeTable extends BasicTable
{

    protected $listeners = ['refreshJopGrades' => '$refresh','confirmDelete'];
    public function render()
    {
        $service = new JobGradeService();
        return view('livewire.job-grade.job-grade-table',[
            'jobGrades' => $service->search($this->search)
                ->with('jobType','grade')
                ->withCount('employees')
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
        ]);
    }

    public function create()
    {
        $this->emitTo('job-grade.job-grade-modal','createJobGrade',);
    }
    public function edit(int $jobGradeId)
    {
        $this->emitTo('job-grade.job-grade-modal','editJobGrade',$jobGradeId);
    }


    public function confirmDelete($id)
    {
        $jobName = JobName::find($id);
        if ($jobName->employees()->exists()) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.job-grade'),'relation'=>__('names.employees')])]);
            return ;
        }else{
            $jobName->delete();
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.deleted',['model'=>__('names.job-grade')])]);
        }

        $this->emitSelf('$refresh');
    }
}
