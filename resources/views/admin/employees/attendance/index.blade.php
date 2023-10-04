<x-admin-app>

    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="employees-attendance"></x-breadcrumb>
    @endsection
    <div class="section">
        <livewire:employee.attendance.table />
    </div>
</x-admin-app>
