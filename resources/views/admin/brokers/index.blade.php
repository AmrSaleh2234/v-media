<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="brokers" ></x-breadcrumb>
    @endsection
        <div class="section">
    <livewire:broker.broker-table />
        </div>
</x-admin-app>


