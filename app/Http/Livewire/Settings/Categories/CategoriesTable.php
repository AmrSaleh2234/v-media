<?php

namespace App\Http\Livewire\Settings\Categories;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\CMS\Category;
use App\Models\CMS\Service;
use App\Services\CMS\CategoryService;
use App\Services\CMS\ServiceService;
use Livewire\Component;

class CategoriesTable extends BasicTable
{
    protected $listeners = ['confirmDelete'];

    public function render()
    {
        $service = new CategoryService();
        return view('livewire.settings.categories.categories-table',[
            'categories' => $service->search($this->search)
//                ->confirmed()
//                ->with('category')
                ->when($this->start_date,function ($query){
                    $query->where('created_at','>=',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at','<=',$this->end_date);
                })
//                ->when( !empty($this->status_id)   ,function ($query){
//                    $query->where('status_id','>=',$this->status_id);
//                })
//                ->select(['id','name','main_image'])
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage)
        ]);
    }
    public function confirmDelete($id)
    {
        $category = Category::find($id);
        if ($category->active) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.service')])]);
            return ;
        } elseif($category->services()->exists()) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.category'),'relation'=>__('names.services')])]);
            return ;
        }elseif($category->posts()->exists()) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.category'),'relation'=>__('names.posts')])]);
            return ;
        }
        $category->delete();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.deleted',['model'=>__('names.category')])]);
        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }
}
