<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-project-type' : 'create-project-type'" ></x-breadcrumb>
    @endsection
        <livewire:settings.projects.project-type-modal :id="$id ?? null"/>
</x-admin-app>
