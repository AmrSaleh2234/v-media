<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Notifications\MainNotification;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends MainController
{
   public function __construct()
   {
       parent::__construct();
//       $this->middleware('permission:admin');
   }

   public function dashboard()
   {
       return view('admin.dashboard');
   }

    public function notifications()
    {
        $user = auth('web')->user();
//        $data = array();
//        $data['from'] = 'system';
//        $data['message'] = 'welcome to admin panel';
//        $data['url'] = url('/');
//        $user->notify(new MainNotification($data));
//        $user->notifications()->read();
        return view('admin.notifications')->with(['tree'=>$this->tree]);
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx',\Maatwebsite\Excel\Excel::XLSX);
    }
}
