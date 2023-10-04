<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="job-grades" ></x-breadcrumb>
    @endsection
        <livewire:job-grade.job-grade-table />
</x-admin-app>


