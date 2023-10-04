<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="cities-setting" ></x-breadcrumb>
    @endsection
    <livewire:settings.cities.cities-table />
</x-admin-app>
