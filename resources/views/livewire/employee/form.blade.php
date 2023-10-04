<div class="container-fluid">
    @if ($step != 6)
        <div class="px-5 py-4">
            <div class="pages-navigator">
                <a href="{{ isset($employee) && $employee->id != null ? route('admin.custom.create', ['employee_id' => $employee->id, 'step' => 1]) : '#' }}"
                    class="nav-link {{ $step >= 1 ? 'active' : '' }}">
                    <div class="page-number">1</div>
                    <div class="page-name">{{ __('names.information') }} {{ __('names.personal') }}</div>
                </a>
                <a href="{{ isset($employee) && $employee->id != null ? route('admin.custom.create', ['employee_id' => $employee->id, 'step' => 2]) : '#' }}"
                    class="nav-link {{ $step >= 2 ? 'active' : '' }}">
                    <div class="page-number">2</div>
                    <div class="page-name"> {{ __('names.academic-info') }} </div>
                </a>
                <a href="{{ isset($employee) && $employee->id != null ? route('admin.custom.create', ['employee_id' => $employee->id, 'step' => 3]) : '#' }}"
                    class="nav-link {{ $step >= 3 ? 'active' : '' }}">
                    <div class="page-number">3</div>
                    <div class="page-name"> {{ __('names.employment-info') }} </div>
                </a>
                <a href="{{ isset($employee) && $employee->id != null ? route('admin.custom.create', ['employee_id' => $employee->id, 'step' => 4]) : '#' }}"
                    class="nav-link  {{ $step >= 4 ? 'active' : '' }}">
                    <div class="page-number">4</div>
                    <div class="page-name"> {{ __('names.employee-finances') }} </div>
                </a>
                <a href="{{ isset($employee) && $employee->id != null ? route('admin.custom.create', ['employee_id' => $employee->id, 'step' => 5]) : '#' }}"
                    class="nav-link {{ $step >= 5 ? 'active' : '' }}">
                    <div class="page-number">5</div>
                    <div class="page-name">{{ __('names.attendance') }}</div>
                </a>
                <a href="{{ isset($employee) && $employee->id != null ? route('admin.custom.create', ['employee_id' => $employee->id, 'step' => 6]) : '#' }}"
                    class="nav-link {{ $step >= 6 ? 'active' : '' }}">
                    <div class="page-number">6</div>
                    <div class="page-name">{{ __('names.save') }}</div>
                </a>
            </div>
        </div>
    @endif



    @if ($step == 1 || $employee == null)
        @livewire('employee.step-one', ['employee_id' => $employee?->id])
    @elseif($step == 2)
        @livewire('employee.step-two', ['employee_id' => $employee?->id])
    @elseif($step == 3)
        @livewire('employee.step-three', ['employee_id' => $employee?->id])
    @elseif($step == 4)
        @livewire('employee.step-four', ['employee_id' => $employee?->id])
    @elseif($step == 5)
        @livewire('employee.step-five', ['employee_id' => $employee?->id])
    @elseif($step == 6)
        @livewire('employee.step-six', ['employee_id' => $employee?->id])
    @endif

</div>
