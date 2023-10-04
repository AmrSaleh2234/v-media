<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="subscribers" ></x-breadcrumb>
    @endsection
    <livewire:settings.website.reports.subscribers-table />
</x-admin-app>
