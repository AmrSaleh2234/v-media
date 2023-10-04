<?php

namespace App\Http\Livewire\Settings\Members;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\CMS\Member;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;

class MembersForm extends BasicForm
{
    protected $rules = [
        'name' => 'required|string',
        'name_en' => 'required|string',
        'job_title' => 'required|string',
        'job_title_en' => 'required|string',
        'description' => 'required|string',
        'description_en' => 'required|string',
        'image' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        'app' => 'required|boolean',
        'website' => 'required|boolean',
    ];

    public $name, $name_en, $job_title, $job_title_en, $description, $description_en, $image, $image_path, $app = 0, $website = 0;
    public $member;

    use WithFileUploads;

    public function mount($id = null)
    {
        if ($id) {
            $this->member = Member::find($id);
            $this->name = $this->member->name['ar'];
            $this->name_en = $this->member->name['en'];
            $this->job_title = $this->member->job_title['ar'];
            $this->job_title_en = $this->member->job_title['en'];
            $this->description = $this->member->description['ar'];
            $this->description_en = $this->member->description['en'];

            $this->image_path = $this->member->image;
            $this->app = $this->member->app;
            $this->website = $this->member->website;
        }
    }

    public function render()
    {
        return view('livewire.settings.members.members-form');
    }


    public function save()
    {
        $validated = $this->validate();
        if (empty($this->image) && empty($this->image_path)) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error', 'message' => 'الحقل الصورة الشخصية مطلوب']);
            return;
        }
        $data = $this->formData($validated);
        if ($this->member) {
            $data = $this->uploadImages($data, $this->member->id);
            $this->member->update($data);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.updated', ['model' => __('names.member')])]);
        } else {
            $member = Member::create($data);

            $data = $this->uploadImages($data, $member->id);
            if (!empty($data['image'])) {
                $member->update(['image' => $data['image']]);
            }

            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.created', ['model' => __('names.member')])]);
        }

//        $this->reset();
        return redirect()->route('admin.settings.platforms.members.index')->with('success', __('message.updated', ['model' => __('names.member')]));
    }

    private function uploadImages($validated, $id)
    {
//        $sizes = [];
//        $sizes[] = ['width' => 135, 'height' => 72, 'name' => 'app'];
//        $sizes[] = ['width' => 351, 'height' => 187, 'name' => 'app-show'];

        if (!empty($validated['image'])) {
            $validated['image'] = uploadFile($this->image, "members", $id, 'image', true);
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
        $data = Arr::except($data, array('job_title'));
        $data = Arr::except($data, array('job_title_en'));
        $data = Arr::except($data, array('description'));
        $data = Arr::except($data, array('description_en'));
        $data['name']['ar'] = $validated['name'];
        $data['name']['en'] = $validated['name_en'];
        $data['job_title']['ar'] = $validated['job_title'];
        $data['job_title']['en'] = $validated['job_title_en'];
        $data['description']['ar'] = $validated['description'];
        $data['description']['en'] = $validated['description_en'];
        return $data;
    }

    public function messages()
    {
        return [
        ];
    }
}
