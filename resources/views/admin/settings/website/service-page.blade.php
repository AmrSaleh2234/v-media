<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="service-page"></x-breadcrumb>
    @endsection
    <livewire:settings.website.service-page />
</x-admin-app>
