<?php

namespace App\Http\Livewire\Settings\Cities;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class CitiesForm extends BasicForm
{
    protected $rules = [
        'country_id' => 'required|numeric|exists:countries,id',
        'state_id' => 'required|numeric|exists:states,id',
        'name' => 'required|string',

    ];

    public $name, $state_id, $country_id ;
    public $city , $states  , $countries;


    public function mount($id = null)
    {

        if ($id) {
            $this->city = City::find($id);
            $this->name = $this->city->name;
            $this->state_id = $this->city->state_id;
            $this->country_id = $this->city->country_id;

            $this->title = 'edit';
            $this->button = 'update';
//            $this->color = 'primary';
            $this->states = State::where('country_id',$this->country_id)->pluck('name','id')->toArray();
        }else{
            $this->states = [];
        }

        $this->countries = Country::pluck('name','id')->toArray();

    }

    public function render()
    {
        return view('livewire.settings.cities.cities-form');
    }

    public function updatedCountryId($value)
    {
        $this->states = State::where('country_id',$value)->pluck('name','id')->toArray();
    }

    public function save()
    {
        $validated = $this->validate();

        $validated['country_code'] = Country::whereId($validated['country_id'])->value('iso2');
        $validated['state_code'] = State::whereId($validated['state_id'])->value('iso2');

        if ($this->city) {
            $this->city->update($validated);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.updated', ['model' => __('names.city')])]);
        } else {
            City::create($validated);


            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.created', ['model' => __('names.city')])]);
        }

//        $this->reset();
        return redirect()->route('admin.settings.dashboard.cities.index')->with('success', __('message.updated', ['model' => __('names.city')]));
    }

}
