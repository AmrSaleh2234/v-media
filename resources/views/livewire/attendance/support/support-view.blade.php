<div>
    <div class="row">
        <div class="col-md-8">
            <h4>
                {{ __('names.support-request-data') }}
            </h4>
            <p>
                <b>
                    {{ __('names.code') }} : {{ $ticket->id }}
                </b>
            </p>
        </div>
        <div class="col-md-4">
            <h4>
                {{ __('names.status') }} :

                <button class="btn btn-primary status  btn-icon {{ $ticket->status?->color }}"
                        data-bs-toggle="modal" data-bs-target="#changeStatus" @if ($ticket->status?->name == "resolved") disabled @endif >
                    @if ($ticket->status)
                        {{ __('names.' . $ticket->status?->name) }}
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
                    {{ __('names.' . $ticket->type) }}
                </p>
                <p>
                    <b>
                        {{ __('names.title') }}
                    </b>
                    :
                    {{ $ticket->title }}
                </p>
                @forelse($ticket->data as $key => $value)
                    <p>
                        <b>
                            {{ __('names.'.$key) }}
                        </b>
                        :
                        {{ $value}}
                    </p>
                @empty
                    <p>
                        <b>
                            {{ __('names.no-data') }}
                        </b>

                    </p>
                @endforelse
            </div>
{{--            <div class="mt-2">--}}
{{--                @if ($clientRequest->type == 'company')--}}
{{--                    <x-upload :path="url('/storage/' . $clientRequest->register_image)"></x-upload>--}}
{{--                @else--}}
{{--                    <x-upload :path="url('/storage/' . $clientRequest->card_image)"></x-upload>--}}
{{--                @endif--}}
{{--            </div>--}}
        </div>
    </div>
    @if (havePermissionTo('tickets.changeStatus'))
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
                                    <select class="form-select" wire:model.lazy="ticket.status_id">
                                        <option value="">{{ __('message.select', ['model' => __('names.status')]) }}
                                        </option>
                                        @foreach ($statues as $key => $status)
                                            <option value="{{ $key }}">
                                                {{ __('names.' . $status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ticket.status_id')
                                    <span class="d-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <x-input-label :value="__('names.response')"></x-input-label>
                                    <textarea row="4" class="form-control" {{ $ticket->status->name !== 'resolved'  ? 'disabled readonly' : '' }}
                                    wire:model.lazy="ticket.response"></textarea>
                                    @error('ticket.response')
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
