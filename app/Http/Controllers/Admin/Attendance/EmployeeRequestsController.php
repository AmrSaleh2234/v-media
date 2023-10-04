<?php

namespace App\Http\Controllers\Admin\Attendance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class EmployeeRequestsController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->class = "employeeRequest";
        $this->table = "employee_requests";

        $this->middleware('auth');
        $this->middleware('permission:attendance.requests.view', ['only' => ['index', 'show']]);
        $this->middleware('permission:attendance.requests.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:attendance.requests.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:attendance.requests.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tree = $this->tree;
        return view('admin.attendance.requests.index', compact('tree'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tree = array_merge($this->tree, [route('admin.attendance.requests.index') => 'employees-requests']);

        return view('admin.attendance.requests.view', compact('tree','id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
