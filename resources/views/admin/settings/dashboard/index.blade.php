<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="dashboard-setting"></x-breadcrumb>
    @endsection
    <div class="section">
        {{--        <h2>{{ __('names.dashboard-setting') }}</h2> --}}

        <button type="button" class="btn btn-primary w-100 arrow-btn collapsed my-2" data-bs-toggle="collapse"
                data-bs-target="#dashboard-setting" aria-expanded="true">
            {{ __('names.organization-chart-setting') }}
            <i class="bx bx-sm bx-chevron-left"></i>
        </button>

        <div class="collapse " id="dashboard-setting" style="">
            @if (havePermissionTo('dashboardSetting.branches'))
                <a href="{{ route('admin.settings.dashboard.branches') }}"
                   class="btn btn-primary light w-100 arrow-btn mb-2 ">{{ __('names.branches-setting') }}</a>
            @endif
            @if (havePermissionTo('dashboardSetting.branches.officialPaper'))
                <a href="{{ route('admin.settings.dashboard.official-papers') }}"
                   class="btn btn-primary light w-100 arrow-btn mb-2">{{ __('names.official-papers-setting') }}</a>
            @endif
            @if (havePermissionTo('dashboardSetting.shift.view'))
                <a href="{{ route('admin.settings.dashboard.shifts.index') }}"
                   class="btn btn-primary light w-100 arrow-btn mb-2">{{ __('names.attendance-setting') }}</a>
            @endif
            @if (havePermissionTo('dashboardSetting.universities.view'))
                <a href="{{ route('admin.settings.dashboard.universities.index') }}"
                   class="btn btn-primary light w-100 arrow-btn mb-2">{{ __('names.universities-setting') }}</a>
            @endif
            @if (havePermissionTo('dashboardSetting.cities.view'))
                <a href="{{ route('admin.settings.dashboard.cities.index') }}"
                   class="btn btn-primary light w-100 arrow-btn mb-2">{{ __('names.cities-setting') }}</a>
            @endif
        </div>
    </div>
</x-admin-app>
