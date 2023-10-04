<div>
    <form action="#" wire:submit.prevent.save="save">
        @csrf
        <div class="row mt-4">
            <div class="col-md-12 mb-2">
                <h4>
                    {{ __('names.attendance') }}
                </h4>
            </div>

            <div class="col-md-4 form-group mb-2">
                <x-input-label :value="__('names.branch') . ' ' . __('names.main')"></x-input-label>
                <select class="form-select" wire:model.lazy="employeeBranchId" disabled readonly>
                    <option>
                        {{ __('names.select') }}
                    </option>
                    @foreach ($mainBranches as $key => $branch)
                        <option value="{{ $key }}">
                            {{ $branch }}
                        </option>
                    @endforeach
                </select>

                <br />
                <x-input-label :value="__('names.shifts')"></x-input-label>

                <div class="d-block">
                    <div class="form-check form-switch">
                        <input wire:model.lazy="ableToChange" class="form-check-input" type="checkbox" role="switch"
                            id="flexSwitchCheckChecked" checked="">
                        <label class="form-check-label" for="flexSwitchCheckChecked">
                            {{ __('names.change-shift-for-employee') }}
                        </label>
                    </div>
                    <select class="form-select  d-inline" wire:model.lazy="shift_id"
                        {{ $ableToChange ? '' : 'disabled' }}>
                        <option>
                            {{ __('names.select') }}
                        </option>
                        @foreach ($shifts as $key => $shift)
                            <option value="{{ $key }}">
                                {{ $shift }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4"></div>

            <div class="col-md-4 mb-2">

            </div>

            <div class="col-md-2"></div>
            <div class="col-md-8 mb-2 mt-3">
                <section class="section">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h5>
                                {{ __('names.login') }}
                            </h5>
                        </div>

                        <div class="col-md-4">
                            <x-input-label :value="__('names.role')"></x-input-label>
                            <select required class="form-control form-select" wire:model.lazy="auth.role_id">
                                <option value="">
                                    {{ __('names.select', ['model' => __('names.role')]) }}
                                </option>
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $key }}">
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <x-input-label :value="__('names.username')"></x-input-label>
                            <input required type="text" autocomplete="off" class="form-control"
                                wire:model.lazy="auth.username" />
                        </div>

                        <div class="col-md-4">
                            <x-input-label :value="__('names.password')"></x-input-label>
                            <i class="bx bx-sm bx-low-vision" style="float:left" wire:click="changeTextType"></i>
                            <input required type="{{ $inputType }}" autocomplete="off" class="form-control"
                                wire:model.lazy="auth.password" />
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-2"></div>

            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('admin.custom.create', ['employee_id' => $employee_id, 'step' => 4]) }}"
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
