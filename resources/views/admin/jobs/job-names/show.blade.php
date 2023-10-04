<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="job-name"></x-breadcrumb>
    @endsection
    <livewire:job-name.show :jobTypeId="$id ?? null" />
</x-admin-app>
