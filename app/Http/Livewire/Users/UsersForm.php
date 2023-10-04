<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UsersForm extends BasicForm
{

    protected $rules = [
        'name' => 'required|string|max:191',
        'role_id' => 'nullable|exists:roles,id',
    ];

    public $name ,$role_id ;
    public $user ;

    public function mount($id = null){
        if ($id) {
            $this->user = User::find($id);
            $this->name = $this->user->name;
            $this->role_id = $this->user->roles()->value('id');
            $this->title = 'edit';
            $this->button = 'update';
            $this->color = 'primary';
        }
    }
    public function render()
    {
        return view('livewire.users.users-form',
        ['roles' => Role::pluck('name','id')->toArray()]);
    }

    public  function save()
    {
        $validated =  $this->validate();
        if (empty($validated['role_id'])){
            $this->user->roles()->detach();
        }else{



        if ($this->user){
            $this->user->roles()->sync($validated['role_id']);
//            $this->user->update($validated);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.user')])]);
        }else{
//            User::create($validated);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.created',['model'=>__('names.user')])]);
        }
        }
        $this->reset();
        return redirect()->route('admin.users.index')->with('success',__('message.created',['model'=>__('names.user')]));
    }

}
