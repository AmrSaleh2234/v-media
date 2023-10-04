<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Form extends Component
{
    public $permissions = [];
    public $totalPermission = false, $totalViewPermission = false, $totalCreatePermission = false, $totalEditPermission
    = false, $totalDeletePermission = false;
    public $choosenPermissions = [];

    public $choosenGroup = [];

    public $name;

    public $role_id;

    public function mount($id = null) {

        if($id != null) {
            $role = Role::findOrFail($id);
            $this->name = $role->name;
            $this->role_id = $role->id;
            $this->choosenPermissions = array_merge($role->permissions->pluck('name')->toArray(), $this->choosenPermissions);
        }
        $this->permissions = Permission::pluck('name', 'id')->groupBy(function($query) {
            return explode('.', $query)[0];
        })->toArray();

        // dd($this->permissions);
    }
    public function render()
    {
        return view('livewire.roles.form');
    }



    public function save() {
        if(empty($this->name)) {
             $this->dispatchBrowserEvent('toastr',
             ['type' => 'error', 'message' =>__('message.empty',['model'=>__('names.name')])]);
            return;
        }

        $checkRoleName = Role::where('name', $this->name)->first();

        if(!empty($checkRoleName)) {
            if(!empty($this->role_id)) {
                if($checkRoleName->id != $this->role_id) {
                     $this->dispatchBrowserEvent('toastr',
                     ['type' => 'error', 'message'
                     =>__('validation.unique_category_link_type',['attribute'=>__('names.name')])]);
                     return;
                }
            } else {
                 $this->dispatchBrowserEvent('toastr',
                 ['type' => 'error', 'message'
                 =>__('validation.unique_category_link_type',['attribute'=>__('names.name')])]);
                 return;
            }

        }

        if( count($this->choosenPermissions) == 0
            && $this->totalPermission == false
            && $this->totalCreatePermission == false
            && $this->totalViewPermission == false
            && $this->totalEditPermission == false
            && $this->totalDeletePermission == false
        ) {
            $this->dispatchBrowserEvent('toastr',
            ['type' => 'error', 'message' =>__('message.empty',['model'=>__('names.permissions')])]);
            return;
        }

        if($this->totalPermission) {

            if(empty($this->role_id)) {
                $newRole = Role::create([
                    'name' => $this->name,
                ]);
            } else {
                $newRole = Role::where('id', $this->role_id)->first();
                $newRole->name = $this->name;
                $newRole->save();
            }

            $permissions = Permission::get();
            $newRole->syncPermissions($permissions);
              $this->dispatchBrowserEvent('toastr',
              ['type' => 'success', 'message' =>__('message.saved-success')]);
              return;
        }

        if(empty($this->role_id)) {
            $newRole = Role::create([
                'name' => $this->name,
            ]);
        } else {
             $newRole = Role::where('id', $this->role_id)->first();
             $newRole->name = $this->name;
             $newRole->save();
        }

        if($this->totalCreatePermission) {
            $permissions = Permission::where('name', 'like' ,'%create%')->get();
            $newRole->syncPermissions($permissions);
        }

        if($this->totalViewPermission) {
            $permissions = Permission::where('name', 'like' ,'%view%')->get();
            $newRole->syncPermissions($permissions);
        }

        if($this->totalEditPermission) {
            $permissions = Permission::where('name', 'like' ,'%edit%')->get();
            $newRole->syncPermissions($permissions);
        }

        if($this->totalDeletePermission) {
            $permissions = Permission::where('name', 'like' ,'%delete%')->get();
            $newRole->syncPermissions($permissions);
        }

        if(count($this->choosenPermissions) > 0 ) {
            $permissions = Permission::whereIn('name', $this->choosenPermissions)->get();
            $newRole->syncPermissions($permissions);
        }

        $this->dispatchBrowserEvent('toastr',
        ['type' => 'success', 'message' =>__('message.saved-success')]);
        return;
    }
}
