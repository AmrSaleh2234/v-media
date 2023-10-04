<div class="main-sidebar">
    <div class="flex-shrink-0 p-3">

        <div class="logo-container">
            <x-logo></x-logo>
            <div>{{ __('names.employee-gate') }}</div>
        </div>

        <ul class="list-unstyled ps-0 ">
            <li class="mb-1">
                <button class="btn btn-toggle btn-icon align-items-center rounded px-1 fw-semibold py-2 collapsed"
                        data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                    <i class="bx bx-sm bx-chevron-left"></i>
                    <span class="btn-icon">
            <i class="bx bx-sm bx-doughnut-chart"></i>
            {{ __('names.organization-chart') }}
                        </span>
                </button>

                <div class="collapse " id="dashboard-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('admin.branches.index') }}" class="rounded">{{ __('الفروع') }}</a>
                        </li>
                        <li><a href="{{ route('admin.managements.index') }}"
                               class="rounded">{{ __('الادارة والاقسام') }}</a></li>
                        <li><a href="{{ route('admin.job_types.index') }}"
                               class="rounded">{{ __('التسلسل الوظيفى') }}</a></li>
                        <li><a href="{{ route('admin.employees.index') }}"
                               class="rounded">{{ __('بيانات الموظفين') }}</a></li>
                    </ul>
                </div>

            </li>
        </ul>

        <li><a href="{{ route('admin.clients.index') }}">{{ __('بيانات العملاء') }}</a></li>

        <li><a href="{{ route('admin.brokers.index') }}">{{ __('بيانات الوسطاء') }}</a></li>

        @foreach (Module::all() as $module)
            @if (Module::IsEnabled($module))
                @include(strtolower($module) . '::partial.sidemenu')
            @endif
        @endforeach


        {{--            <li>--}}
        {{--                <a href="#" class="structure-btn">--}}
        {{--                    {{ __('names.setting') }}--}}
        {{--                    <i class="icon-arrow-down one"></i>--}}
        {{--                </a>--}}
        {{--                <ul class="structure-show">--}}
        {{--                    <li><a href="{{ route('admin.currencies.index') }}">{{ __('Currencies') }}</a></li>--}}
        {{--                    <li><a href="{{ route('admin.countries.index') }}">{{ __('Countries') }}</a></li>--}}
        {{--                    <li><a href="{{ route('admin.cities.index') }}">{{ __('Cities') }}</a></li>--}}
        {{--                    <li><a href="{{ route('admin.grades.index') }}">{{ __('Grades') }}</a></li>--}}
        {{--                </ul>--}}
        {{--            </li>--}}
        </ul>
    </div>
</div>


