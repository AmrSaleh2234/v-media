<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;

class RoleController extends MainController
{
    public function __construct() {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('permission:roles.view', ['only' => ['index', 'show']]);
        $this->middleware('permission:roles.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:roles.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:roles.delete', ['only' => ['destroy']]);
    }

    public function index() {
        return view('admin.roles.index')->with('tree' , $this->tree);
    }

    public function create() {
        $tree = array_merge($this->tree,[route('admin.roles.index') => 'roles'] , [route('admin.roles.create')
        => 'role-create']);
        return view('admin.roles.form')->with('tree',$tree);
    }

    public function edit($role_id) {
         $tree = array_merge($this->tree,[route('admin.roles.index') => 'roles'] , [route('admin.roles.edit',$role_id)
         => 'role-edit']);
        return view('admin.roles.form')->with(['role_id'=> $role_id,'tree'=>$tree]);
    }

}
