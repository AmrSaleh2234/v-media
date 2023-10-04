<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Broker;
use App\Models\Client;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Projects\Entities\Contract;
use Modules\Projects\Entities\ContractPayment;

class ClientController extends MainController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
        $this->class = "client";
        $this->table = "clients";
        $this->middleware('auth');
        $this->middleware('permission:clients.view', ['only' => ['index', 'show']]);
        $this->middleware('permission:clients.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:clients.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:clients.delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
//        dd(country(ip()));
//        dd(Storage::disk('dropbox')->put('hello.txt','hello from laravel')) ;
        $tree = $this->tree ;
        return view('admin.clients.index',compact('tree'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tree = array_merge($this->tree, [route('admin.clients.index') => 'clients']);

        return view('admin.clients.create',compact('tree'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param   $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $input = $request->validated();
        if ($input['type'] == 'company') {
            $input['name'] = $input['company_name'];
            $input['card_id'] = null;
            $input['card_image'] = null;
            $input['register_image'] = $this->uploadFile($request->register_image, "clients");
        } else {
            $input['company_name'] = null;
            $input['register_number'] = null;
            $input['agent_name'] = null;
            $input['register_image'] = null;
            $input['card_image'] = $this->uploadFile($request->card_image, "clients");
        }
        Client::create($input);

        return redirect()->route('admin.clients.index')->with('success', __('تم إضافة عميل بنجاح'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */

    public function show(Request $request, $id)
    {
        $title = __("names.client-data");
        $class = $this->class;
        $client = Client::findOrFail($id);

        $data_all = Contract::where('client_id',$id)->latest();
        $data = $data_all->paginate($this->limit);
        $statuses = DB::table('contracts')->leftJoin('statuses','statuses.id','=','contracts.status_id')->select(DB::raw('count(*) as total, statuses.name as status, statuses.color as color', 'statuses.id as id'))->groupBy('status_id')->get();

        $payments = ContractPayment::whereIn('contract_id',$data_all->pluck('id'))->sum('amount');
        $logs = $client->activities;
        $tree = array_merge($this->tree, [route('admin.clients.index') => 'clients']);
        return view('admin.clients.show', compact('data','client', 'class','title' ,'statuses','payments','logs','tree'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Request $request, $id)
    {
        $tree = array_merge($this->tree, [route('admin.clients.index') => 'clients']);

        return view('admin.clients.create', compact('id','tree'));
//        $client = Client::with('branch', 'broker')->whereId($id)->first();
//        if ($client) {
//
//        } else {
//            return abort(404);
//        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, $id)
    {
        $input = $request->validated();
        $client = Client::find($id);

        if (!empty($client)) {
            if ($input['type'] == 'company') {
                $input['name'] = $input['company_name'];
                $input['card_id'] = null;
                $input['card_image'] = null;
                if ($request->file('register_image')) {
                    $input['register_image'] = $this->uploadFile($request->register_image, "clients");
                } else {
                    $input = Arr::except($input, array('register_image'));
                }
            } else {
                $input['company_name'] = null;
                $input['register_number'] = null;
                $input['agent_name'] = null;
                $input['register_image'] = null;
                if ($request->file('card_image')) {
                    $input['card_image'] = $this->uploadFile($request->card_image, "clients");
                } else {
                    $input = Arr::except($input, array('card_image'));
                }
            }

            $input = $request->validated();

            $client->update($input);
            return redirect()->route('admin.clients.index')->with('success', __('تم تعديل العميل بنجاح'));

        } else {
            return $this->pageError($this->class);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $response = false;
        $client = Client::withCount('contracts')->where('id', $id)->first();

        if ($client->contracts_count) {
            return response()->json('لا يمكن حذف عميل لديه عقود');
        }


        $response = $client->delete();
        return response()->json($response);

    }

    public function requests(){
        $tree = array_merge($this->tree, [route('admin.clients.index') => 'clients']);
        return view('admin.clients.requests',compact('tree'));
    }




    public function showRequest($requestId){
        $tree = array_merge($this->tree, [route('admin.clients.requests', $requestId) => 'clients']);
//        $requestId = $requestId;
        return view('admin.clients.request_view',compact('requestId','tree'));
    }
}
