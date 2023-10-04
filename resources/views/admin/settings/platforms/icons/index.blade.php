<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="icons-setting" ></x-breadcrumb>
    @endsection
        <livewire:settings.icons.icons-table />
</x-admin-app>
