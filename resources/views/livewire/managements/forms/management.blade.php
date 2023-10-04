<div class="container-fluid">
    <h4>
        {{ __('message.add', ['model' => __('names.management')]) }}
    </h4>
    <form method="POST" action="#" wire:submit.prevent="save">
        @csrf
        <div class="row">
            <div class="col-md-4 form-group mb-2">
                <x-input-label :value="__('names.branch-name')"></x-input-label>
                <select name="branch_id" wire:model.lazy="branch_id"
                    class="form-select @error('branch_id') is-invalid  @enderror">
                    <option value=""> {{ __('names.select') }}</option>
                    @foreach ($branches as $key => $branch)
                        <option value="{{ $key }}" {{ $branch_id == $key ? 'selected' : '' }}>
                            {{ $branch }} </option>
                    @endforeach
                </select>
                @error('branch_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group mb-2">

                <x-input-label :value="__('names.management-type')"></x-input-label>
                <select name="type" class="form-select @error('type') is-invalid  @enderror"
                    wire:model.lazy="type">
                    @foreach ($types as $key => $t)
                        <option value="{{ $key }}">
                            {{ $t }}
                        </option>
                    @endforeach
                </select>
                @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            @if ($type == 'sub')
                <div class="col-md-4 form-group mb-2">
                    <x-input-label :value="__('names.management-parent')"></x-input-label>
                    <select class="form-select @error('parent_id') is-invalid @enderror" wire:model.lazy="parent_id"
                        name="parent_id">
                        <option> {{ __('names.select') }}</option>
                        @foreach ($management_parents as $key => $branch)
                            <option value="{{ $key }}" {{ $parent_id == $key ? 'selected' : '' }}>
                                {{ $branch }} </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-4 form-group mb-2">
                <x-input-label :value="__('names.management-name')"></x-input-label>
                <input name="name" type="text" class="form-control @error('name') is-invalid  @enderror"
                    wire:model.lazy="name" />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4 form-group mb-2">
                <x-input-label :value="__('names.manager-name')"></x-input-label>


                <select class="form-control form-select" wire:model.lazy="manager_id">
                    <option value="">
                        {{ __('names.select') }}
                    </option>
                    @foreach ($managers as $manager)
                        <option value="{{ $manager->user_id }}">
                            {{ $manager->first_name . ' ' . $manager->second_name . ' ' . $manager->last_name }}
                        </option>
                    @endforeach
                </select>
                @error('manager_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="mt-4">
            <div class="col-md-12">
                <h4>
                    {{ __('names.departments') }}
                </h4>
            </div>
            @foreach ($departments as $key => $department)
                <div class="row mb-4 mt-2">

                    <div class="col-md-6 mb-2">
                        <x-input-label :value="__('names.department-name')"></x-input-label>
                        <x-text-input class="" :value="$name"
                            wire:model.lazy="departments.{{ $key }}.name">
                        </x-text-input>
                        @error('departments.{{ $key }}.name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <x-input-label :value="__('names.manager-name')"></x-input-label>


                        <select class="form-control form-select"
                            wire:model.lazy="departments.{{ $key }}.manager_id">
                            <option value="">
                                {{ __('names.select') }}
                            </option>
                            @foreach ($deps_managers as $manager)
                                <option value="{{ $manager->user_id }}">
                                    {{ $manager->first_name . ' ' . $manager->second_name . ' ' . $manager->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-2">
                        <x-input-label :value="__('names.department-services')"></x-input-label>
                        <select class="form-control" wire:model.lazy="departments.{{ $key }}.tags"></select>
                    </div>


                </div>
            @endforeach
            <div class="col-md-12">
                <button type="button" wire:click="addDepartment" class="btn btn-primary btn-icon">
                    <i class='bx bx-plus-circle bx-sm'></i>
                    {{ __('message.add', ['model' => __('names.department')]) }}
                </button>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button type="button" wire:click.pervent="save" class="btn btn-primary w-100">
                    {{ __('names.save') }}
                </button>
            </div>
        </div>
    </form>
</div>
