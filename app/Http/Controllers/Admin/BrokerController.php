<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\Hr\Branch;
use App\Models\Broker;
use Illuminate\Http\Request;

class BrokerController extends MainController
{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
        $this->class = "broker";
        $this->table = "brokers";
        $this->middleware('auth');
        $this->middleware('permission:brokers.view', ['only' => ['index', 'show']]);
        $this->middleware('permission:brokers.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:brokers.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:brokers.delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $tree = $this->tree ;
        return view('admin.brokers.index', compact('tree'));
    }

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */
    public function create()
    {
//        $class = $this->class;
//        $users = $this->getClients();
//        $branches = Branch::pluck('name','id')->toArray();
        $tree = array_merge($this->tree, [route('admin.clients.index') => 'clients']);
        return view('admin.brokers.create', compact('tree'));
    }

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'phone' => 'required|numeric',
        ]);
        $input = $request->all();
        foreach ($input as $key => $value) {
            if ($key != "content") {
                $input[$key] = stripslashes(trim(filter_var($value, FILTER_SANITIZE_STRING)));
            }
            if ($input[$key] == "") {
                $input[$key] = NULL;
            }
        }
        Broker::create($input);
        return redirect()->route('admin.brokers.index')->with('success', __('تم انشاء الوسيط بنجاح'));
    }

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show(Request $request, $id)
    {
        return view('admin.brokers.show',compact('id'));
    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */
    public function edit(Request $request, $id)
    {
        $tree = array_merge($this->tree, [route('admin.clients.index') => 'clients']);
        return view('admin.brokers.create', compact('tree','id'));
    }

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */
    public function update(Request $request, $id)
    {
        $broker = Broker::find($id);
        if (!empty($broker)) {
            $this->validate($request, [
                'id' => 'required|exists:brokers,id',
                'name' => 'required|string|max:191',
                'phone' => 'required|numeric',
            ]);
            $input = $request->all();
            foreach ($input as $key => $value) {
                if ($key != "content") {
                    $input[$key] = stripslashes(trim(filter_var($value, FILTER_SANITIZE_STRING)));
                }
                if ($input[$key] == "") {
                    $input[$key] = NULL;
                }
            }
            $broker = Broker::find($request->id);
            $broker->update($input);

            return redirect()->route('admin.brokers.index')->with('success', __('تم تعديل الوسيط بنجاح'));
        } else {
            return $this->pageError($this->class);
        }
    }

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */
    public function destroy($id)
    {
        $broker =  Broker::withCount('user')->where('id',$id)->first();

        // if($broker->employees_count > 0){
        //     return response()->json('لا يمكن حذف نوع وظيفة له موظفين');
        // }


        $response = $broker->delete();
        return response()->json($response);
        // $broker = Broker::find($id);
        // if (!empty($broker)) {
        //     Broker::find($id)->delete();
        //     return redirect()->route('admin.brokers.index')->with('success', __('تم حذف الوسيط بنجاح'));
        // } else {
        //     return $this->pageError($this->class);
        // }
    }
}
