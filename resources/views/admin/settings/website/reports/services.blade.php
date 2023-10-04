<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="services-requests" ></x-breadcrumb>
    @endsection
        <livewire:settings.website.reports.services-table />
</x-admin-app>
