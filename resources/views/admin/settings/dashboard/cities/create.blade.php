<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-city' : 'create-city'" ></x-breadcrumb>
    @endsection
    <livewire:settings.cities.cities-form :id="$id ?? null"/>
</x-admin-app>
