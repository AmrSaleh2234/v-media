<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="users"></x-breadcrumb>
    @endsection
    <livewire:users.users-table />
</x-admin-app>
