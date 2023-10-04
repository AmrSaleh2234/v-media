<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\User;
use App\Services\UserService;
use Livewire\Component;

class UsersTable extends BasicTable
{
    protected $listeners = ['refreshUsers' => '$refresh','confirmDelete'];

    public function render()
    {
        $service = new UserService();
        return view('livewire.users.users-table',[
            'users' => $service->search($this->search)
                ->when($this->start_date,function ($query){
                    $query->where('created_at',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at',$this->end_date);
                })
                ->with(['employee' => fn($q) => $q->select('employees.id','employees.first_name')])
                ->withCount('roles')
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
        ]);
    }

    public function toggle($id){
       $user = User::find($id);
        $user->active = !$user->active ;
        $user->save();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.user')])]);
        return ;
    }

    public function confirmDelete($id){
        $user = User::find($id);
        if ($user->employee()->exists()){
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.user'),'relation'=>__('names.employee')])]);
            return ;
        }

    }

}
