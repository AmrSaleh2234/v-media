<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Basic\Modal;
use Livewire\Component;

class AttendModal extends Modal
{

    protected $rules = [
        'selected' => 'required',
        'distance' => 'required|numeric',
        'selected.*.start' => 'required',
        'selected.*.end' => 'required'
    ];

    public $modal_id;
    public $title_in;
    public $days;
    public $times;
    public $distance ;
    public $selected = [];
    public $selected_times = [];
    public $shift = [];

    public function mount($modal_id = null , $title_in = null, $distance = null , $days = null) {
        $this->modal_id = $modal_id;
        $this->title_in = $title_in;
        $this->distance = $distance ;
        if(isset($days) && count($days) >= 1) {
            foreach($days as $day) {
                $this->selected[$day->day_name] = [
                        "checked" => true,
                        "start" => $day->start_in,
                        "end" => $day->end_in,
                ];
            }
        }
        $this->days = weekDays();
        $this->times = hourType();

    }
    public function render()
    {
        return view('livewire.attend-modal');
    }

    public function save() {
//        dd($this->distance);
        if(count($this->selected) >= 1) {
            foreach($this->selected as $key=>$day) {
                if(isset($day['checked']) && $day['checked']){
                    if( !array_key_exists("start", $day) || !array_key_exists("end", $day)) {
                        $this->dispatchBrowserEvent('toastr',
                            ['type' => 'error',  'message' => 'Please Choose start and end time']);

                        return 0;
                    }
                    if($day["start"] >= $day["end"]) {
                        $this->dispatchBrowserEvent('toastr',
                            ['type' => 'error',  'message' => 'Please End date must be after start date']);

                        return 0;
                    }
                }elseif (!isset($day['checked'])){
                    unset($this->selected[$key]);
                }
            }
            if($this->distance == null) {
                $this->dispatchBrowserEvent('toastr',
                     ['type' => 'error',  'message' => 'Please Provide the distance']);

                     return 0;

            }
             $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' => 'Saved Successfully']);

            $this->emitTo('branch.form','updateShifts', [
                'distance' => $this->distance,
                'days' => $this->selected,
            ]);
             $this->close($this->modal_id);

        } else {
             $this->dispatchBrowserEvent('toastr',
            ['type' => 'error',  'message' => 'Please Choose At Least 1 Day']);
        }
    }
}
