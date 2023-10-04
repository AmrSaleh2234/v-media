<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="news-setting" ></x-breadcrumb>
    @endsection
        <livewire:settings.news.news-table />
</x-admin-app>
