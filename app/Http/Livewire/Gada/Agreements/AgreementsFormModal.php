<?php

namespace App\Http\Livewire\Gada\Agreements;

use App\Http\Livewire\Basic\Modal;
use App\Models\GADA\Agreement;
use Illuminate\Support\Arr;
use Livewire\Component;

class AgreementsFormModal extends Modal
{


    protected $listeners = ['editAgreement' => 'edit','createAgreement' => 'create' ];

    protected $rules = [
        'content' => 'required|string',
        'content_ar' => 'required|string',
        'active' => 'required'
    ];

    public $agreement ;
    public $content , $content_ar ;
    public $active = 1;

    public $title = 'create' ;
    public $button = 'save' ;
    public $color = 'primary';

    public function mount($modal_id = null) {
        $this->modal_id = $modal_id;
    }

    public function render()
    {
        return view('livewire.gada.agreements.agreements-form-modal');
    }

    public function save()
    {
        $validated =  $this->validate();
        $data = $this->formData($validated);
        $data['type'] = 'client-request';
        if (!$this->agreement){
            Agreement::create($data);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.created',['model'=>__('names.agreement')])]);
        }else{
            $this->agreement->update($data);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.agreement')])]);
        }
        $this->emitTo('gada.agreements.agreements-table','refreshAgreements');
        $this->reset('content','content_ar','agreement');
        $this->close('AgreementModal');
    }

    public function create()
    {
        $this->loading = true ;
        $this->reset();
        $this->title = 'create';
        $this->button = 'save';
        $this->color = 'primary';
        $this->open();
        sleep(.5);
        $this->loading = false ;
    }
    public function edit(int $agreementId)
    {
        $this->loading = true ;
        $this->reset('agreement','content','content_ar','active');
        $this->agreement = Agreement::where('id', $agreementId)->first();

        $this->content =  $this->agreement->content['en'];
        $this->content_ar =  $this->agreement->content['ar'];
        $this->title = 'edit';
        $this->button = 'update';
        $this->color = 'primary';
//        $this->dispatchBrowserEvent('openModal');
        $this->open();
        sleep(.5);
        $this->loading = false ;
    }

    private function formData($validated)
    {
        $data = $validated;
        $data = Arr::except($data, array('content'));
        $data = Arr::except($data, array('content_ar'));
        $data['content']['en'] = $validated['content'];
        $data['content']['ar'] = $validated['content_ar'];
        return $data;
    }
}
