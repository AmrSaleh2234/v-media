<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="internal-news-create"></x-breadcrumb>
    @endsection
    <livewire:settings.internal-news.form :id="$id ?? null" />
</x-admin-app>
