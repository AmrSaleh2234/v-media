<?php

namespace App\Http\Controllers\Admin\Attendance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class SupportController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->class = "z";
        $this->table = "employee_requests";

        $this->middleware('auth');
        $this->middleware('permission:attendance.support.view', ['only' => ['index', 'show']]);
        $this->middleware('permission:attendance.support.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:attendance.support.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:attendance.support.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tree = $this->tree;
        return view('admin.attendance.support.index', compact('tree'));
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
        $tree = array_merge($this->tree, [route('admin.attendance.support.index') => 'support-requests']);

        return view('admin.attendance.support.view', compact('tree','id'));
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
