<?php

namespace Modules\Projects\Http\Controllers;

use App\Models\Client;
use App\Models\Hr\Branch;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Projects\Entities\Contract;
use Modules\Projects\Entities\ContractType;
use Modules\Projects\Entities\ContractPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContractController extends ProjectModuleController
{

    public function __construct()
    {
        parent::__construct();
        $this->class = "contract";
        $this->table = "contracts";
    }
    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(Request $request, $type = null): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $contract_number = $request->has('contract_number') ? $request->contract_number : "";
        $client_phone = $request->has('client_phone') ? $request->client_phone : "";
        $client_nationality = $request->has('client_nationality') ?  $request->client_nationality : "";
        $contract_type = $request->has('contract_type') ? $request->contract_type : "";
        $management_name = $request->has('management_name') ? $request->management_name : "";

        if($type == null) {
            $type  = 'total';
        }

        // Trasnfered contracts has a client id
        // new contract has not a client id

        // Check type for Created Contracts or Transfered Contracts
        if($type == 'transfered' ) {
            $data_all = Contract::TransferedGetContractData();
         } else if ($type == 'newest') {
            $data_all = Contract::GetNewContractData();
         } else {
            $data_all = Contract::GetTotalData();
         }


        if($contract_number != "") {
            $data_all->where('number','like','%'.$contract_number.'%');
        }

        if($client_phone != "") {
            $data_all->whereHas('owner',function ($query) use ($client_phone) {
                $query->where('phone',$client_phone)->orWhere('phone_2',$client_phone)->orWhere('phone_3',$client_phone);
            });
        }

        if($client_nationality != "") {
            $data_all->whereHas('owner',function($query) use ($client_nationality) {
                $query->whereHas('country' , function($q) use ($client_nationality) {
                    $q->where('name', 'like' , '%'.$client_nationality.'%');
                });
            });
        }

        if($contract_type != "") {
            $data_all->whereHas('status', function($query) use ($contract_type) {
                $query->where('name','like','%'.$contract_type.'%');
            });
        }

        if($management_name != "") {
            $data_all->whereHas('management', function($query) use ($contract_type) {
                $query->where('name','like','%'.$contract_type.'%');
            });
        }

        $data_all = $data_all->latest();
        $data = $data_all->paginate($this->limit);

        $statuses = DB::table('contracts')->leftJoin('statuses','statuses.id','=','contracts.status_id')->whereIn('contracts.id',$data_all->pluck('id'))->select(DB::raw('count(*) as total, statuses.name as status, statuses.color as color', 'statuses.id as id'))->groupBy('status_id')->get();
        $reminderStatuses = Status::where('type','contract')->whereNotIn('name',$statuses->pluck('status'))->get();

        $class = $this->class;
        $title = __("Contracts");
        $route_create = null ;
        $route_edit = null ;
        $tree = $this->tree;

        return view('projects::contracts.index',compact('type','reminderStatuses','data','statuses','class','title','route_create','route_edit','tree'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function create(Request $request)
    {
        $class = $this->class;
        $title = __('Create Contract');
        $branches = Branch::select('id','name')->get();
        $owners = Client::select('id','name')->get();
        $sessionKey = csrf_token().'_items';
            if(Session::has($sessionKey)) {
                Session::forget($sessionKey);
            }
        $tree = array_merge($this->tree, [route('admin.contracts.index') => 'contracts']);

        return view('projects::contracts.create',compact('branches','owners','class','title','tree'));
    }

    public function get_managements($branch_id) {
        return Management::where('branch_id',$branch_id)->select('id','name')->get();
    }


    public function get_contract_types(Request $request) {
        $type = ContractType::where('name','like','%'.$request->q.'%')->get();
        if($type != null && count($type) >= 1) {
            return $type->pluck('name');
        } else {
            return [];
        }
    }


    public function saveItems(Request $request) {
       if(Auth::check()) {
            $sessionKey = $request->_token . '_items';

            if(Session::has($sessionKey)) {
                $oldData = Session::get($sessionKey);
                $newData = [
                    'main_item_title' => $request->main_item_title,
                    'main_item_amount' => $request->main_item_amount,
                    'main_item_period' => $request->main_item_amount,
                    'subItems' => []
                ];
                if($request->has('sub_item_title') && count($request->sub_item_title) >= 1) {
                    $subItems = [];
                    foreach($request->sub_item_title as $key=>$sub_title) {
                        array_push($subItems, [
                            'sub_item_title' => $sub_title,
                            'sub_item_amount' => $request->sub_item_amount[$key],
                            'sub_item_period' => $request->sub_item_period[$key],
                        ]);
                    }


                    $newData['subItems'] = $subItems;
                }

                array_push($oldData, $newData);
                Session::put($sessionKey, $oldData);
                $view = view('projects::contracts.partial.item')->with([
                    'item' => $newData,
                    'i' => rand(99999,99999999)
                ]);
                return $view;

            } else {
                $newData[] = [
                    'main_item_title' => $request->main_item_title,
                    'main_item_amount' => $request->main_item_amount,
                    'main_item_period' => $request->main_item_amount,
                    'subItems' => []
                ];
                if($request->has('sub_item_title') && count($request->sub_item_title) >= 1) {
                    $subItems = [];
                    foreach($request->sub_item_title as $key=>$sub_title) {
                        array_push($subItems, [
                            'sub_item_title' => $sub_title,
                            'sub_item_amount' => $request->sub_item_amount[$key],
                            'sub_item_period' => $request->sub_item_period[$key],
                        ]);

                    }
                    $newData[0]['subItems'] = $subItems;
                }

                Session::put($sessionKey, $newData);

                $view = view('projects::contracts.partial.item')->with([
                    'item' => $newData[0],
                    'i' => rand(99999,99999999)
                ]);
                return $view;
            }

            return Session::get($sessionKey);
       } else {
         abort(404);
       }
    }

    public function savePayments(Request $request) {
        if(Auth::check()) {
            $sessionKey = $request->_token . '_payments';
            if(Session::has($sessionKey)) {

            } else {

            }
        } else {
            abort(404);
        }
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'branch_id' => 'required|exists:branches,id',
            'management_id' => 'required|exists:managements,id',
            'title' => 'required|string',
            'date' => 'required|date',
            'owner_id' => 'required|exists:companies,id',
            'assigned_works' => 'required|string',
            'definitions' => 'required|string',
            'commitments' => 'required|string',
            'attachment' => 'required|file'
        ]);

        $type = ContractType::where('name',$request->type)->first();
        $contract_id = 0;
        if($type != null) {
            $contract_id = $type->id;
        } else {
            $newType = ContractType::create([
                'name' => $request->type,
            ]);
            $newType->save();
            $contract_id = $newType->id;
        }

        $second_party = "مكتب ابعاد الرؤية للاستشارات الهندسية";
        if($request->has('second_party') && $request->second_party != '') {
            $second_party = $request->second_party;
        }
        $newContract = new Contract($request->all());
        $newContract->type_id = $contract_id;
        $newContract->code = rand(99999,9999999);
        $newContract->number = rand(99999,9999999);
        $newContract->second_party = $second_party;
        $newContract->save();

        if($request->has('attachment')) {
            $file = $request->file('attachment');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move('uploads/contracts', $filename);
            $newContract->attachment = $filename;

        }

        $status = Status::where('type','contract')->first();
        $newContract->status_id = $status->id;
        $newContract->save();

        if($request->has('amount') && count($request->amount) >= 1) {
            foreach($request->amount as $key=>$amount) {
                $newPayment = new ContractPayment();
                $newPayment->contract_id = $newContract->id;
                $newPayment->amount = $amount;
                $newPayment->period = $request->duration[$key];
                $newPayment->end_date = $request->end_date[$key];
                $active = 'active_'.($key+1);
                $newPayment->is_paid = isset($request->$active) ?? 1;
                $newPayment->save();
            }
        }


        $sessionKey = $request->_token.'_items';

        if(Session::has($sessionKey)) {
            $itemsData = Session::get($sessionKey);
            foreach($itemsData as $item) {
                if($item['main_item_title'] != null) {
                    $newItem = new ContractItem();
                    $newItem->contract_id = $newContract->id;
                    $newItem->type = 0;
                    $newItem->parent_id = 0;
                    $newItem->title = $item['main_item_title'];
                    $newItem->amount = $item['main_item_amount'];
                    $newItem->period = $item['main_item_period'];
                    $newItem->save();
                    if(isset($item['subItems']) && count($item['subItems']) >= 1) {
                        foreach($item['subItems'] as $subItem) {
                           if($subItem['sub_item_title'] != null) {
                            $newSubItem = new ContractItem();
                            $newSubItem->contract_id = $newContract->id;
                            $newSubItem->type = 1;
                            $newSubItem->parent_id = $newItem->id;
                            $newSubItem->title = $subItem['sub_item_title'];
                            $newSubItem->amount = $subItem['sub_item_amount'];
                            $newSubItem->period = $subItem['sub_item_period'];
                            $newSubItem->save();
                           }
                        }
                    }
                }



            }

            Session::forget($sessionKey);
        }

        return redirect()->route('admin.contracts.index')->with('success',__('saved Successfully'));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $contract = Contract::findOrFail($id);
        return view('contract::show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id,Request $request)
    {
        $contract = Contract::findOrFail($request->edit_selectes);
        return view('contract::edit',compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {

    }

    public function bulk_destroy(Request $request) {

        $ids = explode(",",$request->selected_ids);

        foreach($ids as $id) {
            $contract = Contract::where('id',$id)->first();

           $contract->delete();
        }
        return back()->with('success', __('projects::messages.deleted-success'));
    }
}
