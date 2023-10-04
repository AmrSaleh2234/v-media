<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="main-page-setting" ></x-breadcrumb>
    @endsection
    <livewire:settings.website.main-page />
</x-admin-app>
