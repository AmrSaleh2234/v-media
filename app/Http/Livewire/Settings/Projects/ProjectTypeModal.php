<?php

namespace App\Http\Livewire\Settings\Projects;

use App\Http\Livewire\Basic\Modal;
use App\Models\CMS\ProjectType;
use Livewire\Component;

class ProjectTypeModal extends Modal
{
    protected $listeners = ['editProjectType' => 'edit','createProjectType' => 'create' ];

    protected $rules = [
        'projectType.name.ar' => 'required|string',
        'projectType.name.en' => 'required|string',
        'projectType.group' => 'required|string',
        ];

    public $projectType,$type ;

    public $title = 'create' ;
    public $button = 'save' ;
    public $color = 'primary';
    /**
     * @var true
     */
    private bool $update = false;

    public function mount($modal_id = null) {
        $this->modal_id = $modal_id;
    }

    public function render()
    {
        return view('livewire.settings.projects.project-type-modal');
    }

    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validated =  $this->validate();

        $exists= ProjectType::where('name', json_encode($validated['projectType']['name']))->first();

        if ($exists){
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.exists',['model'=>__('names.project-type')])]);
            return ;
        }

        if (!$this->type){
            ProjectType::create($validated['projectType']);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.created',['model'=>__('names.project-type')])]);
        }else{
            $this->type->update($validated['projectType']);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.project-type')])]);
        }
        $this->emitTo('settings.projects.project-type-table','refreshProjectTypes',$validated);
        $this->reset('projectType');
        $this->close('ProjectTypeModal');
    }

    public function create()
    {
        $this->loading = true ;
        $this->reset();
        $this->update = false ;
        $this->title = 'create';
        $this->button = 'save';
        $this->color = 'primary';
        $this->open();
        sleep(.5);
        $this->loading = false ;
    }
    public function edit(int $projectTypeId)
    {
        $this->loading = true ;
        $this->reset('projectType');
        $this->update = true ;
        $this->type = ProjectType::where('id', $projectTypeId)->first();
        $this->projectType =    $this->type ;
        $this->title = 'edit';
        $this->button = 'update';
        $this->color = 'primary';
//        $this->dispatchBrowserEvent('openModal');
        $this->open();
        sleep(.5);
        $this->loading = false ;
    }
}

