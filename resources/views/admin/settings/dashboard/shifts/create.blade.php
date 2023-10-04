<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="settings-shift-create"></x-breadcrumb>
    @endsection
    @livewire('settings.shifts.index', ['shift_id' => $shift_id])
</x-admin-app>
