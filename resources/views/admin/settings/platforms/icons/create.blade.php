<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-icon' : 'create-icon'" ></x-breadcrumb>
    @endsection
    <livewire:settings.icons.icons-form :id="$id ?? null"/>
</x-admin-app>
