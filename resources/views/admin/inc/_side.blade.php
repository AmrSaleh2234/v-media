<div class="main-sidebar d-print-none">
    <div class="flex-shrink-0 p-3" style="width: 100%">
        <div class="logo-container">
            <x-logo></x-logo>
            <div>{{ __('names.employee-gate') }}</div>
        </div>
        <ul class="list-unstyled ps-0">

            @if (havePermissionTo('roles.view') || havePermissionTo('roles.create'))

                <li class="mb-1">
                    <button class="btn btn-toggle btn-icon rounded collapsed px-1 fw-semibold py-2"
                        data-bs-toggle="collapse" data-bs-target="#roles-collapse" aria-expanded="false">
                        <i class="bx bx-sm bx-chevron-left"></i>
                        <span class="btn-icon">
                            <i class="bx bx-sm bx-shield-plus"></i>
                            {{ __('names.roles-and-users') }}
                        </span>
                    </button>
                    <div class="collapse" id="roles-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            @if (havePermissionTo('roles.view'))
                                <li><a href="{{ route('admin.roles.index') }}"
                                        class="rounded">{{ __('names.roles') }}</a>
                                </li>
                            @endif
                            @if (havePermissionTo('users.view'))
                                <li><a href="{{ route('admin.users.index') }}"
                                        class="rounded">{{ __('names.users') }}</a></li>
                            @endif

                        </ul>
                    </div>
                </li>
            @endif


            @if (havePermissionTo('branches.view') || havePermissionTo('managements.view') || havePermissionTo('employees.view'))
                <li class="mb-1">
                    <button class="btn btn-toggle btn-icon rounded collapsed px-1 fw-semibold py-2"
                        data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                        <i class="bx bx-sm bx-chevron-left"></i>
                        <span class="btn-icon">
                            <i class="bx bx-sm bx-doughnut-chart"></i>
                            {{ __('names.organization-chart') }}
                        </span>
                    </button>
                    <div class="collapse" id="home-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            @if (havePermissionTo('branches.view'))
                                <li><a href="{{ route('admin.branches.index') }}"
                                        class="rounded">{{ __('الفروع') }}</a>
                                </li>
                            @endif
                            @if (havePermissionTo('managements.view'))
                                <li><a href="{{ route('admin.managements.index') }}"
                                        class="rounded">{{ __('الادارة والاقسام') }}</a></li>
                            @endif
                            @if (havePermissionTo('jobTypes.view'))
                                <li><a href="{{ route('admin.job_types.index') }}"
                                        class="rounded">{{ __('التسلسل الوظيفى') }}</a></li>
                            @endif
                            @if (havePermissionTo('employees.view'))
                                <li><a href="{{ route('admin.employees.index') }}" class="rounded">
                                        {{ __('بيانات الموظفين') }}
                                    </a></li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif


            @if (havePermissionTo('clients.view') || havePermissionTo('brokers.view') || havePermissionTo('clientRequests.view'))
                <li class="mb-1">
                    <button class="btn btn-toggle btn-icon rounded collapsed px-1 fw-semibold py-2"
                        data-bs-toggle="collapse" data-bs-target="#client-collapse" aria-expanded="false">
                        <i class="bx bx-sm bx-chevron-left"></i>
                        <span class="btn-icon">
                            <i class="bx bx-sm bx-group"></i>
                            {{ __('names.clients') }}
                        </span>
                    </button>
                    <div class="collapse" id="client-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            @if (havePermissionTo('clients.view'))
                                <li><a href="{{ route('admin.clients.index') }}"
                                        class="rounded">{{ __('names.clients-data') }}</a>
                                </li>
                            @endif
                            @if (havePermissionTo('brokers.view'))
                                <li>
                                    <a href="{{ route('admin.brokers.index') }}"
                                        class="rounded">{{ __('names.brokers-data') }}
                                    </a>
                                </li>
                            @endif
                            @if (havePermissionTo('clientRequests.view'))
                                <li>
                                    <a href="{{ route('admin.clients.requests') }}"
                                        class="rounded">{{ __('names.clients-requests') }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (havePermissionTo('gada.agreements.view') ||
                    havePermissionTo('gada.agreements.view') ||
                    havePermissionTo('gada.agreements.view'))
                <li class="mb-1">
                    <button class="btn btn-toggle btn-icon rounded collapsed px-1 fw-semibold py-2"
                        data-bs-toggle="collapse" data-bs-target="#gada-collapse" aria-expanded="false">
                        <i class="bx bx-sm bx-chevron-left"></i>
                        <span class="btn-icon">
                            <i class="bx bx-sm bx-door-open"></i>
                            {{ __('names.gada-gate') }}
                        </span>
                    </button>
                    <div class="collapse" id="gada-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            @if (havePermissionTo('gada.agreements.view'))
                                <li><a href="{{ route('admin.gada.agreements.index') }}"
                                        class="rounded">{{ __('names.agreements') }}</a>
                                </li>
                            @endif
                            {{--                            @if (havePermissionTo('gada.agreements.view')) --}}
                            {{--                                <li> --}}
                            {{--                                    <a href="{{ route('admin.gada.agreements.index') }}" --}}
                            {{--                                       class="rounded">{{ __('names.requests') }} --}}
                            {{--                                    </a> --}}
                            {{--                                </li> --}}
                            {{--                            @endif --}}
                            {{--                            @if (havePermissionTo('gada.agreements.view')) --}}
                            {{--                                <li> --}}
                            {{--                                    <a href="{{ route('admin.gada.agreements.index') }}" --}}
                            {{--                                       class="rounded">{{ __('names.agreements') }} --}}
                            {{--                                    </a> --}}
                            {{--                                </li> --}}
                            {{--                            @endif --}}
                        </ul>
                    </div>
                </li>
            @endif

            @foreach (Module::all() as $module)
                @if (Module::IsEnabled($module))
                    @include(strtolower($module) . '::partial.sidemenu')
                @endif
            @endforeach

            {{-- --}}
            @if (havePermissionTo('attendance.view') ||
                    havePermissionTo('attendance.requests.view') ||
                    havePermissionTo('attendance.support.view'))
                <li class="mb-1">
                    <button class="btn btn-toggle btn-icon rounded collapsed px-1 fw-semibold py-2"
                        data-bs-toggle="collapse" data-bs-target="#attend-requests-collapse" aria-expanded="false">
                        <i class="bx bx-sm bx-chevron-left"></i>
                        <span class="btn-icon">
                            <i class='bx bx-briefcase-alt bx-sm'></i>
                            {{ __('names.request-and-attendances') }}
                        </span>
                    </button>
                    <div class="collapse" id="attend-requests-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            @if (havePermissionTo('attendance.view'))
                                <li><a href="{{ route('admin.employee.attendances') }}"
                                        class="rounded">{{ __('names.employees-attendance') }}</a>
                                </li>
                            @endif
                            @if (havePermissionTo('attendance.requests.view'))
                                <li><a href="{{ route('admin.attendance.requests.index') }}"
                                        class="rounded">{{ __('names.employees-requests') }}</a></li>
                            @endif
                            @if (havePermissionTo('attendance.support.view'))
                                <li><a href="{{ route('admin.attendance.support.index') }}"
                                        class="rounded">{{ __('names.complaints-support') }}</a></li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (havePermissionTo('dashboardSetting.view') || havePermissionTo('platforms.view'))
                <li class="mb-1">
                    <button class="btn btn-toggle btn-icon rounded collapsed px-1 fw-semibold py-2"
                        data-bs-toggle="collapse" data-bs-target="#setting-collapse" aria-expanded="false">
                        <i class="bx bx-sm bx-chevron-left"></i>
                        <span class="btn-icon">
                            <i class="bx bx-sm bx-doughnut-chart"></i>
                            {{ __('names.setting') }}
                        </span>
                    </button>
                    <div class="collapse" id="setting-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

                            @if (havePermissionTo('dashboardSetting.view'))
                                <li><a href="{{ route('admin.settings.dashboard') }}"
                                        class="rounded">{{ __('names.dashboard-setting') }}</a>
                                </li>
                            @endif

                            @if (havePermissionTo('platforms.view'))
                                <li>
                                    <a href="{{ route('admin.settings.platforms') }}"
                                        class="rounded">{{ __('names.platforms-setting') }}
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </li>
            @endif


        </ul>
    </div>
</div>
