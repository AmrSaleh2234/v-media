<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-news' : 'create-news'" ></x-breadcrumb>
    @endsection
    <livewire:settings.news.news-form :id="$id ?? null"/>
</x-admin-app>
