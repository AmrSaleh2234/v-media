<?php

namespace App\Http\Livewire\Settings\News;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\CMS\Category;
use App\Models\CMS\News;
use App\Models\CMS\Service;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewsForm extends BasicForm
{
    protected $rules = [
        'title' => 'required|string',
        'title_en' => 'required|string',
        'content' => 'required|string',
        'content_en' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:4096',
        'thumbnail' => 'nullable|image|max:2048',
        'published_at' => 'required|date',
        'end_at' => 'required|date|after:today',
        'app' => 'required|boolean',
        'website' => 'required|boolean',
    ];

    public $title,$title_en, $content,$content_en,$category_id,$image, $image_path,$thumbnail,$thumbnail_path,$published_at,$end_at,$app = 0 ,$website = 0;
    public $news;

    use WithFileUploads;

    public function mount($id = null)
    {
        if ($id) {
            $this->news = News::find($id);
            $this->title = $this->news->title['ar'];
            $this->title_en = $this->news->title['en'];
            $this->content = $this->news->content['ar'];
            $this->content_en = $this->news->content['en'];
            $this->category_id = $this->news->category_id;
            $this->image_path = $this->news->image;
            $this->thumbnail_path = $this->news->thumbnail;
            $this->published_at = $this->news->published_at;
            $this->end_at = $this->news->end_at;
            $this->app = $this->news->app;
            $this->website = $this->news->website;
        }
    }

    public function render()
    {
        return view('livewire.settings.news.news-form', [
            'categories' => Category::where('type','news')->pluck('name', 'id')->toArray()
        ]);
    }


    public function save()
    {
        $validated = $this->validate();
        if (empty($this->image) && empty($this->image_path)){
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error', 'message' => 'الحقل الصورة الرئيسية مطلوب']);
            return ;
        }
        $data= $this->formData($validated);
        if ($this->news) {
            $data = $this->uploadImages($data, $this->news->id);
            $this->news->update($data);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.updated', ['model' => __('names.news')])]);
        } else {
            $news = News::create($data);

            $data = $this->uploadImages($data, $news->id);
            if (!empty($data['image'])) {
                $news->update(['image' => $data['image']]);
            }
            if (!empty($data['thumbnail'])) {
                $news->update(['thumbnail' => $data['thumbnail']]);
            }

            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.created', ['model' => __('names.news')])]);
        }

//        $this->reset();
        return redirect()->route('admin.settings.platforms.news.index')->with('success', __('message.updated', ['model' => __('names.news')]));
    }

    private function uploadImages($validated, $id)
    {
//        $sizes = [];
//        $sizes[] = ['width' => 135, 'height' => 72, 'name' => 'app'];
//        $sizes[] = ['width' => 351, 'height' => 187, 'name' => 'app-show'];

        if (!empty($validated['image'])) {
            $validated['image'] = uploadFile($this->image, "news", $id, 'image', true);
        } else {
            $validated = Arr::except($validated, array('image'));
        }
        if (!empty($validated['thumbnail'])) {
            $validated['thumbnail'] = uploadFile($this->thumbnail, "news", $id, 'thumbnail', true);
        } else {
            $validated = Arr::except($validated, array('thumbnail'));
        }

        return $validated;
    }

    private function formData($validated)
    {
        $data = $validated;
        $data = Arr::except($data, array('title'));
        $data = Arr::except($data, array('title_en'));
        $data = Arr::except($data, array('content'));
        $data = Arr::except($data, array('content_en'));
        $data['title']['ar'] = $validated['title'];
        $data['title']['en'] = $validated['title_en'];
        $data['content']['ar'] = $validated['content'];
        $data['content']['en'] = $validated['content_en'];
        return $data ;
    }

    public function messages()
    {
        return [
        ];
    }
}
