<?php

namespace App\Http\Livewire\Settings\InternalNews;

use App\Models\User;
use App\Notifications\MainNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use App\Http\Livewire\Basic\BasicForm;
use App\Models\Hr\Department;
use App\Models\Hr\Management;
use App\Models\InternalNews;
use Livewire\WithFileUploads;
use App\Services\FCM\FCMService;

class Form extends BasicForm
{

    use WithFileUploads;

    protected $rules = [
        "internal.title.ar" => 'required',
        'internal.title.en' => 'required',
        'internal.management_id' => 'required|exists:managements,id',
        'internal.department_id' => 'required|exists:departments,id',

    ];
    public $internal;
    public $managements = [];
    public $departments = [];

    public function mount($id = null) {
        if($id != null) {
            $internal = InternalNews::whereId($id)->first();
            $this->internal['id'] = $internal->id;
            $this->internal['title']['ar'] = $internal->title['ar'];
            $this->internal['title']['en']= $internal->title['en'];
            $this->internal['management_id'] = $internal->management_id;
            $this->internal['department_id'] = $internal->department_id;
            $this->internal['attachment'] = $internal->attachment;

            $this->internal['active'] = $internal->active;
            $this->departments = Department::where('management_id', $this->internal['management_id'])->pluck('name',
            'id')->toArray();
        }
        $this->managements = Management::pluck('name','id')->toArray();
    }


    public function updatedInternalManagementId($id) {
        $this->departments = Department::where('management_id', $id)->pluck('name', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.settings.internal-news.form');
    }

    public function save() {
        $validated = $this->validate();

        if(array_key_exists('id', $this->internal)) {
            $newInternal = InternalNews::whereId($this->internal['id'])->first();
            $newInternal->update($this->internal);

        } else {

            if(empty($this->internal['attachment'])) {
                $this->dispatchBrowserEvent('toastr',
                ['type' => 'danger', 'message' => __('message.empty',["model" => __('names.attachment')])]);
                return;
            }

             $newInternal = InternalNews::create($this->internal);
        }


        if($this->internal['attachment'] && gettype($this->internal['attachment']) != "string") {
             $url = uploadFile($this->internal['attachment'], "internalNews",$newInternal->id,
            "attachment", true);
             $newInternal->attachment = $url;
             $newInternal->save();
        }



        if(! array_key_exists('id', $this->internal)) {
            $users = User::all();
            $data = [];
            $data['from'] =  config('app.name');
            $data['message'] = "تم اضافة تعميم جديد ( " . $this->internal['title']['ar'] . ' )';
            $data['url'] =      route('admin.attendance.requests.index');
            Notification::send($users, new MainNotification($data));

            $fcm = new FCMService();

          $fcm->sendNotification([],"تم اضافة تعاميم جديدة", $this->internal['title']['ar'], null, null, null, "users");

            $this->dispatchBrowserEvent('toastr',
            ['type' => 'success', 'message' => __('message.created',["model" => __('names.internal-news')])]);
            $this->reset();

        } else {

            $this->dispatchBrowserEvent('toastr',
            ['type' => 'success', 'message' => __('message.updated',["model" => __('names.internal-news')])]);
        }

    }
}
