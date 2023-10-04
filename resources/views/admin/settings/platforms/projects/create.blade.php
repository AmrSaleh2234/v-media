<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-project' : 'create-project'" ></x-breadcrumb>
    @endsection
        <livewire:settings.projects.projects-form :id="$id ?? null"/>
</x-admin-app>
