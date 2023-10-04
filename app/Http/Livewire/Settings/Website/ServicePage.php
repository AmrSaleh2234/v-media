<?php

namespace App\Http\Livewire\Settings\Website;

use App\Models\CMS\Page;
use App\Models\CMS\Section;
use App\Models\CMS\Service;
use Livewire\Component;

class ServicePage extends Component
{

    protected $rules = [
        "sections.*.title.ar" => 'required',
        "sections.*.title.en" => 'required',
        "sections.*.description.ar" => 'required',
        "sections.*.description.en" => 'required',
        "sections.*.design" => 'required',
        "sections.*.services" => 'required',
    ];

    public $sections_no = 1;
    public $sections;
    public $services= [];
    public $designs = [];
    public $servicePageId;
    public function mount() {
        $this->services = Service::website()->pluck('name','id')->toArray();
        $this->designs = designTypes();
        $servicePage = Page::where("name", "like" , "%service%")->first();

        if($servicePage == null) {
            $servicePage = new Page([
                'user_id' => auth()->user()->id,
                'link' => '#',
                'name' => ["ar"=> "صفحة الخدمات" , "en" => "Service Page"],
                'active' => 1,
            ]);
            $servicePage->save();
        }
        $this->servicePageId = $servicePage->id;
        $allSections = Section::where('page_id', $this->servicePageId)->get();

        if(count($allSections) > 1) {
            $this->sections_no = count($allSections);
        }
        foreach($allSections as $section) {
            $this->sections[] =array_merge( $section->value, ['id' => $section->id]);
        }
    }

    public function render()
    {
        return view('livewire.settings.website.service-page');
    }


    public function addSections() {
        $this->sections_no = $this->sections_no + 1;
    }

    public function removeSections($id) {
        if(  empty($this->sections) || count($this->sections) <= $id) {
            $this->sections_no = $this->sections_no - 1;
            return;
        }

        $section = $this->sections[$id];
        if(array_key_exists("id", $section)) {

            Section::where('id', $section["id"])->delete();

        }
         $allSections = Section::where('page_id', $this->servicePageId)->get();

        $this->reset('sections');
         if(count($allSections) != 0) {
            $this->sections_no = count($allSections);
         } else {
            $this->sections_no = 1;
         }
        foreach($allSections as $section) {
            $this->sections[] =array_merge( $section->value, ['id' => $section->id]);
        }

         $this->dispatchBrowserEvent('toastr',
            ['type' => 'success', 'message' => __('message.updated', ['model' => __('names.service-page')])]);
    }

    public function save() {


        if(empty($this->sections)) {
            $this->dispatchBrowserEvent('toastr',
            ['type' => 'error', 'message' => __('message.cannot-save', ['model' => __('names.service-page')])]);
            return ;
        }
        if(count($this->sections) >= 1) {
            $sections = Section::where('page_id',  $this->servicePageId)->get();
            foreach($sections as $section) {
                $section->delete();
            }
        }
        foreach($this->sections as $key => $section) {
            $newSection = new Section([
                'key' => 'section '. ($key + 1),
                'value' => $section,
                'app' => 0,
                'website' => 1,
                'page_id' =>  $this->servicePageId,
            ]);
            $newSection->save();
        }

         $allSections = Section::where('page_id', $this->servicePageId)->get();

        $this->reset('sections');
         $this->sections_no = count($allSections);
        foreach($allSections as $section) {
            $this->sections[] =array_merge( $section->value, ['id' => $section->id]);
        }
         $this->dispatchBrowserEvent('toastr',
            ['type' => 'success', 'message' => __('message.updated', ['model' => __('names.service-page')])]);
    }
}
