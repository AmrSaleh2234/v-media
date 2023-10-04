<?php

namespace App\Http\Controllers\Admin\GADA;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class AgreementsController extends MainController
{

    public function __construct() {
        parent::__construct();

        $this->class = "agreement";
        $this->table = "agreements";

        $this->middleware('auth');
        $this->middleware('permission:gada.agreements.view', ['only' => ['index', 'show']]);
        $this->middleware('permission:gada.agreements.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:gada.agreements.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:gada.agreements.delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tree = $this->tree;
        return view('admin.gada.agreements', compact('tree'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.banners.index') => 'banners-setting']);
        return view('admin.gada.agreements.create', compact('tree'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.banners.index') => 'banners-setting']);
        return view('admin.settings.platforms.banners.create', compact('tree','id'));
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
