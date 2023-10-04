<div wire:ignore.self class="modal fade" id="JobTypeModal" tabindex="-1" aria-labelledby="JobTypeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content"  >
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title"
                    id="JobTypeModalLabel">{{ __('message.'.$title,['model' => __('names.job-type')]) }}</h5>
                <a href="#" data-bs-dismiss="modal">
                    <i class='bx bx-x-circle bx-md' ></i>
                </a>
            </div>
            <div class="modal-body ">

                <form wire:submit.prevent="save" >
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name" class=" col-form-label text-md-right">{{ __('names.name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   wire:model.lazy="name" autocomplete="name">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status" class=" col-form-label text-md-right">Status</label>
                            <select wire:model.lazy="active" name="active" class="form-control ">
                                <option
                                    value="">{{ __('message.select',['model' => __('names.'.__('status'))]) }}</option>
                                <option value="1">{{ __('names.active') }}</option>
                                <option value="0">{{ __('names.in-active') }}</option>
                            </select>
                            @error('status_id')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary"
                        wire:click.pervent="close('JobTypeModal')"
                        data-bs-dismiss="modal">{{ __('names.close') }}</button>
                <button type="button" class="btn btn-{{$color}}"
                        wire:click.pervent="save">{{ __('names.'.$button) }}</button>
            </div>
        </div>
    </div>
</div>
