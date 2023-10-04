<?php

namespace App\Http\Livewire\Settings\Website;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\CMS\Icon;
use App\Models\CMS\Section;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;

class Setting extends BasicForm
{
    protected $rules = [
        'setting.name' => 'required|array',
        'setting.name.ar' => 'required|string',
        'setting.name.en' => 'required|string',
        'setting.slogan.ar' => 'required|string',
        'setting.slogan.en' => 'required|string',
        'setting.footer.ar' => 'required|string',
        'setting.footer.en' => 'required|string',
        'setting.emails' => 'required|array',
        'setting.emails.*' => 'required|email',
        'setting.phones' => 'required|array',
        'setting.phones.*' => 'required|string',
        'setting.whatsapp' => 'required|array',
        'setting.whatsapp.*' => 'required|string',
        'setting.address.*.address' => 'required|string',
        'setting.address.*.link' => 'required|url',
        'setting.address.*.longLat' => 'required',
        'setting.social.facebook' => 'required|url',
        'setting.social.instagram' => 'required|url',
        'setting.social.snapchat' => 'required|url',
        'setting.apps.app_store_link' => 'required|url',
        'setting.apps.play_store_link' => 'required|url',
        'setting.logo.*' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:20480',
    ];

    public $logo, $logo_path;
//    public $name, $slogan, $emails, $phones, $whatsapp, $address, $social;
    public $setting ;
    use WithFileUploads;

    public function mount()
    {
        $this->setting = \App\Models\Setting::where('group','setting')->whereIn('key', ['name','slogan','footer','emails','phones','whatsapp','address','social','logo','apps'])->pluck('value','key')->toArray();
        if (empty($this->setting)){
            $this->setting = ['name'=>[],'slogan'=>[],'footer'=>[],'emails'=>[[]],'phones'=>[[]],'whatsapp'=>[[]],'address'=>[[]],'social'=>[],'logo'=>[],'apps'=>[]];
        }else{
            if (isset( $this->setting['logo'][0])){
                $this->logo_path = $this->setting['logo'][0];
            }
           unset($this->setting['logo'][0]);
        }
    }

    public function render()
    {
        return view('livewire.settings.website.setting');
    }

    public function addEmail()
    {
        $this->setting['emails'][] = array();
    }

    public function deleteEmail($index)
    {
        unset($this->setting['emails'][$index]);
    }

    public function addPhone()
    {
        $this->setting['phones'][] = array();
    }

    public function deletePhone($index)
    {
        unset($this->setting['phones'][$index]);
    }

    public function addWhatsapp()
    {
        $this->setting['whatsapp'][] = array();
    }

    public function deleteWhatsapp($index)
    {
        unset($this->setting['whatsapp'][$index]);
    }

    public function addAddress()
    {
        $this->setting['address'][] = array();

    }

    public function deleteAddress($index)
    {
        unset($this->setting['address'][$index]);
    }


    public function save()
    {
        $validated = $this->validate();
        if (empty($this->setting['logo']) && empty($this->logo_path)) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error', 'message' => 'الحقل الشعار مطلوب']);
            return;
        }
        $data = $this->formData($validated);

        $data['setting'] = $this->uploadImages($data['setting'], 0);
        foreach ($data['setting'] as $key => $value){
//            dd($key);
            \App\Models\Setting::updateOrCreate(
                [  'key' =>$key,'type' => 'website'],
                [
                    'key' =>$key,
                    'value' => $value,
                    'type' => 'website',
                    'group' => 'setting'
                ]);
        }

            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.created', ['model' => __('names.setting')])]);


//        $this->reset();
        return redirect()->route('admin.settings.platforms')->with('success', __('message.updated', ['model' => __('names.setting')]));
    }

    private function uploadImages($validated, $id)
    {
//        $sizes = [];
//        $sizes[] = ['width' => 135, 'height' => 72, 'name' => 'app'];
//        $sizes[] = ['width' => 351, 'height' => 187, 'name' => 'app-show'];

        if (!empty($validated['logo'][0]) && is_object($validated['logo'][0])) {
                $path = uploadFile($this->setting['logo'][0], "website", $id, 'logo', true);
//            $validated['logo'][0] = null ;
                $validated['logo'][0] =  $path ;
        } else {
            $validated = Arr::except($validated, array('logo'));
        }

        return $validated;
    }

    private function formData($validated)
    {
        $data = $validated;
//        $data = Arr::except($data, ['name']['']);
//        $data = Arr::except($data, array('name_en'));
//        $data['name']['ar'] = $validated['name'];
//        $data['name']['en'] = $validated['name_en'];
        return $data;
    }

    public function messages()
    {
        return [
        ];
    }
}
