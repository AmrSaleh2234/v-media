<?php

namespace App\Http\Livewire\Settings\Universities;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Hr\University;
use Livewire\Component;

class UniversitiesForm extends BasicForm
{
    protected $rules = [
        'name' => 'required|string',
        'name_ar' => 'required|string',
    ];

    public $name, $name_ar;
    public $university;


    public function mount($id = null)
    {

        if ($id) {
            $this->university = University::find($id);
            $this->name = $this->university->name;
            $this->name_ar = $this->university->name_ar;
            $this->title = 'edit';
            $this->button = 'update';
//            $this->color = 'primary';
        }
    }

    public function render()
    {
        return view('livewire.settings.universities.universities-form');
    }

    public function save()
    {
        $validated = $this->validate();


        if ($this->university) {
            $this->university->update($validated);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.updated', ['model' => __('names.university')])]);
        } else {
            University::create($validated);

            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.created', ['model' => __('names.university')])]);
        }

//        $this->reset();
        return redirect()->route('admin.settings.dashboard.universities.index')->with('success', __('message.updated', ['model' => __('names.university')]));
    }




}
