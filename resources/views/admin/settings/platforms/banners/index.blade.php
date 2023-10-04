<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="banners-setting" ></x-breadcrumb>
    @endsection
    <livewire:settings.banners.banners-table />
</x-admin-app>
