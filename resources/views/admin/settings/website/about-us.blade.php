<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="about-us" ></x-breadcrumb>
    @endsection
    <livewire:settings.website.about-page />
</x-admin-app>
