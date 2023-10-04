<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="{{ $modal_id }}" tabindex="-1"
        aria-labelledby="{{ $modal_id }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="#" wire:submit.prevent="save">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="{{ $modal_id }}Label">{{ $title_in }}</h1>
                        <a href="#" data-bs-dismiss="modal">
                            <i class='bx bx-x-circle bx-md'></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @foreach ($days as $key => $value)
                                <div class="col-md-12 my-1">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-4 form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="days"
                                                    wire:model.lazy="selected.{{ $key }}.checked"
                                                    id="flexCheckDefault{{ $key }}" />
                                                <label class="form-check-label"
                                                    for="flexCheckDefault{{ $key }}">
                                                    {{ __($value) }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <select class="form-control"
                                                wire:model.lazy="selected.{{ $key }}.start"
                                                id="{{ $key }}_start">
                                                @foreach ($times as $hour)
                                                    <option value="{{ $hour }}">
                                                        {{ $hour }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control"
                                                wire:model.lazy="selected.{{ $key }}.end"
                                                name="{{ $key }}_end">
                                                @foreach ($times as $hour)
                                                    <option value="{{ $hour }}">
                                                        {{ $hour }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-12">
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
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary light"
                            wire:click.pervent="close('{{ $modal_id }}')"
                            data-bs-dismiss="modal">{{ __('names.close') }}</button>
                        <button type="button" class="btn btn-primary"
                            wire:click.pervent="save">{{ __('names.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
