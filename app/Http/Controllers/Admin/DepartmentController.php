<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hr\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:departments.view', ['only' => ['index', 'show']]);
        $this->middleware('permission:departments.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:departments.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:departments.delete', ['only' => ['destroy']]);
    }

    public function index(Request $request) {
        return view('admin.departments.index')->with('management_id' , $request->management_id);
    }

    public function create(Request $request) {
        return view('admin.departments.create')->with('management_id', $request->management_id);
    }


    public function edit($department) {
        $management_id = Department::whereId($department)->first()->management_id;
        return view('admin.departments.edit')->with(
           [
             'department_id' => $department,
             'management_id' => $management_id
           ]
        );
    }
}
