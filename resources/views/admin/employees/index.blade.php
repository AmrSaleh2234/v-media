<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="employees"></x-breadcrumb>
    @endsection

    @livewire('employee.table', ['branchId' => $branchId])
</x-admin-app>
