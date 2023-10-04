<div>
    <div class="row">
        <div class="col-md-8">
            <h4>
                {{ __('names.register-client-information') }}
            </h4>
            <p>
                <b>
                    {{ __('names.code') }} : {{ $clientRequest->id }}
                </b>
            </p>
        </div>
        <div class="col-md-4">
            <h4>
                {{ __('names.status') }} :

                <button class="btn btn-primary status  btn-icon {{ $clientRequest->status?->color }}"
                    data-bs-toggle="modal" data-bs-target="#changeStatus">
                    @if ($clientRequest->status)
                        {{ __('names.' . $clientRequest->status?->name) }}
                    @else
                        {{ __('message.select', ['model' => __('names.status')]) }}
                    @endif
                    <i class="bx bx-chevron-left "></i>
                </button>
            </h4>
        </div>
        <div class="col-md-12 mt-2">
            <div class="section">
                <p>
                    <b>
                        {{ __('names.type') }}
                    </b>
                    :
                    {{ __('names.' . $clientRequest->type) }}
                </p>
                <p>
                    <b>
                        {{ __('names.name') }}
                    </b>
                    :
                    {{ $clientRequest->name }}
                </p>
                <p>
                    <b>
                        {{ __('names.phone') }}
                    </b>
                    :
                    {{ $clientRequest->phone }}
                </p>
                <p>
                    <b>
                        {{ __('names.email') }}
                    </b>
                    :
                    {{ $clientRequest->email }}
                </p>
                @if ($clientRequest->type == 'company')
                    <p>
                        <b>
                            {{ __('names.register-number') }}
                        </b>
                        :
                        {{ $clientRequest->register_number }}
                    </p>
                @else
                    <p>
                        <b>
                            {{ __('names.card-id') }}
                        </b>
                        :
                        {{ $clientRequest->card_id }}
                    </p>
                @endif

                <p>
                    <b>
                        {{ __('names.branch') }}
                    </b>
                    :
                    {{ $clientRequest->branch?->name }}
                </p>
                <p>
                    <b>
                        {{ __('names.letter-head') }}
                    </b>
                    :
                    {{ $clientRequest->letter_head }}
                </p>
            </div>
            <div class="mt-2">
                @if ($clientRequest->type == 'company')
                    <x-upload :path="url('/storage/' . $clientRequest->register_image)"></x-upload>
                @else
                    <x-upload :path="url('/storage/' . $clientRequest->card_image)"></x-upload>
                @endif
            </div>
        </div>
    </div>
    @if (havePermissionTo('clientRequests.changeStatus'))
        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="changeStatus" tabindex="-1" aria-labelledby="changeStatusLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form wire:submit.prevent="save">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <x-input-label :value="__('names.status')"></x-input-label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" wire:model.lazy="clientRequest.status_id">
                                        <option value="">{{ __('message.select', ['model' => __('names.status')]) }}
                                        </option>
                                        @foreach ($statues as $key => $status)
                                            <option value="{{ $key }}">
                                                {{ __('names.' . $status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('clientRequest.status_id')
                                        <span class="d-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <x-input-label :value="__('names.note')"></x-input-label>
                                    <textarea row="4" class="form-control" {{ $clientRequest->status_id == 1 ? 'disabled readonly' : '' }}
                                        wire:model.lazy="clientRequest.note"></textarea>
                                    @error('clientRequest.note')
                                        <span class="d-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('names.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endif
</div>
