<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="settings-shift"></x-breadcrumb>
    @endsection
    @livewire('settings.shifts.table')
</x-admin-app>
