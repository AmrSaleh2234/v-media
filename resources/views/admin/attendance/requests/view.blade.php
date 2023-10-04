<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="employee-request-view" ></x-breadcrumb>
    @endsection
    <livewire:attendance.employee-requests.employee-requests-view :id="$id" />
</x-admin-app>


