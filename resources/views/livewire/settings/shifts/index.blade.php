<div>
    <form class="loading" method="POST" action="#" wire:submit.prevent="save">
        @csrf
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="Label">
                {{ __('names.add-shift') }}
            </h1>
        </div>
        <div class="modal-body">
            <div class="row">

                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <x-input-label :value="__('names.name')"></x-input-label>
                        <input type="text" name="distance" wire:model.lazy="name"
                            class="form-control @error('name')
                                        is-invalid
                                    @enderror" />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                @foreach ($days as $key => $value)
                    <div class="col-md-12 my-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-4 form-group">
                                <input class="form-check-input" type="checkbox" name="days"
                                    wire:model.lazy="selected.{{ $key }}.checked"
                                    id="flexCheckDefault{{ $key }}" />
                                <label class="form-check-label ml-2 mr-2" for="flexCheckDefault{{ $key }}">
                                    {{ __($value) }}
                                </label>


                            </div>
                            <div class="col-md-2">
                                <x-input-label :value="__('names.early-from')"></x-input-label>



                                <input type="time" wire:model.lazy="selected.{{ $key }}.early_start"
                                    id="{{ $key }}_start" class="form-control" />

                            </div>
                            <div class="col-md-2">
                                <x-input-label :value="__('names.from')"></x-input-label>

                                <input type="time" wire:model.lazy="selected.{{ $key }}.start"
                                    id="{{ $key }}_start" class="form-control" />

                            </div>
                            <div class="col-md-2">
                                <x-input-label :value="__('names.late-to')"></x-input-label>
                                <input type="time" wire:model.lazy="selected.{{ $key }}.late_start"
                                    id="{{ $key }}_start" class="form-control" />

                            </div>

                            <div class="col-md-2">
                                <x-input-label :value="__('names.to')"></x-input-label>
                                <input type="time" wire:model.lazy="selected.{{ $key }}.end"
                                    name="{{ $key }}_end" class="form-control" />

                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-6">
                    <div class="form-group">
                        <x-input-label :value="__('names.distance')"></x-input-label>
                        <input type="number" name="distance" wire:model.lazy="distance"
                            class="form-control @error('distance')
                                        is-invalid
                                    @enderror" />
                        @error('distance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-input-label :value="__('names.offline-time')"></x-input-label>
                        <input type="number" name="offline" wire:model.lazy="offline"
                            class="form-control @error('offline')
                                        is-invalid
                                    @enderror" />
                        @error('offline')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div wire:loading wire:target="save">
            <div class="loader-cotnainer">
                <div class="loader"></div>
            </div>
        </div>
        <div class="modal-footer mt-2">
            <button type="button" class="btn btn-primary" wire:click.pervent="save">{{ __('names.save') }}</button>
        </div>
    </form>
</div>
