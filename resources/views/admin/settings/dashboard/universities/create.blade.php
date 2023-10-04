<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-university' : 'create-university'" ></x-breadcrumb>
    @endsection
    <livewire:settings.universities.universities-form :id="$id ?? null"/>
</x-admin-app>
