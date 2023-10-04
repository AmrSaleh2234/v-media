<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="services-setting" ></x-breadcrumb>
    @endsection
        <livewire:settings.services.services-table />
</x-admin-app>
