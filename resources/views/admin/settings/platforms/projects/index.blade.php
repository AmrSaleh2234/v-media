<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="projects-setting" ></x-breadcrumb>
    @endsection
        <livewire:settings.projects.projects-table />
</x-admin-app>
