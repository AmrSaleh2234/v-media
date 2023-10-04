<div wire:ignore.self class="modal fade" id="JobNameModal" tabindex="-1" aria-labelledby="JobNameModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="JobNameModalLabel">{{ __('message.'.$title,['model' => __('names.job-name')]) }}</h5>
                <a href="#" data-bs-dismiss="modal">
                    <i class='bx bx-x-circle bx-md'></i>
                </a>
            </div>
            <div class="modal-body">

                <form wire:submit.prevent="save">
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-6">
                            <x-input-label :value=" __('names.name')"></x-input-label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   wire:model.lazy="name" autocomplete="name">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <x-input-label :value=" __('names.status')"></x-input-label>
                            <select wire:model.lazy="active" name="active" class="form-control ">
                                <option
                                    value="">{{ __('message.select',['model' => __('names.'.__('status'))]) }}</option>
                                <option value="1">{{ __('names.active') }}</option>
                                <option value="0">{{ __('names.in-active') }}</option>
                            </select>
                            @error('active')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <x-input-label :value="__('names.job-type')"></x-input-label>
                            <select wire:model.lazy="job_type_id" name="job_type_id" class="form-control form-select ">
                                <option
                                    value="">{{ __('message.select',['model' => __('names.'.__('job-type'))]) }}</option>
                                @foreach($jobTypes as $jobType)
                                    <option value="{{$jobType->id}}">{{ $jobType->name}}</option>
                                @endforeach
                            </select>
                            @error('job_type_id')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary"
                        wire:click.pervent="close('{{ $modal_id }}')"
                        data-bs-dismiss="modal">{{ __('names.close') }}
                </button>

                <button type="button" class="btn btn-{{$color}}"
                        wire:click.pervent="save">{{ __('names.'.$button) }}
                    <span class="spinner-border spinner-border-sm @if(!$loading) d-none @endif" role="status"
                          aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
</div>
