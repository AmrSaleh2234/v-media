<?php

namespace App\Http\Livewire\Settings\Projects;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Attachment;
use App\Models\CMS\CompanyProject;
use App\Models\CMS\ProjectServicePivot;
use App\Models\CMS\ProjectType;
use App\Models\CMS\Service;
use App\Services\FCM\FCMService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectsForm extends BasicForm
{

    protected $rules = [
        'title' => 'required|string',
        'title_en' => 'required|string',
        'name' => 'required|string',
        'name_en' => 'required|string',
        'project_type_id' => 'nullable|exists:project_types,id',
        'description' => 'required|string',
        'description_en' => 'required|string',
        'main_image' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:10240',
        'sub_image1' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:10240',
        'sub_image2' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:10240',
        'sub_image3' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:10240',
        'sub_image4' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:10240',
        'workZones' => 'nullable|array',
        'workZones.*.service_id' => 'required|exists:services,id',
        'workZones.*.zone' => 'required|string',
        'workZones.*.zone_en' => 'required|string',
        'is_featured' => 'required|boolean',
        'app' => 'required|boolean',
        'website' => 'required|boolean',
    ];

    public $title, $title_en, $name, $name_en, $project_type_id, $description, $description_en, $main_image, $main_image_path;
    public $sub_image1, $sub_image1_path, $sub_image2, $sub_image2_path, $sub_image3, $sub_image3_path, $sub_image4, $sub_image4_path, $is_featured = 0, $app = 0, $website = 0;
    public $companyProject, $files = [];
    public array $workZones;

    use WithFileUploads;

    public function mount($id = null)
    {
        if ($id) {
            $this->companyProject = CompanyProject::with(['services', 'attachments', 'pivots'])->whereId($id)->first();

            $this->title = $this->companyProject->title['ar'];
            $this->title_en = $this->companyProject->title['en'];
            $this->name = $this->companyProject->name['ar'];
            $this->name_en = $this->companyProject->name['en'];
            $this->description = $this->companyProject->description['ar'];
            $this->description_en = $this->companyProject->description['en'];
            $this->project_type_id = $this->companyProject->project_type_id;
            $this->main_image_path = $this->companyProject->main_image;
            $this->is_featured = $this->companyProject->is_featured;
            $this->app = $this->companyProject->app;
            $this->website = $this->companyProject->website;

//            $this->title = 'edit';
            $this->button = 'update';
            $this->color = 'primary';
            if ($this->companyProject->services()->exists()) {
                foreach ($this->companyProject->services as $service) {
                    $z = json_decode($service->pivot->zone) ;
                    $this->workZones[] = ['service_id' => $service->id, 'zone' =>$z->ar, 'zone_en' => $z->en, ];
//                        'file' => ['path' => $pivot->file, 'description' => '', 'file' => null, 'size' => '', 'original_name' => '', 'extension' => '']];

                }
            } else {
                $this->workZones[] = []; // ['file' => ['path' => null, 'description' => '', 'file' => null, 'size' => '', 'original_name' => '', 'extension' => '']];
            }


            foreach ($this->companyProject->attachments as $attachment) {
                if ($attachment->type == 'sub_image1') {
                    $this->sub_image1_path = $attachment->path;
                } elseif ($attachment->type == 'sub_image2') {
                    $this->sub_image2_path = $attachment->path;

                } elseif ($attachment->type == 'sub_image3') {
                    $this->sub_image3_path = $attachment->path;

                } elseif ($attachment->type == 'sub_image4') {
                    $this->sub_image4_path = $attachment->path;
                }
            }

//                foreach ($this->workZones as $key => $zon) {
//                    $attachment = Attachment::where('path', $zon['file']['path'])->first();
//                    if ($attachment) {
//                        unset($this->workZones[$key]['file']);
//                        $this->workZones[$key]['file'] = ['file' => null, 'path' => $attachment->path, 'original_name' => $attachment->original_name, 'extension' => $attachment->extension,
//                            'size' => $attachment->size];
//                    }
//                }


//            dd($this->companyProject->attachments  );
        } else {
            $this->workZones[] =  [];//  ['file' => ['path' => null, 'description' => '', 'file' => null, 'size' => '', 'original_name' => '', 'extension' => '']];
//            $this->files = [['path' => null, 'description' => '', 'file' => null, 'size' => '', 'original_name' => '', 'extension' => '']];

        }

        $this->lang = auth()->user()->lang ?? 'ar';
//        dd($this->workZones);
    }

//    public function updatedMainImage()
//    {
//        $this->validate(['main_image' => 'unique:services,title']);
//    }

    public
    function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public
    function render()
    {
        return view('livewire.settings.projects.projects-form', [
            'projectTypes' => ProjectType::pluck('name', 'id')->toArray(),
            'services' => Service::pluck('name', 'id')->toArray()
        ]);
    }

    public
    function addZone()
    {
        $this->workZones[] = [];//['file' => ['path' => null, 'description' => '', 'file' => null, 'size' => '', 'original_name' => '', 'extension' => '']];
    }

    public
    function deleteZone($index)
    {
        unset($this->workZones[$index]);
    }

    public function save()
    {
        $validated = $this->validate();
        if (empty($this->main_image) && empty($this->main_image_path)) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error', 'message' => 'الحقل الصورة الرئيسية مطلوب']);
            return;
        }
        $data = $this->formData($validated);
        if ($this->companyProject) {
            $data = $this->uploadImages($data, $this->companyProject->id);
            $this->companyProject->update($data);
            $this->saveWorkZones($this->companyProject);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.updated', ['model' => __('names.project')])]);
        } else {
            $companyProject = CompanyProject::create($data);


            $data = $this->uploadImages($data, $companyProject->id);
            if (!empty($data['main_image'])) {
                $companyProject->update(['main_image' => $data['main_image']]);
            }
            $this->saveWorkZones($companyProject);


            // Send Notification

            // $fcm = new FCMService();
            // $fcm->sendNotification([],"New Project Added !", $this->title_en, "project", $companyProject->id, null, "Client");

            //end send notification

//            $user = auth()->user();
//            activity()
//                ->performedOn($companyProject)
//                ->causedBy($user)
//                ->withProperties(['main_image' => $validated['main_image']])
//                ->event('updated')
//                ->useLog($user->name)
//                ->log('Company Project Has been Updated');
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.created', ['model' => __('names.project')])]);
        }

//        $this->reset();
        return redirect()->route('admin.settings.platforms.projects.index')->with('success', __('message.updated', ['model' => __('names.project')]));
    }

    private
    function uploadImages($validated, $id)
    {
        $sizes = [];
        $sizes[] = ['width' => 135, 'height' => 72, 'name' => 'app'];
        $sizes[] = ['width' => 351, 'height' => 187, 'name' => 'app_show'];

        if (!empty($validated['main_image'])) {
            if ($this->companyProject) {
                $this->companyProject->attachments()->whereIn('type', ['main_image', 'main_image_app', 'main_image_app_show'])->delete();
            }
            $validated['main_image'] = uploadFile($this->main_image, "company-projects", $id, 'main_image', true, $sizes);
        } else {
            $validated = Arr::except($validated, array('main_image'));
        }
        if (!empty($validated['sub_image1'])) {
            if ($this->companyProject) {
                $this->companyProject->attachments()->whereIn('type', ['sub_image1', 'sub_image1_app', 'sub_image1_app_show'])->delete();

            }
            uploadFile($this->sub_image1, "company-projects", $id, 'sub_image1', true, $sizes);
        }
        if (!empty($validated['sub_image2'])) {
            if ($this->companyProject) {
                $this->companyProject->attachments()->whereIn('type', ['sub_image2', 'sub_image2_app', 'sub_image2_app_show'])->delete();
            }
            uploadFile($this->sub_image2, "company-projects", $id, 'sub_image2', true, $sizes);
        }
        if (!empty($validated['sub_image3'])) {
            if ($this->companyProject) {
                $this->companyProject->attachments()->whereIn('type', ['sub_image3', 'sub_image3_app', 'sub_image3_app_show'])->delete();
            }
            uploadFile($this->sub_image3, "company-projects", $id, 'sub_image3', true, $sizes);
        }
        if (!empty($validated['sub_image4'])) {
            if ($this->companyProject) {
                $this->companyProject->attachments()->whereIn('type', ['sub_image4', 'sub_image4_app', 'sub_image4_app_show'])->delete();
            }
            uploadFile($this->sub_image4, "company-projects", $id, 'sub_image4', true, $sizes);
        }

        $validated = Arr::except($validated, array('sub_image1'));
        $validated = Arr::except($validated, array('sub_image2'));
        $validated = Arr::except($validated, array('sub_image3'));
        $validated = Arr::except($validated, array('sub_image4'));

        return $validated;
    }

    private
    function saveWorkZones($companyProject)
    {
        $companyProject->services()->detach();
        foreach ($this->workZones as $zone) {
            $companyProject->services()->attach([
                $zone['service_id'] => [ 'zone' => json_encode(['ar' => $zone['zone'], 'en' => $zone['zone_en']])]
            ]);
//            $pivot = ProjectServicePivot::create([
//                'company_project_id' => $companyProject->id,
//                'service_id' => $zone['service_id'],
//                'zone' => ['ar' => $zone['zone'], 'en' => $zone['zone_en']]
//            ]);
//            if (is_object($zone['file']['file'])) {
//                if ($this->companyProject) {
//                    $pivot->attachments()->delete();
//                }
//                $path = uploadFile($zone['file']['file'], "work-zones", $pivot->id, 'file', true, $sizes);
//            } else {
//                $path = $zone['file']['path'];
//            }
//            $pivot->update(['file' => $path]);
        }
    }

    private
    function formData($validated)
    {
        $data = $validated;
        $data = Arr::except($data, array('title'));
        $data = Arr::except($data, array('title_en'));
        $data = Arr::except($data, array('name'));
        $data = Arr::except($data, array('name_en'));
        $data = Arr::except($data, array('description'));
        $data = Arr::except($data, array('description_en'));

        $data['title']['ar'] = $validated['title'];
        $data['title']['en'] = $validated['title_en'];
        $data['name']['ar'] = $validated['name'];
        $data['name']['en'] = $validated['name_en'];
        $data['description']['ar'] = $validated['description'];
        $data['description']['en'] = $validated['description_en'];
        return $data;
    }

    public
    function messages()
    {
        return [
            'workZones.*.service_id.required' => 'الحقل الخدمة مطلوب',
            'workZones.*.zone.required' => 'الحقل نطاق العمل مطلوب'
        ];
    }
}
