<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:managements.view', ['only' => ['index', 'show']]);
        $this->middleware('permission:managements.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:managements.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:managements.delete', ['only' => ['destroy']]);
    }
    public function index(Request $request) {
        return view('admin.managements.index')->with('branch_id',$request->branch_id);
    }



    public function create(Request $request) {
        return view('admin.managements.create')->with('branch_id' , $request->branch_id);
    }

    public function edit($management) {
        return view('admin.managements.edit')->with('management',$management);
    }
}
