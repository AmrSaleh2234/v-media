<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="clients-request-view"></x-breadcrumb>
    @endsection
    @livewire('client.request-view', ['requestId' => $requestId])
</x-admin-app>
