<?php

namespace App\Http\Livewire\Settings\Icons;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\CMS\Icon;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;

class IconsForm extends BasicForm
{
    protected $rules = [
        'name' => 'required|string',
        'name_en' => 'required|string',
        'type' => 'required|string',
        // 'link' => 'required|string',
        'logo' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        'app' => 'required|boolean',
        'website' => 'required|boolean',
    ];

    public $name,$name_en,$link,$type,$logo, $logo_path,$app = 0 ,$website = 0;
    public $icon;

    use WithFileUploads;

    public function mount($id = null)
    {
        if ($id) {
            $this->icon = Icon::find($id);
            $this->name = $this->icon->name['ar'];
            $this->name_en = $this->icon->name['en'];
            $this->link = $this->icon->link;
            $this->type = $this->icon->type;
            $this->logo_path = $this->icon->logo;
            $this->app = $this->icon->app;
            $this->website = $this->icon->website;
        }
        $this->types = Icon::$types ;
    }

    public function render()
    {
        return view('livewire.settings.icons.icons-form');
    }


    public function save()
    {
        $validated = $this->validate();
        if (empty($this->logo) && empty($this->logo_path)){
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error', 'message' => 'الحقل الشعار مطلوب']);
            return ;
        }
        $data= $this->formData($validated);
        if ($this->icon) {
            $data = $this->uploadImages($data, $this->icon->id);
            $this->icon->update($data);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.updated', ['model' => __('names.icon')])]);
        } else {
            $icon = Icon::create($data);

            $data = $this->uploadImages($data, $icon->id);
            if (!empty($data['logo'])) {
                $icon->update(['logo' => $data['logo']]);
            }

            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.created', ['model' => __('names.icon')])]);
        }

//        $this->reset();
        return redirect()->route('admin.settings.platforms.icons.index')->with('success', __('message.updated', ['model' => __('names.icon')]));
    }

    private function uploadImages($validated, $id)
    {
//        $sizes = [];
//        $sizes[] = ['width' => 135, 'height' => 72, 'name' => 'app'];
//        $sizes[] = ['width' => 351, 'height' => 187, 'name' => 'app-show'];

        if (!empty($validated['logo'])) {
            $validated['logo'] = uploadFile($this->logo, "icons", $id, 'logo', true);
        } else {
            $validated = Arr::except($validated, array('logo'));
        }

        return $validated;
    }

    private function formData($validated)
    {
        $data = $validated;
        $data = Arr::except($data, array('name'));
        $data = Arr::except($data, array('name_en'));
        $data['name']['ar'] = $validated['name'];
        $data['name']['en'] = $validated['name_en'];
        return $data ;
    }

    public function messages()
    {
        return [
        ];
    }
}
