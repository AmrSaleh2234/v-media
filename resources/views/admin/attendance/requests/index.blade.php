<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="employees-requests" ></x-breadcrumb>
    @endsection
    <livewire:attendance.employee-requests.employee-requests-table />
</x-admin-app>


