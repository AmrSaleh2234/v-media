<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="agreements" ></x-breadcrumb>
    @endsection
    <livewire:gada.agreements.agreements-table />
</x-admin-app>


