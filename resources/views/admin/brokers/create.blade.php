<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-broker' : 'create-broker'" ></x-breadcrumb>
    @endsection
    <livewire:broker.broker-form :id="$id ?? null" />
</x-admin-app>
