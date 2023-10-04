<?php

namespace App\Http\Livewire\Settings\Services;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Attachment;
use App\Models\CMS\Category;
use App\Models\CMS\CompanyProject;
use App\Models\CMS\ProjectType;
use App\Models\CMS\Service;
use App\Services\FCM\FCMService;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServicesForm extends BasicForm
{
    protected $rules = [
        'name' => 'required|string',
        'name_en' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required|string',
        'description_en' => 'required|string',
        'icon' => 'nullable|mimes:jpeg,png,jpg,gif,svg,ico|max:10240',

        'order_id' => 'required|numeric',
        'image' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:10240',
        'is_featured' => 'required|boolean',
        'app' => 'required|boolean',
        'website' => 'required|boolean',

        'files.*.description' => 'nullable|string',
        'files.*.file' => 'nullable|file|max:32000',
        'files.*.path' => 'nullable|string',
        'files.*.original_name' => 'nullable|string',
        'files.*.size' => 'nullable|string',
        'files.*.extension' => 'nullable|string',
    ];

    public $name, $name_en, $category_id, $link, $icon, $icon_path, $description, $description_en, $order_id, $image, $image_path, $is_featured = 0, $app = 0, $website = 0;
    public $service, $files = [];

    use WithFileUploads;

    public function mount($id = null)
    {
        if ($id) {
            $this->service = Service::whereId($id)->first();
            $this->name = $this->service->name['ar'];
            $this->name_en = $this->service->name['en'];
            $this->category_id = $this->service->category_id;
            $this->description = $this->service->description['ar'];
            $this->description_en = $this->service->description['en'];
            $this->icon_path = $this->service->icon;
            $this->image_path = $this->service->image;
            $this->link = $this->service->link;
            $this->order_id = $this->service->order_id;
            $this->is_featured = $this->service->is_featured;
            $this->app = $this->service->app;
            $this->website = $this->service->website;
            if (!empty($this->service->files)) {
//                dd($this->service->files);
                $attachments = $this->service->attachments()->where('type', 'files')->get();

                foreach ($this->service->files as $file) {
                    foreach ($attachments as $attachment) {
                        if ($attachment->path == $file['path']) {
                            $this->files[] = ['file'=>null,'path' => $attachment->path, 'description' => $file['description'], 'original_name' => $attachment->original_name, 'extension' => $attachment->extension,
                                'size' => $attachment->size];
                        }
                    }
                }
            } else {
                $this->files = [['path' => null, 'description' => '', 'file' => null, 'size' => '', 'original_name' => '', 'extension' => '']];
            }


            $this->title = 'edit';
            $this->button = 'update';
            $this->color = 'primary';
        } else {
            $this->files = [['path' => null, 'description' => '', 'file' => null, 'size' => '', 'original_name' => '', 'extension' => '']];
//            dd($this->files);

        }

    }

    public function render()
    {
        return view('livewire.settings.services.services-form', [
            'categories' => Category::where('type', 'services')->pluck('name', 'id')->toArray()
        ]);
    }

    public function addFile()
    {
        $this->files[] = ['file' => null, 'path' => null, 'name' => '',
            'original_name' => '', 'size' => '', 'extension' => ''];
//        dd($this->setting);
    }

    public function deleteFile($index)
    {
        if (count($this->files) > 1) {
            unset($this->files[$index]);
        }
    }

    public function save()
    {
        $validated = $this->validate();

        $data = $this->formData($validated);
        if (empty($this->image) && empty($this->image_path)) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error', 'message' => 'الحقل الصورة الرئيسية مطلوب']);
            return;
        }
        if (empty($this->icon) && empty($this->icon_path)) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error', 'message' => 'الحقل الأيقونة مطلوب']);
            return;
        }
        if ($this->service) {
            $data = $this->uploadImages($data, $this->service->id);
            $this->service->update($data);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.updated', ['model' => __('names.service')])]);
        } else {
            $service = Service::create($data);

            $data = $this->uploadImages($data, $service->id);
            if (!empty($data['image'])) {
                $service->update(['image' => $data['image']]);
            }
            if (!empty($data['icon'])) {
                $service->update(['icon' => $data['icon']]);
            }
            if (!empty($data['files'])) {
                $service->update(['files' => $data['files']]);
            }


            // Send Notification

            // $fcm = new FCMService();
            // $fcm->sendNotification([],"New Service Added !", $this->name_en, "service", $service->id, null, "Client");

            //end send notification


            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.created', ['model' => __('names.service')])]);
        }

//        $this->reset();
        return redirect()->route('admin.settings.platforms.services.index')->with('success', __('message.updated', ['model' => __('names.service')]));
    }

    private function uploadImages($data, $id)
    {
        $sizes = [];
//        $sizes[] = ['width' => 135, 'height' => 72, 'name' => 'app'];
//        $sizes[] = ['width' => 351, 'height' => 187, 'name' => 'app_show'];

        if (!empty($data['image'])) {
            if ($this->service) {
                $this->service->attachments()->whereIn('type', ['image', 'image_app', 'image_app_show'])->delete();
            }
            $data['image'] = uploadFile($this->image, "services", $id, 'image', true, $sizes);
        } else {
            $data = Arr::except($data, array('image'));
        }
        if (!empty($data['icon'])) {
            if ($this->service) {
                $this->service->attachments()->whereIn('type', ['icon', 'icon_app', 'icon_app_show'])->delete();
            }
            $data['icon'] = uploadFile($this->icon, "services", $id, 'icon', true, $sizes);
        } else {
            $data = Arr::except($data, array('icon'));
        }

        if (!empty($data['files'])) {
            foreach ($data['files'] as $key => $file) {
                $description = $file['description'];
                if (is_object($file['file'])) {
//                    if ($this->companyProject){
//                       Attachment::where('type','about_files')->delete();
//                    }
                    $path = uploadFile($file['file'], "services", $id, 'files', false, null);
                }else{
                    $path = $data['files'][$key]['path'];
                }
                unset($data['files'][$key]['file']);
                $data['files'][$key] = ['path' => $path,'description' => $description];
            }
        } else {
            $data = Arr::except($data, array('files'));
        }

        return $data;
    }

    private function formData($validated)
    {
        $data = $validated;
        $data = Arr::except($data, array('name'));
        $data = Arr::except($data, array('name_en'));
        $data = Arr::except($data, array('description'));
        $data = Arr::except($data, array('description_en'));
        $data['name']['ar'] = $validated['name'];
        $data['name']['en'] = $validated['name_en'];
        $data['description']['ar'] = $validated['description'];
        $data['description']['en'] = $validated['description_en'];
        return $data;
    }

    public function messages()
    {
        return [
            'workZones.*.category_id.required' => 'الحقل الفئة مطلوب',
            'workZones.*.zone.required' => 'الحقل نطاق العمل مطلوب'
        ];
    }
}
