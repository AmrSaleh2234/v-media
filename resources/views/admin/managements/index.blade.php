<x-admin-app>
    @if (!isset($branch_id) || $branch_id == null)
        @livewire('managements.tables.branches')
    @endif

    @if (isset($branch_id) && $branch_id != null)
        @livewire('managements.tables.managements', ['branch_id' => $branch_id])
    @endif
</x-admin-app>
