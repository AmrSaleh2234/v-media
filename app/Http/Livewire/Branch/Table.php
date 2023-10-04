<?php

namespace App\Http\Livewire\Branch;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\Hr\Branch;
use App\Models\Hr\JobType;
use App\Services\BranchService;

class Table extends BasicTable
{

     protected $listeners = ['confirmDelete'];

    public function render()
    {
        $service = new BranchService();
        return view('livewire.branch.table',[
            'branches' =>$service->search($this->search)
                ->when($this->type !== 'all',function ($query){
                    $query->where('type',$this->type);
                })
                ->with('manager')
                //    ->whereHas("roles", function($q){ $q->whereNotIn("name", ["admin"]); })
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
        ]);
    }

    public function confirmDelete($id)
    {
        $branch = Branch::find($id);
        if ($branch->managements()->exists()) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.branch'),'relation'=>__('names.managements')])]);
            return ;
        } elseif($branch->scopeNumberOfEmps() >= 1) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.branch'),'relation'=>__('names.employees')])]);
            return ;
        } elseif($branch->childern()->exists()) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.branch'),'relation'=>__('names.childrens')])]);
            return ;
        }else{
            $branch->delete();
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.deleted',['model'=>__('names.branch')])]);
        }
        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }

}
