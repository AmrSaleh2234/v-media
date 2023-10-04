<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="project-types" ></x-breadcrumb>
    @endsection
        <livewire:settings.projects.project-type-table />
</x-admin-app>
