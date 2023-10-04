<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-service' : 'create-service'" ></x-breadcrumb>
    @endsection
        <livewire:settings.services.services-form :id="$id ?? null"/>
</x-admin-app>
