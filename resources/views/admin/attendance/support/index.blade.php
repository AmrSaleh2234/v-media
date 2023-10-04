<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="complaints-support" ></x-breadcrumb>
    @endsection
    <livewire:attendance.support.support-table />
</x-admin-app>


