<?php

namespace App\Http\Livewire\Settings\Members;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\CMS\Member;
use App\Services\CMS\MemberService;
use Livewire\Component;

class MembersTable extends BasicTable
{
    protected $listeners = ['confirmDelete'];
    public function render()
    {
        $service = new MemberService();
        return view('livewire.settings.members.members-table',[
            'members' => $service->search($this->search)
//                ->confirmed()
//                ->with('category')
                ->when($this->start_date,function ($query){
                    $query->where('created_at','>=',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at','<=',$this->end_date);
                })
//                ->when( !empty($this->status_id)   ,function ($query){
//                    $query->where('status_id','>=',$this->status_id);
//                })
//                ->select(['id','name','main_image'])
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage)
        ]);
    }

    public function confirmDelete($id)
    {
        $member = Member::find($id);
//        dd($member);
        if ($member->app) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.member'),'relation'=>__('names.application')])]);
            return ;
        } elseif($member->website) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.member'),'relation'=>__('names.website')])]);
            return ;
        }
        $member->delete();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.deleted',['model'=>'member'])]);
        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }
}
