<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="clients-requests"></x-breadcrumb>
    @endsection
    <div class="section">
        <livewire:client.requests-table/>
    </div>
</x-admin-app>


