<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hr\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:branches.view', ['only' => ['index', 'show']]);
        $this->middleware('permission:branches.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:branches.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:branches.delete', ['only' => ['destroy']]);
    }

    public function index() {
        return view('admin.Branches.index');
    }

    public function create() {
        return view('admin.Branches.edit');
    }

    public function show($id){
        $branch = Branch::find($id);
//        dd(User::find(3)->can('update', Branch::find($id)));
        $this->authorize('view', $branch);
//        dd(auth()->user()->can('view',$branch));
        return view('admin.Branches.show');
    }

    public function edit(int $id) {
        return view('admin.Branches.edit',compact('id'));
    }



    public function destroy() {
        return view('admin.Branches.index');
    }


}
