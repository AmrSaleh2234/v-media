<?php

namespace App\Http\Livewire\Gada\Agreements;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\GADA\Agreement;
use App\Services\GADA\AgreementService;
use Livewire\Component;

class AgreementsTable extends BasicTable
{
    protected $listeners = ['refreshAgreements' => '$refresh','confirmDelete'];

    public function render()
    {
        $service = new AgreementService();
        return view('livewire.gada.agreements.agreements-table',[
            'agreements' => $service->search($this->search)
                ->when($this->start_date,function ($query){
                    $query->where('created_at',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at',$this->end_date);
                })
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
        ]);
    }

    public function create()
    {
        $this->emitTo('gada.agreements.agreements-form-modal','createAgreement');
    }
    public function edit(int $agreementId)
    {
        $this->emitTo('gada.agreements.agreements-form-modal','editAgreement',$agreementId);
    }

    public function toggle($id){
        $agreement = Agreement::find($id);
        $agreement->active = !$agreement->active ;
        $agreement->save();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.agreement')])]);
        return ;
    }


    public function confirmDelete($id)
    {
        $agreement = Agreement::find($id);
        if ($agreement->active) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.agreement'),'relation'=>__('names.dashboard')])]);
            return ;
        }
        $agreement->delete();
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.deleted',['model'=>__('names.agreement')])]);
        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }



}
