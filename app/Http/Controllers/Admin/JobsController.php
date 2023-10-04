<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\Hr\JobType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JobsController extends MainController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('permission:jobTypes.view', ['only' => ['jobTypes', 'showJobType']]);
        $this->middleware('permission:jobNames.view', ['only' => ['jobNames' , 'showJobName']]);
        $this->middleware('permission:jobGrades.view', ['only' => ['jobGrades' , 'showJobGrade']]);


    }

    /**
     * Display a listing of the resource.
     */
    public function jobTypes()
    {
        $tree = $this->tree;
        return view('admin.jobs.job-types.index', compact('tree'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function jobNames()
    {
        $tree = $this->tree;

        return view('admin.jobs.job-names.index', compact('tree'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function jobGrades()
    {
        $tree = $this->tree;
        return view('admin.jobs.job-grades.index', compact('tree'));
    }

    public function showJobType($id)
    {
        $tree = $this->tree;
        return view('admin.jobs.job-types.show', compact('tree'));
    }

    public function showJobNames($id)
    {
        $tree = $this->tree;

        return view('admin.jobs.job-names.show', compact('tree'));
    }

    public function showJobGrade($id)
    {
        $tree = $this->tree;

        return view('admin.jobs.job-grades.show', compact('tree'));
    }

}
