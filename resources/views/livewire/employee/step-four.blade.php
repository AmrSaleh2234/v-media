<div>
    <form action="#" wire:submit.prevent="save">
        @csrf
        <div class="row mt-4">
            <div class="col-12">
                <h4>
                    {{ __('names.information') }} {{ __('names.finance') }}
                </h4>
            </div>
            <div class="col-md-3 form-group mb-4 @error('finance.salary') is-invalid @enderror">
                <x-input-label :value="__('names.salary')"></x-input-label>
                <input type="number" step=".001" wire:model.lazy="finance.salary" class="form-control" />
                @error('finance.salary')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-3 form-group mb-4 @error('finance.work_days_in_week') is-invalid @enderror">
                <x-input-label :value="__('names.work-days-in-month')"></x-input-label>
                <input type="number" step=".001" wire:model.lazy="finance.work_days_in_week" class="form-control" />
                @error('finance.work_days_in_week')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-3 form-group mb-4 @error('finance.work_hours') is-invalid @enderror">
                <x-input-label :value="__('names.work-hours-in-day')"></x-input-label>
                <input type="number" step=".001" wire:model.lazy="finance.work_hours" class="form-control" />
                @error('finance.work_hours')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-3  d-none form-group  mb-4 @error('finance.hour_type') is-invalid  @enderror">
                <input type="radio" name="hour_type" checked value="1" wire:model.lazy="finance.hour_type" />
                <label class="mb-3 mr-2"> {{ __('names.day') }} </label>
                <br />
                <input type="radio" value="2" wire:model.lazy="finance.hour_type" name="hour_type" />
                <label class="mr-2"> {{ __('names.week') }} </label>

            </div>


            <div class="col-md-3 form-group mb-4 @error('finance.allowances') is-invalid @enderror">
                <x-input-label :value="__('names.allowances')"></x-input-label>
                <input type="number" step=".001" wire:model.lazy="finance.allowances" class="form-control" />
                @error('finance.allowances')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>


            <div class="col-md-3 form-group mb-4 @error('finance.car_allownce') is-invalid @enderror">
                <x-input-label :value="__('names.car-allowance')"></x-input-label>
                <input type="number" step=".001" wire:model.lazy="finance.car_allownce" class="form-control" />
                @error('finance.car_allownce')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="col-md-3 d-none form-group mb-4 @error('finance.minute_value') is-invalid @enderror">
                <x-input-label :value="__('names.minute_value')"></x-input-label>
                <input type="number" step=".001" wire:model.lazy="finance.minute_value" class="form-control" />
                @error('finance.minute_value')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>


            <div class="col-md-3 form-group mb-4 @error('finance.total') is-invalid @enderror">
                <x-input-label :value="__('names.total')"></x-input-label>
                <input type="number" disabled readonly step=".001" wire:model.lazy="finance.total"
                    class="form-control" />
                @error('finance.total')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="col-md-3 form-group mb-4 @error('finance.hourly_value') is-invalid @enderror">
                <x-input-label :value="__('names.hour-value')"></x-input-label>
                <input type="number" disabled readonly step=".001" wire:model.lazy="finance.hourly_value"
                    class="form-control" />
                @error('finance.hourly_value')
                    <span class="d-block text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="col-md-12 mb-4">
                <section class="section">
                    <div class="row">
                        <div class="col-md-10">
                            {{ __('names.employees-dues') }}
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addDues">
                                <i class="bx bxs-plus"></i>
                                {{ __('names.add') }}
                            </button>
                        </div>
                        <div class="col-md-12 mt-2 mb-2">
                            @include('admin.employees._shared.emp_dues')
                        </div>
                    </div>

                </section>
            </div>


            <div class="col-md-12">
                <section class="section">
                    <div class="row">
                        <div class="col-md-10">
                            {{ __('names.employee-vacations') }}
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addVacation">
                                <i class="bx bxs-plus"></i>
                                {{ __('names.add') }}
                            </button>
                        </div>

                        <div class="col-md-12 mt-2 mb-2">
                            @include('admin.employees._shared.emp_vacation')
                        </div>
                    </div>

                </section>
            </div>
            <div class="col-8 mt-4"></div>
            <div class="col-4 mt-4">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('admin.custom.create', ['employee_id' => $employee_id, 'step' => 3]) }}"
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


    <div wire:ignore.self class="modal fade" id="addDues" tabindex="-1" aria-labelledby="addaddDuesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addaddDuesLabel">
                        {{ __('names.add-Due') }}
                    </h1>

                </div>
                <form action="#" wire:submit.prevent="addDues" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="airplan">
                                <input type="checkbox" wire:model.lazy="dues.airplane" id="ch_91"
                                    name="airline" />
                                <h6 style="display:inline-block">
                                    {{ __('names.airplane') }}
                                </h6>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" wire:model.lazy="dues.airplane.airplane-home"
                                            id="ch_9" name="airline_first" />
                                        <label for="ch_9"> {{ __('names.airplane-home') }}</label>
                                        <br />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" id="ch_10"
                                            wire:model.lazy="dues.airplane.airplane-away" />
                                        <label for="ch_10"> {{ __('names.airplane-away') }} </label>
                                    </div>
                                    <div class="col-md-4">

                                        <input type="number" class="form-control"
                                            wire:model.lazy="dues.airplane.duration" step="00.1"
                                            placeholder="{{ __('names.duration') }}" />
                                    </div>
                                    <div class="col-md-4">

                                        <input type="number" class="form-control"
                                            wire:model.lazy="dues.airplane.amount" step="00.1"
                                            placeholder="{{ __('names.amount') }}" />
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="transfer_sponsership">
                                <input type="checkbox" wire:model.lazy="dues.transfer-sponsership" id="ch_91" />
                                <h6 style="display:inline-block">{{ __('names.transfer-sponsership') }}</h6>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" wire:model.lazy="dues.transfer-sponsership.final-out"
                                            id="ch_9" />
                                        <label for="ch_9">
                                            {{ __('names.final-out') }}
                                        </label>
                                        <br />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" id="ch_10"
                                            wire:model.lazy="dues.transfer-sponsership.register-only" />
                                        <label for="ch_10"> {{ __('names.register-only') }} </label>
                                    </div>
                                    <div class="col-md-4">

                                        <input type="number" class="form-control"
                                            wire:model.lazy="dues.transfer-sponsership.duration" step="00.1"
                                            placeholder="{{ __('names.duration') }}" />
                                    </div>

                                </div>
                            </div>
                            <hr />

                            <div class="medical_insurance">
                                <input type="checkbox" wire:model.lazy="dues.medical-insurance" id="ch_91" />
                                <h6 style="display:inline-block">{{ __('names.medical-insurance') }}</h6>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" wire:model.lazy="dues.medical-insurance.personal"
                                            id="ch_9" />
                                        <label for="ch_9">
                                            {{ __('names.personal') }}
                                        </label>
                                        <br />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" id="ch_10"
                                            wire:model.lazy="dues.medical-insurance.family" />
                                        <label for="ch_10"> {{ __('names.family') }} </label>
                                    </div>
                                    <div class="col-md-4">

                                        <input type="number" class="form-control"
                                            wire:model.lazy="dues.medical-insurance.max-limit" step="00.1"
                                            placeholder="{{ __('names.max-limit') }}" />
                                    </div>

                                </div>
                            </div>


                            <hr />

                            <div class="social_insurance">
                                <input type="checkbox" wire:model.lazy="dues.social-insurance" id="ch_91" />
                                <h6 style="display:inline-block">{{ __('names.social-insurance') }}</h6>
                                <div class="row">
                                    <div class="col-md-4">

                                        <input type="number" class="form-control"
                                            wire:model.lazy="dues.social-insurance.max-limit" step="00.1"
                                            placeholder="{{ __('names.max-limit') }}" />
                                    </div>

                                </div>
                            </div>


                            <hr />

                            <div class="car">
                                <input type="checkbox" wire:model.lazy="dues.car.active" id="ch_91" />
                                <h6 style="display:inline-block">{{ __('names.car') }}</h6>

                            </div>

                            <hr />

                            <div class="telecome">
                                <input type="checkbox" wire:model.lazy="dues.telecome.active" id="ch_91" />
                                <h6 style="display:inline-block">{{ __('names.telecome') }}</h6>

                            </div>

                        </div>
                    </div>
                    <div wire:loading wire:target="addDues">
                        <div class="loader-cotnainer">
                            <div class="loader"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary light" data-bs-dismiss="modal">
                            {{ __('names.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('names.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="addVacation" tabindex="-1" aria-labelledby="addaddDuesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addaddDuesLabel">
                        {{ __('names.add-vacation') }}
                    </h1>

                </div>
                <form action="#" wire:submit.prevent="addVacation" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="text-danger">
                                                {{ $error }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-6 mb-2 form-group @error('vacation.name') is-invalid @enderror">
                                    <x-input-label :value="__('names.vacation-name')"></x-input-label>
                                    <input type="text" wire:model.lazy="vacation.name" class="form-control" />
                                    @error('vacation.name')
                                        <span class="text-danger d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2 form-group @error('vacation.type') is-invalid @enderror">
                                    <x-input-label :value="__('names.vacation-type')"></x-input-label>
                                    <select class="form-control" wire:model.lazy="vacation.type">
                                        <option value="{{ __('names.sick') }}"> {{ __('names.sick') }} </option>
                                        <option value="{{ __('names.work') }}">{{ __('names.work') }}</option>
                                        <option value="{{ __('names.entertainment') }}">
                                            {{ __('names.entertainment') }}</option>
                                    </select>
                                    @error('vacation.type')
                                        <span class="text-danger d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div
                                    class="col-md-6 mb-2 form-group @error('vacation.date_of_hiring') is-invalid @enderror">
                                    <x-input-label :value="__('names.hire-date')"></x-input-label>
                                    <input type="date" wire:model.lazy="vacation.date_of_hiring"
                                        class="form-control" />
                                    @error('vacation.date_of_hiring')
                                        <span class="text-danger d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div
                                    class="col-md-6 mb-2 form-group @error('vacation.due_date') is-invalid @enderror">
                                    <x-input-label :value="__('names.due-date')"></x-input-label>
                                    <input type="date" wire:model.lazy="vacation.due_date" class="form-control" />
                                    @error('vacation.due_date')
                                        <span class="text-danger d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-2 mb-2">
                                    <h6>
                                        {{ __('names.vacation-mechanism') }}
                                    </h6>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="radio" name="mech" class="form-check" value="2"
                                                wire:model.lazy="vacation.mechanism_before_duration" />
                                            {{ __('names.two-days') }}
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="mech" class="form-check" value="1"
                                                wire:model.lazy="vacation.mechanism_before_duration" />
                                            {{ __('names.one-day') }}
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="mech" class="form-check" value="1.5"
                                                wire:model.lazy="vacation.mechanism_before_duration" />
                                            {{ __('names.one-day-and-half') }}
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="mech" class="form-check" value="0"
                                                wire:model.lazy="vacation.mechanism_before_duration" />
                                            {{ __('names.from-credit') }}
                                        </div>
                                    </div>
                                </div>


                                <div
                                    class="col-md-6 mb-2 form-group @error('vacation.vacation_credit') is-invalid @enderror">
                                    <x-input-label :value="__('names.vacation-credit')"></x-input-label>
                                    <input type="text" wire:model.lazy="vacation.vacation_credit"
                                        class="form-control" />
                                    @error('vacation.vacation_credit')
                                        <span class="text-danger d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div
                                    class="col-md-6 mb-2 form-group @error('vacation.work_duration') is-invalid @enderror">
                                    <x-input-label :value="__('names.vacation-duration')"></x-input-label>
                                    <input type="text" wire:model.lazy="vacation.work_duration"
                                        class="form-control" />
                                    @error('vacation.work_duration')
                                        <span class="text-danger d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-md-12 mt-2 mb-2">
                                    <h6>
                                        {{ __('names.vacation-deduction') }}
                                    </h6>
                                </div>

                                <div
                                    class="col-md-6 mb-2 form-group @error('vacation.vacation_deduction') is-invalid @enderror">
                                    <x-input-label :value="__('names.with-permission')"></x-input-label>
                                    <input type="text" wire:model.lazy="vacation.vacation_deduction"
                                        class="form-control" />
                                    @error('vacation.vacation_deduction')
                                        <span class="text-danger d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>


                                <div
                                    class="col-md-6 mb-2 form-group @error('vacation.without_warning') is-invalid @enderror">
                                    <x-input-label :value="__('names.without-permission')"></x-input-label>
                                    <input type="text" wire:model.lazy="vacation.without_warning"
                                        class="form-control" />
                                    @error('vacation.without_warning')
                                        <span class="text-danger d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div wire:loading wire:target="addVacation">
                        <div class="loader-cotnainer">
                            <div class="loader"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary light" data-bs-dismiss="modal">
                            {{ __('names.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('names.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
