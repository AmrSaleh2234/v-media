<div wire:ignore.self>
    <div wire:ignore.self class="modal fade" id="{{ $modal_id }}" tabindex="-1"
        aria-labelledby="{{ $modal_id }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="#" wire:submit.prevent="save" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="{{ $modal_id }}Label">{{ $title_in }}</h1>
                        <a href="#" data-bs-dismiss="modal">
                            <i class='bx bx-x-circle bx-md'></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <x-input-label :value="__('names.paper-name')"></x-input-label>

                                    <select class="form-select" wire:model.lazy="paper_id">
                                        <option>
                                            {{ __('names.select') }}
                                        </option>
                                        @foreach ($paperNames as $key => $paper)
                                            <option value="{{ $key }}">
                                                {{ $paper }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('paper_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <x-input-label :value="__('names.notification-date')"></x-input-label>
                                    <input type="date"
                                        class="form-control @error('notification_date') is-invalid @enderror"
                                        wire:model.lazy="notification_date" readonly disabled />
                                    @error('notification_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <x-input-label :value="__('names.end-date')"></x-input-label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                        wire:model.lazy="end_date" />
                                    @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <x-input-label :value="__('names.attachment')"></x-input-label>
                                    <input type="file" class="form-control @error('attachment') is-invalid @enderror"
                                        wire:model.lazy="attachment" />

                                    <div wire:loading wire:target="attachment">Uploading...</div>
                                    @error('attachment')
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
                        <button type="button" class="btn btn-primary "
                            wire:click.pervent="save">{{ __('names.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
