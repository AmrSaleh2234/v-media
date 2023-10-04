<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="support-request-view" ></x-breadcrumb>
    @endsection
    <livewire:attendance.support.support-view :id="$id" />
</x-admin-app>


