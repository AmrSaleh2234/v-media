<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="internal-news"></x-breadcrumb>
    @endsection
    <livewire:settings.internal-news.table />
</x-admin-app>
