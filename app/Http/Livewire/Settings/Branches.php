<?php

namespace App\Http\Livewire\Settings;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Hr\Branch;
use Livewire\Component;

class Branches extends BasicForm
{
    public $branch,$branch_id;
    public $status;
    public $share_client ,$share_service,$share_paper,$share_shift,$share_manager;
    protected $rules = [
        'branch' => 'required',
        'branch_id' => 'required',
        'status' => 'required',
        'share_client' => 'nullable|boolean',
        'share_service' => 'nullable|boolean',
        'share_paper' => 'nullable|boolean',
        'share_shift' => 'nullable|boolean',
        'share_manager' => 'nullable|boolean',
    ];

    public function mount(){
        $this->status = 1;
        $this->share_client = 0;
        $this->share_service =0;
        $this->share_paper = 0;
        $this->share_shift = 0;
        $this->share_manager = 0;
    }

    public function render()
    {
        return view('livewire.settings.branches', [
            'branches' => Branch::pluck('name', 'id')->toArray()
        ]);
    }

    public function updatedBranchId($value)
    {
        if (!empty($value)){
            $this->branch = Branch::find($value);
            $this->share_client =$this->branch->share_client;
            $this->share_service =$this->branch->share_service;
            $this->share_paper =$this->branch->share_paper;
            $this->share_shift =$this->branch->share_shift;
            $this->share_manager =$this->branch->share_manager;
            $this->status = $this->branch->active;
        }else{
            $this->status = 1;
            $this->share_client = 0;
            $this->share_service =0;
            $this->share_paper = 0;
            $this->share_shift = 0;
            $this->share_manager = 0;
        }
    }

    public function save(){
        $input =(array) [
            'share_client'=>  $this->share_client ,
            'share_service'=>  $this->share_service,
            'share_paper'=> $this->share_paper,
            'share_shift'=> $this->share_shift,
            'share_manager'=> $this->share_manager,
            'active'=>$this->status];
//        dd($input);
        if(!empty($this->branch)){
            $this->branch->update($input);
        }else{
           $branches = Branch::all();
            $branches->each(function ($br) use ($input){
                $br->update($input);
            });
        }
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.branches')])]);
    }

}
