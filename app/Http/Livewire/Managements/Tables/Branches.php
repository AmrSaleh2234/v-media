<?php

namespace App\Http\Livewire\Managements\Tables;

use App\Http\Livewire\Basic\BasicTable;
use App\Services\BranchService;
use Livewire\Component;

class Branches extends BasicTable
{
    // public $branches;
    // private $branchesService;

    public function mount() {
        // $this->branchesService = new BranchService();
        // $this->branches = $this->branchesService->fetchWithCounts();
    }
    public function render()
    {
        $branchesService = new BranchService();
        return view('livewire.managements.tables.branches',[
            'branches' => $branchesService->fetchWithCounts()->when($this->start_date,function ($query){
            $query->where('created_at','>=',$this->start_date);
            })
            ->when($this->end_date,function ($query){
            $query->where('created_at','<=',$this->end_date);
                })
                ->when( !empty($this->status_id) ,function ($query){
                $query->where('status_id','>=',$this->status_id);
                })
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
        ]);
    }
}
