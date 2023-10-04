<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="official-paper"></x-breadcrumb>
    @endsection
    @livewire('settings.official-paper.table')
</x-admin-app>
