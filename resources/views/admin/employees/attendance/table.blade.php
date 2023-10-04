<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="employees-attendance"></x-breadcrumb>
    @endsection
    <div class="section">
        {{ $dataTable->table() }}
    </div>
        @push('scripts')
            {{ $dataTable->scripts() }}
        @endpush
</x-admin-app>
