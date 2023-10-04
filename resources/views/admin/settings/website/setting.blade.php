<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="footer-header-setting" ></x-breadcrumb>
    @endsection
    <livewire:settings.website.setting />
</x-admin-app>
