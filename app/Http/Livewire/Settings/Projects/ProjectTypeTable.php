<?php

namespace App\Http\Livewire\Settings\Projects;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\CMS\ProjectType;
use App\Services\CMS\ProjectTypeService;
use Livewire\Component;

class ProjectTypeTable extends BasicTable
{
    protected $listeners = ['refreshProjectTypes' => '$refresh','confirmDelete'];
    public function render()
    {
        $service = new ProjectTypeService();
        return view('livewire.settings.projects.project-type-table',[
            'projectsTypes' => $service->search($this->search)
                ->when($this->start_date,function ($query){
                    $query->where('created_at',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at',$this->end_date);
                })
                ->withCount('companyProjects')
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
        ]);
    }

    public function create()
    {
        $this->emitTo('settings.projects.project-type-modal','createProjectType',);
    }
    public function edit(int $projectTypeId)
    {
        $this->emitTo('settings.projects.project-type-modal','editProjectType',$projectTypeId);
    }


    public function confirmDelete($id)
    {
        $projectType = ProjectType::find($id);
        if ($projectType->companyProjects()->exists()) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.project-type'),'relation'=>__('names.projects')])]);
            return ;
        } else{
            $projectType->delete();
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.deleted',['model'=>__('names.project-type')])]);
        }
        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }
}
