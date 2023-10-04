<div wire:ignore.self class="modal fade" id="AgreementModal" tabindex="-1" aria-labelledby="AgreementModalLabel"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content"  >
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title"
                    id="AgreementModalLabel">{{ __('message.'.$title,['model' => __('names.agreement')]) }}</h5>
                <a href="#" data-bs-dismiss="modal">
                    <i class='bx bx-x-circle bx-md' ></i>
                </a>
            </div>
            <div class="modal-body ">

                <form wire:submit.prevent="save" >
                    @csrf


                        <div class="form-group mb-2   @error('content_ar') is-invalid @enderror ">
                            <x-input-label :value="__('names.content')" lang="ar" :required="true"></x-input-label>
                            <x-textarea wire:model.lazy="content_ar" :required="false" name="content_ar"
                                        placeholder="{{ __('names.content') }}"></x-textarea>
                            @error('content_ar')
                            <div class="message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2   @error('content') is-invalid @enderror ">
                            <x-input-label :value="__('names.content')" lang="en" :required="true"></x-input-label>
                            <x-textarea wire:model.lazy="content" :required="false" name="content"
                                        placeholder="{{ __('names.content') }}"></x-textarea>
                            @error('content')
                            <div class="message">{{ $message }}</div>
                            @enderror
                        </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary"
                        wire:click.pervent="close('AgreementModal')"
                        data-bs-dismiss="modal">{{ __('names.close') }}</button>
                <button type="button" class="btn btn-{{$color}}"
                        wire:click.pervent="save">{{ __('names.'.$button) }}</button>
            </div>
        </div>
    </div>
</div>
