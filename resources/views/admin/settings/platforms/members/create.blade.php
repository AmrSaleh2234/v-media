<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-member' : 'create-member'" ></x-breadcrumb>
    @endsection
    <livewire:settings.members.members-form :id="$id ?? null"/>
</x-admin-app>
