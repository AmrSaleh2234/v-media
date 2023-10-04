<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree"></x-breadcrumb>
    @endsection
    @livewire('roles.form', ['id' => $role_id ?? null])
</x-admin-app>
