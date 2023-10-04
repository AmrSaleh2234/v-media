<?php

namespace App\Http\Livewire\JobGrade;

use App\Http\Livewire\Basic\Modal;
use App\Models\Hr\Grade;
use App\Models\Hr\JobGrade;
use App\Models\Hr\JobType;
use App\Models\Tag;
use Livewire\Component;
use mysql_xdevapi\Collection;

class JobGradeModal extends Modal
{

    protected $listeners = ['editJobGrade' => 'edit','createJobGrade' => 'create' ];

    protected $rules = [
//        'name' => 'required',
//        'active' => 'required',
        'years' => 'required|numeric',
        'salary' => 'required|numeric',
        'grade_id' => 'required|exists:grades,id',
        'job_type_id' => 'required|exists:job_types,id',
//        'tags' => 'nullable|array',
    ];
    public $jobGrade ;
    public  $salary,$years ,$grade_id, $job_type_id , $jobTypes ,$grades ,$searchTags  ;

    public  $tags =[] ;
    public $tags_query = '';

    public $title = 'create' ;
    public $button = 'save' ;
    public $color = 'primary';

    public function mount($modal_id = null) {
        $this->modal_id = $modal_id;
        $this->jobTypes = JobType::active()->get(['id','name']);
        $this->grades = Grade::active()->get(['id','name']);
    }

    public function render()
    {
        return view('livewire.job-grade.job-grade-modal');
    }

    public function updatedTagsQuery()
    {
        $this->searchTags = Tag::where('name' ,'like', '%'.$this->tags_query.'%')->where('type','job_grades')->take(6)->get();
    }

    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addTag($tagId = null)
    {
        if(!$tagId){
           $tag = Tag::create([
                'name' => $this->tags_query,
               'type' => 'job_grades'
            ]);
        }else{
            $tag = Tag::findOrFail($tagId);
        }
        if (isset($this->tags[$tagId])) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error', 'message' => 'Certificate Already Selected!']);
            return back();
        }
//        $this->tags->push($tag);
        $this->tags[$tag->id] = $tag->name ;
        $this->tags_query = '';
    }

    public function removeTag($index)
    {
        unset($this->tags[$index]);
    }

    public function save()
    {
        $validated =  $this->validate();
        if (!$this->jobGrade){
            $exists= JobGrade::where('grade_id',$this->grade_id)->where('job_type_id',$this->job_type_id)->first();
            if ($exists){
                $this->dispatchBrowserEvent('toastr',
                    ['type' => 'warning',  'message' =>__('message.exists',['model'=>__('names.job-grade')])]);
                return ;
            }
          $jobGrade =  JobGrade::create($validated);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.created',['model'=>__('names.job-grade')])]);
        }else{
            $this->jobGrade->update($validated);
            $jobGrade =  $this->jobGrade;
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.job-grade')])]);
        }
            $ids = [];
            foreach ($this->tags as $id => $name){
                $ids[] = $id;
            }
            $jobGrade->tags()->sync($ids);


        $this->emitTo('job-grade.job-grade-table','refreshJopGrades');
        $this->reset('jobGrade','years','salary','grade_id','job_type_id','tags');
        $this->close($this->modal_id);
    }

    public function create()
    {
//        $this->loading = true ;
        $this->reset('jobGrade','years','salary','grade_id','job_type_id','tags_query','searchTags');
        $this->title = 'create';
        $this->button = 'save';
        $this->color = 'primary';
        $this->open();
//        sleep(.5);
//        $this->loading = false ;
    }
    public function edit(int $jobGradeId)
    {
//        $this->loading = true ;
        $this->reset('jobGrade','years','salary','grade_id','job_type_id','tags','tags_query','searchTags');
        $this->jobGrade = JobGrade::where('id', $jobGradeId)->with('tags')->first();
        foreach ($this->jobGrade->tags as $tag){
            $this->tags[$tag->id] = $tag->name ;
        }
        $this->salary =  $this->jobGrade->salary;
        $this->years =  $this->jobGrade->years;
        $this->job_type_id =  $this->jobGrade->job_type_id;
        $this->grade_id =  $this->jobGrade->grade_id;
        $this->title = 'edit';
        $this->button = 'update';
        $this->color = 'primary';
//        $this->dispatchBrowserEvent('openModal');
        $this->open();
//        sleep(.5);
//        $this->loading = false ;
    }
}
