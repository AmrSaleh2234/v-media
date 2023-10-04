<?php

namespace App\Http\Livewire\Roles;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Table extends BasicTable
{
    protected $listeners = ['confirmDelete'];


    public function mount() {

    }

    public function render()
    {
        return view('livewire.roles.table',[
            'roles' => Role::get(),
        ]);
    }

    public function confirmDelete($id) {
        $role = Role::findOrFail($id);
        if(User::role($role)->exists()) {
            $this->dispatchBrowserEvent('toastr',
            ['type' => 'error', 'message' =>__('message.still-has',['model'=>__('names.role'), 'Relation' => __('names.user')])]);
            return;
        } else {
            $role->delete();
             $this->dispatchBrowserEvent('toastr',
             ['type' => 'success', 'message' => __('message.deleted', ['model' => __('names.role')])]);
             return;
        }
    }
}
