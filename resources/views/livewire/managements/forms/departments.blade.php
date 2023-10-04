<div class="section">
    <div class="row">
        <div class="col-md-12">
            <h4>
                {{ __('message.add', ['model' => __('names.department')]) }}
            </h4>
        </div>
        <div class="col-md-6 mb-2">
            <x-input-label :value="__('names.department-type')"></x-input-label>
            <select name="type" class="form-select @error('type') is-invalid  @enderror" wire:model.lazy="type">
                @foreach ($types as $key => $t)
                    <option value="{{ $key }}" {{ $key == $type ? 'selected' : '' }}>
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

        <div class="col-md-6">
            @if ($type == 'sub')
                <x-input-label :value="__('names.department-parent')"></x-input-label>
                <select class="form-select @error('parent_id') is-invalid @enderror" wire:model.lazy="parent_id"
                    name="parent_id">
                    <option> {{ __('names.select') }}</option>
                    @foreach ($parents as $key => $branch)
                        <option value="{{ $key }}" {{ $parent_id == $key ? 'selected' : '' }}>
                            {{ $branch }} </option>
                    @endforeach
                </select>
                @error('parent_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            @endif
        </div>
        <div class="col-md-6">
            <x-input-label :value="__('names.department-name')"></x-input-label>
            <input name="name" value="{{ $name }}" type="text"
                class="form-control @error('name') is-invalid  @enderror" wire:model.lazy="name" />
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6">
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
        <div class="col-md-12 mb-2">
            <x-input-label :value="__('names.department-services')"></x-input-label>
            <select class="form-control" name="123"></select>
        </div>

        <div class="col-md-10"></div>
        <div class="col-md-2">
            <button wire:click.pervent="save" class="btn btn-primary w-100 btn-block">
                {{ __('names.save') }}
            </button>
        </div>

    </div>
</div>
