<?php

namespace App\Http\Livewire\Settings\Categories;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\CMS\Category;
use App\Models\CMS\CompanyProject;
use App\Models\CMS\ProjectType;
use App\Models\CMS\Service;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoriesForm extends BasicForm
{
    protected $rules = [
        'name' => 'required|string',
        'name_en' => 'required|string',
        'type' => 'required|string',
    ];

    public $name, $name_en, $type ,$types;
    public $category;


    public function mount($id = null)
    {

        if ($id) {
            $this->category = Category::find($id);
            $this->name = $this->category->name['ar'];
            $this->name_en = $this->category->name['en'];
            $this->type = $this->category->type;

            $this->title = 'edit';
            $this->button = 'update';
//            $this->color = 'primary';

        }
        $this->types = Category::$types;
    }

    public function render()
    {
        return view('livewire.settings.categories.categories-form');
    }

    public function save()
    {
        $validated = $this->validate();

        $data = $this->formData($validated);

        if ($this->category) {
            $this->category->update($data);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.updated', ['model' => __('names.category')])]);
        } else {
            Category::create($data);


            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.created', ['model' => __('names.category')])]);
        }

//        $this->reset();
        return redirect()->route('admin.settings.platforms.categories.index')->with('success', __('message.updated', ['model' => __('names.category')]));
    }


    private function formData($validated)
    {
        $data = $validated;
        $data = Arr::except($data, array('name'));
        $data = Arr::except($data, array('name_en'));
        $data['name']['ar'] = $validated['name'];
        $data['name']['en'] = $validated['name_en'];
        return $data;
    }

}
