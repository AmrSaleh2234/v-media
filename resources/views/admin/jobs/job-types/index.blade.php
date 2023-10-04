<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="job-types" ></x-breadcrumb>
    @endsection
    <livewire:job-type.table />
</x-admin-app>


