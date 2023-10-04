<?php

namespace App\Http\Livewire\Settings\Projects;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\CMS\CompanyProject;
use App\Models\CMS\ProjectType;
use App\Services\CMS\CompanyProjectService;
use Livewire\Component;

class ProjectsTable extends BasicTable
{
    protected $listeners = ['confirmDelete'];

    public function mount()
    {
        $this->perPage = 8 ;
    }
    public function render()
    {
        $service = new CompanyProjectService();
//        dd(CompanyProject::all());
        return view('livewire.settings.projects.projects-table',[
            'companyProjects' => $service->search($this->search)
//                ->confirmed()
//                ->with('broker','status','branch')
                ->when($this->start_date,function ($query){
                    $query->where('created_at','>=',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at','<=',$this->end_date);
                })
//                ->when( !empty($this->status_id)   ,function ($query){
//                    $query->where('status_id','>=',$this->status_id);
//                })
                ->select(['id','name','main_image','description'])
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
            'projectTypes' => ProjectType::withCount('companyProjects')->get()
        ]);
    }

    public function confirmDelete($id)
    {
        $project = CompanyProject::find($id);
//        dd($project);
        if ($project->app) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.project'),'relation'=>__('names.application')])]);
            return ;
        } elseif($project->website) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.project'),'relation'=>__('names.website')])]);
            return ;
        }
//        elseif($project->companyProjects()->exists()) {
//            $this->dispatchBrowserEvent('toastr',
//                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.service'),'relation'=>__('names.projects')])]);
//            return ;
//        }
        $project->delete();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.deleted',['model'=>'project'])]);
        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }
}
