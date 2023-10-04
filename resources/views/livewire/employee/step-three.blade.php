<div>
    <form wire:submit.prevent="save">
        @csrf
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>
                    {{ __('names.contract-information') }}
                </h4>
            </div>
            <div class="col-md-4 form-group mb-4 @error('employmentData.job_type_id') is-invalid @enderror">
                <x-input-label :value="__('names.job-type')"></x-input-label>
                <select class="form-select form-control" wire:model.lazy="employmentData.job_type_id">
                    <option>
                        {{ __('names.select') }} {{ __('names.job-types') }}
                    </option>
                    @foreach ($jobTypes as $key => $jobType)
                        <option value="{{ $key }}">
                            {{ $jobType }}
                        </option>
                    @endforeach
                </select>
                @error('employmentData.job_type_id')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-8"></div>
            <div class="col-md-4 form-group mb-4 @error('employmentData.job_name_id') is-invalid @enderror">
                <x-input-label :value="__('names.job-name')"></x-input-label>
                <select class="form-select form-control" wire:model.lazy="employmentData.job_name_id">
                    <option>
                        {{ __('names.select') }} {{ __('names.job-names') }}
                    </option>
                    @foreach ($jobNames as $key => $jobName)
                        <option value="{{ $key }}">
                            {{ $jobName }}
                        </option>
                    @endforeach
                </select>
                @error('employmentData.job_name_id')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-4 form-group mb-4 @error('employmentData.job_grade_id') is-invalid @enderror">
                <x-input-label :value="__('names.job-grade')"></x-input-label>
                <select class="form-select form-control" wire:model.lazy="employmentData.job_grade_id">
                    <option>
                        {{ __('names.select') }} {{ __('names.job-grades') }}
                    </option>
                    @foreach ($jobGrades as $key => $jobGrade)
                        <option value="{{ $key }}">
                            {{ $jobGrade }}
                        </option>
                    @endforeach
                </select>
                @error('employmentData.job_grade_id')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4 form-group mb-4 @error('branch_id') is-invalid @enderror">
                <x-input-label :value="__('names.branch')"></x-input-label>
                <select class="form-select form-control" wire:model.lazy="branch_id">
                    <option>
                        {{ __('names.select') }} {{ __('names.branches') }}
                    </option>
                    @foreach ($branches as $key => $branch)
                        <option value="{{ $key }}">
                            {{ $branch }}
                        </option>
                    @endforeach
                </select>
                @error('branch_id')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-4 form-group mb-4 @error('management_id') is-invalid @enderror">
                <x-input-label :value="__('names.management')"></x-input-label>
                <select class="form-select form-control" wire:model.lazy="management_id">
                    <option>
                        {{ __('names.select') }} {{ __('names.managements') }}
                    </option>
                    @foreach ($managments as $key => $management)
                        <option value="{{ $key }}">
                            {{ $management }}
                        </option>
                    @endforeach
                </select>
                @error('management_id')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-4 form-group mb-4 @error('department_id') is-invalid @enderror">
                <x-input-label :value="__('names.department')"></x-input-label>
                <select class="form-select form-control" wire:model.lazy="department_id">
                    <option>
                        {{ __('names.select') }} {{ __('names.departments') }}
                    </option>
                    @foreach ($departments as $key => $department)
                        <option value="{{ $key }}">
                            {{ $department }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-4 form-gorup mb-4 @error('contract.start_date') is-invalid @enderror">
                <x-input-label :value="__('names.start-date')"></x-input-label>
                <input type="date" wire:model.lazy="contract.start_date" class="form-control" />
                @error('contract.start_date')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-4 form-gorup mb-4 @error('contract.end_date') is-invalid @enderror">
                <x-input-label :value="__('names.end-date')"></x-input-label>
                <input type="date" wire:model.lazy="contract.end_date" class="form-control" />
                @error('contract.end_date')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4 form-gorup mb-4 @error('contract.join_date') is-invalid @enderror">
                <x-input-label :value="__('names.join-date')"></x-input-label>
                <input type="date" wire:model.lazy="contract.join_date" class="form-control" />
                @error('contract.join_date')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-4 form-gorup mb-4 @error('contract.test_end_date') is-invalid @enderror">
                <x-input-label :value="__('names.end-test-date')"></x-input-label>
                <input type="date" wire:model.lazy="contract.test_end_date" class="form-control" />
                @error('contract.test_end_date')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4 form-gorup mb-4 @error('employeeFinance.currency_id') is-invalid @enderror">
                <x-input-label :value="__('names.currency')"></x-input-label>
                <select class="form-select form-control" wire:model.lazy="employeeFinance.currency_id">
                    <option>
                        {{ __('names.select') }} {{ __('names.currencies') }}
                    </option>
                    @foreach ($currencies as $key => $currency)
                        <option value="{{ $key }}">
                            {{ $currency }}
                        </option>
                    @endforeach
                </select>
                @error('employeeFinance.currency_id')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-4 form-gorup mb-4 @error('employeeFinance.salary_circle') is-invalid @enderror">
                <x-input-label :value="__('names.salary-cycle')"></x-input-label>
                <select class="form-select form-control" wire:model.lazy="employeeFinance.salary_circle">
                    <option>
                        {{ __('names.select') }} {{ __('names.salary-cycle') }}
                    </option>
                    @foreach ($salaryCycles as $key => $cycle)
                        <option value="{{ $key }}">
                            {{ $cycle }}
                        </option>
                    @endforeach
                </select>
                @error('employeeFinance.salary_circle')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('admin.custom.create', ['employee_id' => $employee_id, 'step' => 2]) }}"
                            class="btn btn-outline-{{ $color }} w-100">
                            {{ __('names.prev') }}
                        </a>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-{{ $color }} w-100">

                            {{ __('names.next') }}

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
