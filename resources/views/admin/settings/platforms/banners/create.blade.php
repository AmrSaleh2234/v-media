<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-banner' : 'create-banner'" ></x-breadcrumb>
    @endsection
    <livewire:settings.banners.banners-form :id="$id ?? null"/>
</x-admin-app>
