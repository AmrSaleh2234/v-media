<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="branches-setting" ></x-breadcrumb>
    @endsection
        <div class="section">
        <livewire:settings.branches />
        </div>
</x-admin-app>
