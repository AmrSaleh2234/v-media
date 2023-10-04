<?php

namespace App\Http\Livewire\Settings\Banners;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\CMS\Banner;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;

class BannersForm extends BasicForm
{
    protected $rules = [
        'name' => 'required|string',
        'name_en' => 'required|string',
//        'description' => 'required|string',
//        'description_en' => 'required|string',
//        'link' => 'required|url',
        'image' => 'nullable|mimes:jpeg,png,jpg,gif,mp4,avi|max:10240|dimensions:ratio=16/9',
        'app' => 'required|boolean',
        'website' => 'required|boolean',
    ];

    public $name, $name_en, $description, $description_en, $link, $image, $image_path, $app = 0, $website = 0;
    public $banner;

    use WithFileUploads;

    public function mount($id = null)
    {
        if ($id) {
            $this->banner = Banner::find($id);
            $this->name = $this->banner->name['ar'];
            $this->name_en = $this->banner->name['en'];
            $this->description = $this->banner->description['ar'];
            $this->description_en = $this->banner->description['en'];
            $this->link = $this->banner->link;
            $this->image_path = $this->banner->image;
            $this->app = $this->banner->app;
            $this->website = $this->banner->website;
        }
    }

    public function render()
    {
        return view('livewire.settings.banners.banners-form');
    }


    public function save()
    {
        $validated = $this->validate();

        if (empty($this->image) && empty($this->image_path)) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error', 'message' => 'الحقل الصورة مطلوب']);
            return;
        }
        $data = $this->formData($validated);
        if (is_object($this->image)){
            $mime = $this->image->getMimeType();
            if (strstr($mime, "video/") || strstr($mime, "/gif") ) {
                $data['type'] = 'video';
            } else if (strstr($mime, "image/")) {
                $data['type'] = 'image';
            }
        }

        if ($this->banner) {
            $data = $this->uploadImages($data, $this->banner->id);
            $this->banner->update($data);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.updated', ['model' => __('names.banner')])]);
        } else {
            $banner = Banner::create($data);

            $data = $this->uploadImages($data, $banner->id);
            if (!empty($data['image'])) {
                $banner->update(['image' => $data['image']]);
            }

            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.created', ['model' => __('names.banner')])]);
        }

//        $this->reset();
        return redirect()->route('admin.settings.platforms.banners.index')->with('success', __('message.updated', ['model' => __('names.banner')]));
    }

    private function uploadImages($validated, $id)
    {
//        $sizes = [];
//        $sizes[] = ['width' => 135, 'height' => 72, 'name' => 'app'];
//        $sizes[] = ['width' => 351, 'height' => 187, 'name' => 'app-show'];

        if (!empty($validated['image'])) {
            $validated['image'] = uploadFile($this->image, "banners", $id, 'image', true);
        } else {
            $validated = Arr::except($validated, array('image'));
        }

        return $validated;
    }

    private function formData($validated)
    {
        $data = $validated;
        $data = Arr::except($data, array('name'));
        $data = Arr::except($data, array('name_en'));
//        $data = Arr::except($data, array('description'));
//        $data = Arr::except($data, array('description_en'));
        $data['name']['ar'] = $validated['name'];
        $data['name']['en'] = $validated['name_en'];
//        $data['description']['ar'] = $validated['description'];
//        $data['description']['en'] = $validated['description_en'];
        return $data;
    }

    public function messages()
    {
        return [
        ];
    }
}
