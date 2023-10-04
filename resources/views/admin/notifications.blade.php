<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="notifications"></x-breadcrumb>
    @endsection
    <div class="section">
        <livewire:notification-table />
    </div>
</x-admin-app>
