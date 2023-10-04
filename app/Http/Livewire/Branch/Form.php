<?php

namespace App\Http\Livewire\Branch;

use App\Models\City;
use App\Models\Country;
use App\Models\Employee\Employee;
use App\Models\Hr\Branch;
use App\Models\Hr\BranchPaper;
use App\Models\Hr\Shift;
use App\Models\User;
use App\Services\BranchService;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Form extends Component
{
    protected $listeners =
        [
            'updateShifts' => 'setShift',
    'updatePapers' => 'setPapers',
     'updateLatAndLong' => 'updateLatAndLong',
    'updateAddress' => 'updateAddress'];

    protected $rules = [
        'branch.name' => 'required|string|max:191',
        'branch.email' => 'required|email',
        'branch.phone' => 'required|numeric',
        'branch.type' => 'required',
        'branch.parent_id' => 'required_if:type,sub|required_if:type,main',
        'branch.city_id' => 'required|exists:cities,id',
        'branch.shift_id' => 'required|exists:shifts,id',
        'branch.longitude' => 'required',
        'branch.latitude' => 'required',
        'branch.manager_id' => 'required'
    ];

    public $branch;
    public $branchId;
    public $shifts;
    public $countries;
    public $cities = [];
    public $types;
    public $type = "central";
    public $title = "create";
    public $papers = [];
    public $country_id;
    public $managers = [];

    public function mount($branchId = null)
    {

        $this->countries = Country::pluck('id','name')->toArray();
        $this->types = Branch::$types;
        $this->shifts = Shift::pluck('id','name')->toArray();

        $users = User::whereHas('roles',function($query) {
            $query->whereHas('permissions', function($sub) {
                $sub->where('name', 'managers.branches');
            });
        })->select('id')->pluck('id')->toArray();

       $this->managers = Employee::whereIn('user_id',$users)->get();


        if ($branchId != null){
            $this->branchId = $branchId;
            $this->branch = Branch::where('id',$branchId)->with('city')->first();
            $this->country_id = $this->branch->city->country_id;
            $this->cities = City::where('country_id',$this->branch->city->country_id)->pluck('name','id')->toArray();
            $this->papers = $this->branch->branchPapers;
        }else{
            $this->branch = ['address'=>null];
        }

        //  $this->dispatchBrowserEvent('initMap');
    }

    public function render()
    {

        if($this->type == "main") {
            $mainBranches = Branch::where('type','central')->select('name','id')->when($this->branchId, function($query) {
                $query->where('id','!=', $this->branchId);
            })->get();
        } else if ($this->type == "sub") {
            $mainBranches = Branch::where('type','main')->select('name','id')->when($this->branchId, function($query)
            {
                $query->where('id','!=', $this->branchId);
            })->get();
        } else {
            $mainBranches = [];
        }
        return view('livewire.branch.form',[
            'mainBranches' => $mainBranches
        ]);
    }

    public function updated($propertyName)
    {
        $this->dispatchBrowserEvent('initMap');
        $this->validateOnly($propertyName);
    }

    public function updatedcountryId()
    {
        $this->cities = City::where('country_id',$this->country_id)->pluck('name','id')->toArray();
    }

    public function updatedbranchType($data) {
        $this->type = $data;
    }

    public  function save()
    {
        //$this->validate();
        $branchService = new BranchService();

         $this->validate();

        if($this->branchId != null) {
            $this->branch->save();
            $this->dispatchBrowserEvent('toastr',
            ['type' => 'success', 'message' => __('message.updated',['model' => __('names.branch')])]);

                return redirect()->route('admin.branches.index');
        } else {


            $this->branch = $branchService->store($this->branch);

            if(gettype($this->branch) == "string") {
                    $this->dispatchBrowserEvent('toastr',
                ['type' => 'error',  'message' => $this->branch]);
            } else {

                 $this->branchId = $this->branch['id'];

                 if(count($this->papers) >= 1) {
                    foreach($this->papers as $paper) {
                        $paper['branch_id'] = $this->branchId;
                        $branchService->storeMeta($paper);
                    }
                 }
                $this->dispatchBrowserEvent('toastr',
                    ['type' => 'success',  'message' => __('message.created',['model' => __('names.branch')])]);

                return redirect()->route('admin.branches.index');
            }

        }
    }


    public function setPapers ($data) {
        if($this->branchId != null) {
            $addNewPaper = new BranchPaper([
                        'official_paper_id' => $data['official_paper_id'],
                        'finish_date' => $data['finish_date'],
                        'notification_date' => $data['notification_date'],
                        'attachment' => $data['attachment'],
                        'branch_id' => $this->branch->id,
                        'user_id' => auth()->user()->id,
            ]);
            $addNewPaper->save();

            $this->papers = BranchPaper::where('branch_id',$this->branch->id)->get();
        } else {
            array_push($this->papers , $data);
        }


    }

    public function deletePaper($name, $key) {

        if($this->branch) {
             BranchPaper::where(['branch_id'=>$this->branch->id,'official_paper_id' => $name])->delete();
        }
        unset($this->papers[$key]);
        $this->dispatchBrowserEvent('toastr',
                ['type' => 'info',  'message' => __('message.deleted',['model' => __('names.official-paper')])]);
        return 0;

    }


    public function updateLatAndLong($message) {
        $coo = explode('-',$message);
        $this->branch['latitude'] = $coo[0];
        $this->branch['longitude'] = $coo[1];
        //        $this->branch->save();
        $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' => __('message.created',['model' => __('names.location')])]);

         $this->dispatchBrowserEvent('initMap');
    }

    public function updateAddress($address) {
        $this->branch['address'] = $address;
        //        $this->branch->save();
    }
}
