<?php

namespace App\Http\Livewire\Attendance\Support;

use App\Http\Livewire\Basic\Modal;
use App\Models\Employee\EmployeeRequest;
use App\Models\Status;
use App\Models\Ticket;
use Livewire\Component;

class SupportView extends Modal
{

    protected $rules = [
        'ticket.status_id' => 'required|exists:statuses,id',
        'ticket.response' => 'nullable|string'
    ];

    public $ticket;
    public $ticket_id;
    public $statues;
    public $Oldnote;
    public function mount($id) {
        $this->ticket_id = $id;
        $this->ticket = Ticket::with('status')->whereId($id)->first();
        $this->statues = Status::where("type",'tickets')->pluck('name', 'id')->toArray();
        $this->Oldnote = $this->ticket->note;
    }

    public function render()
    {
        return view('livewire.attendance.support.support-view');
    }


    public function updatedTicketStatusId($data) {
        if($data == 1) {
            $this->ticket->note = "";
        }else{
            $this->ticket->note =  $this->Oldnote;
        }
    }

    public function save() {
        $validated = $this->validate();
        $this->ticket->save();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.ticket')])]);
//        $statusId = Status::where("type",'tickets')->where('name','accepted')->value('id');
        $this->ticket = Ticket::whereId($this->ticket_id)->first();
        $this->close("changeStatus");
    }


}
