<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="universities-setting" ></x-breadcrumb>
    @endsection
    <livewire:settings.universities.universities-table />
</x-admin-app>
