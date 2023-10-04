<?php

namespace App\Http\Livewire\Settings\Website;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Attachment;
use App\Models\CMS\Icon;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;

class AboutPage extends BasicForm
{

    protected $rules = [
        'setting.about_page_icons' => 'required|string',
        'setting.about_us.ar' => 'required|string',
        'setting.about_us.en' => 'required|string',
        'setting.vision.ar' => 'required|string',
        'setting.vision.en' => 'required|string',
        'setting.goal.ar' => 'required|string',
        'setting.goal.en' => 'required|string',
        'setting.about_slogan.ar' => 'required|string',
        'setting.about_slogan.en' => 'required|string',
        'setting.projects.*.ar' => 'required|string',
        'setting.projects.*.en' => 'required|string',
        'setting.projects.*.num' => 'required|numeric',
        'setting.about_page_image.0' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:32000',
        'setting.files.*.name' => 'required|string',
        'setting.files.*.file' => 'nullable|file|max:32000',
        'setting.files.*.path' => 'nullable|string',
        'setting.files.*.original_name' => 'nullable|string',
        'setting.files.*.size' => 'nullable|string',
        'setting.files.*.extension' => 'nullable|string',
    ];

    public $about_image_path, $files = [];
    public $setting, $types, $attachments;
    use WithFileUploads;

    public function mount()
    {
        $this->setting = \App\Models\Setting::where('group', 'about_us')
            ->whereIn('key', ['about_page_icons', 'about_us', 'vision', 'goal', 'about_slogan', 'projects', 'about_page_image', 'files'])
            ->pluck('value', 'key')->toArray();

        if (empty($this->setting)) {
            $this->setting = ['about_page_icons' => [], 'about_page_image' => null, 'about_us' => [],
                'vision' => [], 'goal' => [], 'about_slogan' => [], 'projects' => [[]], 'files' => [['file' => null, 'path' => null, 'name' => '',
                    'original_name' => '', 'size' => '', 'extension' => '']]];
//            dd($this->setting);
        } else {
            $this->about_image_path = $this->setting['about_page_image'][0];
            unset($this->setting['about_page_image'][0]);
            $attachments = Attachment::whereIn('path', $this->setting['files'])->get();
            unset($this->setting['files']);
            foreach ($attachments as $attachment) {
//                $this->files[] = ['path' => $attachment->path,
//                        'extension' => $attachment->extension,
//                        'size' => $attachment->size,
//                        'original_name' => $attachment->original_name];
                $this->setting['files'][] = ['file'=>null,'path' => $attachment->path, 'name' => $attachment->original_name, 'original_name' => $attachment->original_name, 'extension' => $attachment->extension,
                    'size' => $attachment->size];
            }
        }
        $this->types = Icon::$types;
//        dd(    $this->files);
    }

    public function render()
    {
        return view('livewire.settings.website.about-page');
    }

    public function addProject()
    {
        $this->setting['projects'][] = array();
    }

    public function deleteProject($index)
    {
        unset($this->setting['projects'][$index]);
    }

    public function addFile()
    {
        $this->setting['files'][] = ['file' => null, 'path' => null, 'name' => '',
            'original_name' => '', 'size' => '', 'extension' => ''];
//        dd($this->setting);
    }

    public function deleteFile($index)
    {
        if (count($this->setting['files']) > 1){
            unset($this->setting['files'][$index]);
        }
    }

    public function save()
    {
        $data = $this->validate();

        if (empty($this->setting['about_page_image']) && empty($this->about_image_path)) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error', 'message' => 'الحقل صورة نبذة عنا مطلوب']);
            return;
        }
//        $data = $this->formData($validated);
        $data['setting'] = $this->uploadImages($data['setting'], 0);
//        dd($data);
        foreach ($data['setting'] as $key => $value) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $key, 'group' => 'about_us'],
                [
                    'key' => $key,
                    'value' => $value,
                    'type' => 'website',
                    'group' => 'about_us'
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

        if (!empty($validated['about_page_image'])) {
            $path = uploadFile($this->setting['about_page_image'][0], "website", $id, 'about_page_image', true);
            unset($validated['about_page_image'][0]);
            $validated['about_page_image'][0] = $path;
        } else {
            $validated = Arr::except($validated, array('about_page_image'));
        }
        if (!empty($validated['files'])) {

            foreach ($validated['files'] as $key => $file) {
                if (is_object($file['file'])) {
//                    if ($this->companyProject){
//                       Attachment::where('type','about_files')->delete();
//                    }
                    $path = uploadFile($file['file'], "website", $id, 'about-files', false, null, $file['name']);
                }else{
                    $path = $validated['files'][$key]['path'];
                }
                unset($validated['files'][$key]);
                $validated['files'][$key] = $path;
            }
        } else {
            $validated = Arr::except($validated, array('files'));
        }

        return $validated;
    }
}
