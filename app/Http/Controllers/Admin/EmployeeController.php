<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class EmployeeController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->class = "employees";
        $this->table = "employees";
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $branchId = null;
        if($request->has('branch_id')) {
            $branchId = $request->branch_id;
        }
        return view('admin.employees.index')->with(['tree' => $this->tree, 'branchId' => $branchId]);
    }

    public function create($employee_id = null, $step = 1) {


        // step 1 => personal-information
        // step 2 => academic-info
        // step 3 => employment-info
        // step 4 => employee-finances
        // step 5 => attendance

        if($step == 1 && ! havePermissionTo('employees.personal-information')) {
            abort(403,'User have not permission for this page access.');
         }

        if($step == 2 && ! havePermissionTo('employees.academic-info')) {
            abort(403,'User have not permission for this page access.');
        }

        if($step == 3 && ! havePermissionTo('employees.employment-info')) {
            abort(403,'User have not permission for this page access.');
        }

        if($step == 4 && ! havePermissionTo('employees.employee-finances')) {
            abort(403,'User have not permission for this page access.');
        }

        if($step == 5 && ! havePermissionTo('employees.attendance')) {
            abort(403,'User have not permission for this page access.');
        }
       $tree = array_merge($this->tree, [route('admin.employees.index') => 'employees']);
        return view('admin.employees.create')->with(['employee_id'=>$employee_id, 'step' => $step, 'tree' => $tree]);
    }
}
