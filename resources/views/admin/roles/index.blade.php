<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="roles"></x-breadcrumb>
    @endsection
    <livewire:roles.table />
</x-admin-app>
