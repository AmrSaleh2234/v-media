<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="job-names" ></x-breadcrumb>
    @endsection
    <livewire:job-name.table />
</x-admin-app>


