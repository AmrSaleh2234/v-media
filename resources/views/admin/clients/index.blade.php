<x-admin-app>
@section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="clients" ></x-breadcrumb>
    @endsection
    <div class="section">
        <livewire:client.client-table />
    </div>
</x-admin-app>


