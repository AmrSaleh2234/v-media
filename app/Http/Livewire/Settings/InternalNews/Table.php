<?php

namespace App\Http\Livewire\Settings\InternalNews;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\InternalNews;
use Livewire\Component;

class Table extends BasicTable
{
    protected $listeners = ['confirmDelete'];

    public $news = [];

    public function mount() {
        $this->news = InternalNews::get();
    }

    public function render()
    {
        return view('livewire.settings.internal-news.table');
    }

    public function confirmDelete($id) {
        $news = InternalNews::whereId($id)->first();

        $news->delete();

        $this->dispatchBrowserEvent('toastr',
        ['type' => 'success', 'message' => __('message.deleted',["model" => __('names.internal-news')])]);

        $this->news = InternalNews::get();
    }
}
