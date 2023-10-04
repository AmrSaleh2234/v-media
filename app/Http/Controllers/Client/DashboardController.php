<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('auth:client');
    }

    public function index(){
//        dd(auth());
     return view('client.dashboard');
 }
}
