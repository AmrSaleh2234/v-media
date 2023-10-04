<?php

namespace App\Http\Livewire\Settings\News;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\CMS\News;
use App\Services\CMS\NewsService;
use Livewire\Component;

class NewsTable extends BasicTable
{
    protected $listeners = ['confirmDelete'];
    public function render()
    {
        $service = new NewsService();
        return view('livewire.settings.news.news-table',[
            'news' => $service->search($this->search)
//                ->confirmed()
                ->with('category')
                ->when($this->start_date,function ($query){
                    $query->where('created_at','>=',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at','<=',$this->end_date);
                })
//                ->when( !empty($this->status_id)   ,function ($query){
//                    $query->where('status_id','>=',$this->status_id);
//                })
//                ->select(['id','title'])
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage)
        ]);
    }

    public function confirmDelete($id)
    {
        $news = News::find($id);
        if ($news->app) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.news'),'relation'=>__('names.application')])]);
            return ;
        } elseif($news->website) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.news'),'relation'=>__('names.website')])]);
            return ;
        }
        $news->delete();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.deleted',['model'=>__('names.news')])]);
        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }
}
