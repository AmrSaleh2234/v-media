<?php

namespace App\Http\Livewire\Settings\OfficialPaper;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\officialPaper;
use Livewire\Component;

class Table extends BasicTable
{

    protected $listeners = ['confirmDelete'];

    protected $rules = [
        "newPaper.name" => 'required',
        'newPaper.duration' => 'required',
        'newPaper.status' => 'required',
        'newPaper.way_to_send' => 'required'
    ];

    public $papers;
    public $newPaper;

    public function mount() {
        $this->papers = officialPaper::latest()->get();
    }

    public function render()
    {
        return view('livewire.settings.official-paper.table');
    }


    public function save() {

        if(array_key_exists("id",$this->newPaper)) {
            $officialPaper = officialPaper::where('id',$this->newPaper["id"])->first();
            if($officialPaper) {
                $officialPaper->update($this->newPaper);
            } else {
                 officialPaper::create($this->newPaper);
            }

        } else {
             officialPaper::create($this->newPaper);
        }

        $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' => 'Saved Successfully']);

        $this->close("addPaper");
        $this->reset("newPaper");
        $this->papers = officialPaper::latest()->get();
    }


    public function updateThisPaper($data) {

       $this->newPaper = $data;

    }

    public function resetPaper() {
        $this->reset("newPaper");
    }
    public function close($modal_id)
    {
        $this->dispatchBrowserEvent('closeModal',['id'=>$modal_id]);
    }

    public function confirmDelete($id) {
        $paper = officialPaper::where('id',$id)->first();

        if(false) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'danger',  'message' => 'Cannot Delete Becouse Having Papers in branch']);

        } else {
            if($paper) {
            $paper->delete();
            $this->papers = officialPaper::latest()->get();
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' => 'Deleted Successfully']);

        }
        }

    }

}
