<x-admin-app>

    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" :current="isset($id) ? 'edit-employee' : 'create-employee'"></x-breadcrumb>
    @endsection
    @livewire('employee.form', ['employee_id' => $employee_id, 'step' => $step])
</x-admin-app>
