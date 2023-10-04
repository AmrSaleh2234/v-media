<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AttendanceDataTable;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class AttendanceController extends MainController
{
    public function __construct() {
        parent::__construct();
        $this->middleware('auth');
        //        $this->middleware(['permission:attendance-list|attendance-create|attendance-edit|attendance-delete'], ['only' => [''];
    }

    public function index() {
        $tree = $this->tree ;
        return view('admin.employees.attendance.index')->with('tree', $tree);
    }

    public function table(AttendanceDataTable $dataTable)
    {
        $tree = $this->tree ;
        return $dataTable->render('admin.employees.attendance.table')->with('tree', $tree);
    }

}
