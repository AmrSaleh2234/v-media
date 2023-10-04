<?php

namespace App\Http\Livewire\Settings\Website;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Attachment;
use App\Models\CMS\Icon;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;

class MainPage extends BasicForm
{
    protected $rules = [
        'setting.main_page_icon' => 'required|string',
        'setting.organization_chart.0' => 'nullable|file|max:32000',
        'setting.main_description.ar' => 'required|string',
        'setting.main_description.en' => 'required|string',

    ];

    public $organization_chart_path ,$file;
    public $setting, $types ;
    use WithFileUploads ;

    public function mount()
    {
        $this->setting = \App\Models\Setting::whereIn('key', ['main_page_icon', 'organization_chart','main_description'])->pluck('value', 'key')->toArray();

        if (empty($this->setting)) {
            $this->setting = ['main_page_icon' => [], 'organization_chart' => null,'main_description'=>[]];
        } else {
            $this->organization_chart_path = $this->setting['organization_chart'][0];
            unset($this->setting['organization_chart'][0]);
            $this->file =  Attachment::where('path', $this->organization_chart_path)->latest()->first();
//          dd($attachment);
        }
        $this->types = Icon::$types;
//        dd(   $this->setting);
    }

    public function render()
    {
        return view('livewire.settings.website.main-page');
    }

//    public function updated($propertyName)
//    {
//        dd($this->setting['organization_chart']);
//    }

    public function save()
    {
        $data = $this->validate();
        if (empty($this->setting['organization_chart']) && empty($this->organization_chart_path)) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error', 'message' => 'الحقل ملف الهيكل التنظيمى مطلوب']);
            return;
        }
//        $data = $this->formData($validated);

        $data['setting'] = $this->uploadImages($data['setting'], 0);
        foreach ($data['setting'] as $key => $value) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $key, 'type' => 'website'],
                [
                    'key' => $key,
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

        if (!empty($validated['organization_chart'])) {
            $path = uploadFile($this->setting['organization_chart'][0], "website", $id, 'organization_chart', true);
            unset($validated['organization_chart'][0])  ;
//            $validated = Arr::except($validated, array('organization_chart'));

            $validated['organization_chart'][0] = $path;
        } else {
            $validated = Arr::except($validated, array('organization_chart'));
        }


        return $validated;
    }
}
