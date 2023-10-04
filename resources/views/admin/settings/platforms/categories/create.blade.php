
<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-category' : 'create-category'" ></x-breadcrumb>
    @endsection
    <livewire:settings.categories.categories-form :id="$id ?? null"/>
</x-admin-app>
