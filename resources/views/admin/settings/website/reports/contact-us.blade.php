<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="contact-us-requests" ></x-breadcrumb>
    @endsection
    <livewire:settings.website.reports.contact-us-table />
</x-admin-app>
