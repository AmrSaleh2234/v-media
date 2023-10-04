<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="attendance-setting" ></x-breadcrumb>
    @endsection
        <div class="section">{{ __('names.website-setting') }}</div>
        <div class="section">{{ __('names.application-setting') }}</div>
</x-admin-app>
