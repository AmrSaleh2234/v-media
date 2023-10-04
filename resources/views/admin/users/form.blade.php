<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($user_id) ? 'user-edit' : 'user-create'" ></x-breadcrumb>
    @endsection
    <livewire:users.users-form  :id="$user_id ?? null"  />
</x-admin-app>
