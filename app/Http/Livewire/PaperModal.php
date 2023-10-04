<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Basic\Modal;

use Livewire\WithFileUploads;
use App\Models\officialPaper;

class PaperModal extends Modal
{
    use WithFileUploads;
    protected $rules = [
        'paper_id' => 'required|exists:official_papers,id',
        'notification_date' => 'required|date',
        'end_date' => 'date|after:notification_date',
        'attachment' => 'required|file|mimes:pdf,png,jpeg,jpg'
    ];

    public $modal_id;
    public $title_in;
    public $paper_id;
    public $notification_date;
    public $end_date;
    public $attachment;
    public $paperNames = [];
    public $days = 0;

    public function mount($modal_id , $title_in) {
        $this->modal_id = $modal_id;
        $this->title_in = $title_in;
        $this->paperNames = officialPaper::pluck('name','id')->toArray();
    }

    public function render()
    {
        return view('livewire.paper-modal');
    }


    public function updatedpaperId() {
        $this->days = officialPaper::where('id',$this->paper_id)->first()->duration;
    }

    public function updatedendDate() {
        $endDate = strtotime($this->end_date);
        $this->notification_date = Date('Y-m-d',strtotime("- ".$this->days." days", $endDate));
    }

    public function save() {
         $this->validate();
        $path = "";
        if ($this->attachment != null){
            // // upload image
            // $imageName = time().'.'.$this->attachment->extension();
            // $dir ='storage/uploads/';
            // $this->attachment->storeAs( $dir,$imageName);
            // $path = $dir . $imageName;

            $path = uploadFile($this->attachment, "branch_meta", $this->paper_id, "meta", true);
        }
        $this->emit('updatePapers',['official_paper_id' => $this->paper_id, 'finish_date' => $this->end_date, 'notification_date' => $this->notification_date, 'user_id' => auth()->user()->id, 'attachment' => $path]);
        //$this->refresh();
        $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.created',['model' => __('names.branch-paper')])]);

        $this->close($this->modal_id);
        $this->reset(['paper_id','notification_date','end_date','attachment']);
    }
}
