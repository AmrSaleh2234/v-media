<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-client' : 'create-client'" ></x-breadcrumb>
    @endsection
    <livewire:client.client-form :id="$id ?? null" />
</x-admin-app>
