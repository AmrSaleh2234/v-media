
<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="categories-setting" ></x-breadcrumb>
    @endsection
    <livewire:settings.categories.categories-table />
</x-admin-app>
