<div>
    <h3 class="d-print-none">
        {{ __('names.employees-attendance') }}
    </h3>
    <div class="row d-print-none">
        <div class="col-md-3 form-group mb-4">
            <x-input-label :value="__('names.from')" class="mb-2"></x-input-label>
            <input type="date" wire:model.lazy="fromDate" class="form-control" />
        </div>
        <div class="col-md-3 form-group mb-4">
            <x-input-label :value="__('names.to')" class="mb-2"></x-input-label>
            <input type="date" class="form-control" wire:model.lazy="toDate" />
        </div>

        <div class="col-md-6 float-left">
            <button class="btn btn-primary mx-2 light  d-inline-flex align-items-center mt-4" type="button"
                data-bs-toggle="collapse" data-bs-target="#filterWithBranch" aria-expanded="false"
                aria-controls="filter">
                <i class='bx bx-filter-alt bx-sm'></i>
                {{ __('names.filter') }}
            </button>
            <button class="btn btn-primary  d-inline-flex align-items-center mt-4" onclick="window.print()">
                {{ __('names.print') }}
            </button>
        </div>
    </div>
    <div wire:ignore.self class="row d-print-none  collapse" id="filterWithBranch">
        <div class="col-md-3 form-group mb-4">
            <x-input-label :value="__('names.branch')" class="mb-2"></x-input-label>
            <select class="form-select" wire:model.lazy="branchId">
                <option value="">
                    {{ __('message.select', ['Model' => __('names.branch')]) }}
                </option>
                @foreach ($branches as $key => $branch)
                    <option value="{{ $key }}">
                        {{ $branch }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 form-group mb-4">
            <x-input-label :value="__('names.management')" class="mb-2"></x-input-label>
            <select wire:model.lazy="managementId" class="form-select">
                <option value="">
                    {{ __('message.select', ['Model' => __('names.management')]) }}
                </option>
                @foreach ($managements as $key => $management)
                    <option value="{{ $key }}">
                        {{ $management }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 form-group mb-4">
            <x-input-label :value="__('names.department')" class="mb-2"></x-input-label>
            <select wire:model.lazy="departmentId" class="form-select">
                <option value="">
                    {{ __('message.select', ['Model' => __('names.department')]) }}
                </option>
                @foreach ($departments as $key => $department)
                    <option value="{{ $key }}">
                        {{ $department }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 form-group mb-4">
            <x-input-label :value="__('names.employee')" class="mb-2"></x-input-label>

            <select wire:model.lazy="employeeId" class="form-select">
                <option value="">
                    {{ __('message.select', ['Model' => __('names.employee')]) }}
                    @foreach ($emps as $emp)
                <option value="{{ $emp->id }}">
                    {{ $emp->first_name . ' ' . $emp->last_name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="table-container page mt-4 d-print-block">
        <div class="d-none d-print-block">
            <p style="text-align:center">
                <b>
                    {{ __('names.attendance-between-two-dates', ['date1' => $fromDate, 'date2' => $toDate]) }}
                </b>
                <br>
                <small>
                    <b>
                        {{ __('names.printed-in') }} {{ now()->timezone($timezone)->format('d-m-Y h:i A') }}
                    </b>
                </small>
            </p>
        </div>
        <table class="table table-bordered">
            <thead>
                <th>
                    {{ __('names.status') }}
                </th>
                <th>
                    {{ __('names.branch') }}
                </th>
                <th>
                    {{ __('names.management') }}
                </th>
                <th>
                    {{ __('names.department') }}
                </th>
                <th>
                    {{ __('names.employee') }}
                </th>
                <th>
                    {{ __('names.attend-in') }}
                </th>
                <th>
                    {{ __('names.attend-out') }}
                </th>
                <th>
                    {{ __('names.work-hours') }}
                </th>
                {{-- <th>
                {{ __('names.setting') }}
            </th> --}}
            </thead>
            <tbody>
                @forelse ($employeesGroups as $date => $employees_list)
                    <tr>


                        <th colspan="2" style="background-color: #F7F7F7">
                            ({{ count($employees_list) }})
                            عدد الموظفين

                        </th>
                        <th colspan="2" style="background-color: #F7F7F7">
                            ( {{ count($employees_list->where(fn($query) => count($query->attendances) >= 1)) }} ) عدد
                            الحضور
                        </th>
                        <th colspan="1" style="background-color: #F7F7F7">
                            ( {{ count($employees_list->where(fn($query) => count($query->attendances) == 0)) }} ) عدد
                            الغياب
                        </th>
                        <th colspan="3" style="background-color: #F7F7F7">
                            ليوم {{ $date }}
                        </th>
                    </tr>
                    @forelse ($employees_list as $employee)
                        <tr>
                            <td style="vertical-align: middle;">
                                @if (count($employee->attendances) >= 1)
                                    <img src="{{ asset('assets/images/confirmed.svg') }}" alt=""
                                        style="">
                                @elseif(count($employee->attendances) < 1 && !empty($employee->shift))
                                    <img src="{{ asset('assets/images/cancel.svg') }}" alt="" style="">
                                @elseif(count($employee->attendances) < 1 && empty($employee->shift))
                                    {{-- <img src="{{ asset('assets/images/completed.svg') }}" alt=""
                                        style=""> --}}
                                    <img src="{{ asset('assets/images/cancel.svg') }}" alt="" style="">
                                @else
                                    <img src="{{ asset('assets/images/normal.svg') }}" alt="" style="">
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                @if ($employee?->workAt?->workable_type == 'branches')
                                    {{ $employee?->workAt?->workable?->name }}
                                @elseif ($employee?->workAt?->workable_type == 'managements')
                                    {{ $employee?->workAt?->workable?->branch?->name }}
                                @else
                                    {{ $employee?->workAt?->workable?->management?->branch?->name }}
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                @if ($employee?->workAt?->workable_type == 'branches')
                                    -
                                @elseif ($employee?->workAt?->workable_type == 'managements')
                                    {{ $employee?->workAt?->workable?->name }}
                                @else
                                    {{ $employee?->workAt?->workable?->management?->name }}
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                @if ($employee?->workAt?->workable_type == 'branches')
                                    -
                                @elseif ($employee?->workAt?->workable_type == 'managements')
                                    -
                                @else
                                    {{ $employee?->workAt?->workable->name }}
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                {{ $employee?->first_name . ' ' . $employee?->last_name }}
                            </td>

                            <td>
                                <table>
                                    @forelse ($employee->attendances as  $attendance)
                                        <tr>
                                            <td style="text-align:center ; vertical-align: middle;">
                                                {{--                                            {{ \Carbon\Carbon::parse($employee->attendance?->created_at)->timezone($timezone)->format('d/m/Y') }} --}}
                                                {{ \Carbon\Carbon::parse($employee->attendance?->check_in)->timezone($timezone)->format('h:i A') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td style="text-align: center ; vertical-align: middle;">
                                                -
                                            </td>
                                        </tr>
                                    @endforelse

                                </table>
                            </td>

                            <td>
                                <table>
                                    @forelse ($employee->attendances as $attendance)
                                        @if ($attendance?->check_out != null)
                                            <tr>
                                                <td style="text-align:center ; vertical-align: middle;">
                                                    {{--                                                {{ \Carbon\Carbon::parse($attendance?->created_at)->timezone($timezone)->format('d/m/Y') }} --}}
                                                    {{ \Carbon\Carbon::parse($attendance?->check_out)->timezone($timezone)->format('h:i A') }}
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td style="text-align: center ; vertical-align: middle;">
                                                    -
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        -
                                    @endforelse
                                </table>
                            </td>

                            <td>
                                <table>
                                    @php $hour = 0 ; @endphp
                                    @forelse ($employee->attendances as $attendance)
                                        @if ($attendance?->check_out != null)
                                            <tr>
                                                <td style="text-align:center ; vertical-align: middle;">
                                                    {{ $i = round(abs((strtotime($attendance?->check_out) - strtotime($attendance->check_in)) / 3600), 2) }}
                                                    س
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        -
                                    @endforelse
                                    {{-- @if ($hour)
                                        <tr>
                                            <td>
                                                <hr>
                                                {{ round($hour, 2) }}
                                                س
                                            </td>
                                        </tr>
                                    @else
                                        -
                                    @endif --}}
                                </table>

                            </td>
                            {{-- <td>
                            <button class="btn btn-sm btn-danger" wire:click="delete('{{ $attendance->id }}')">
                                <i class="bx bx-trash bx-sm"></i>
                            </button>
                        </td> --}}
                        </tr>

                    @empty
                        <tr>
                            <td colspan="9">
                                <p class="text-danger">
                                    {{ __('message.not-found', ['Model' => __('names.attendances')]) }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                @empty
                    <tr>
                        <td colspan="9">
                            <p class="text-danger">
                                {{ __('message.not-found', ['Model' => __('names.attendances')]) }}
                            </p>
                        </td>
                    </tr>

                @endforelse


            </tbody>
        </table>
    </div>

</div>
