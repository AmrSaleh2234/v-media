<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="job-grade" ></x-breadcrumb>
    @endsection
    <livewire:job-grade-form />
</x-admin-app>
