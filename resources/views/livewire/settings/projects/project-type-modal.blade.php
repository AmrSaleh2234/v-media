<div wire:ignore.self class="modal fade" id="ProjectTypeModal" tabindex="-1" aria-labelledby="ProjectTypeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content"  >
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title"
                    id="ProjectTypeModalLabel">{{ __('message.'.$title,['model' => __('names.project-type')]) }}</h5>
                <a href="#" data-bs-dismiss="modal">
                    <i class='bx bx-x-circle bx-md' ></i>
                </a>
            </div>
            <div class="modal-body ">

                <form wire:submit.prevent="save" >
                    @csrf

                    <div class="form-group row">
                        <div class="form-group mb-2 col-md-6  @error('projectType.name.ar') is-invalid @enderror ">
                            <x-input-label :value="__('names.project-type')" lang="ar" :required="true"></x-input-label>
                            <x-text-input wire:model.lazy="projectType.name.ar" :required="false" name="name"
                                          placeholder="{{ __('names.project-type') }}"></x-text-input>
                            @error('projectType.name.ar')
                            <div class="message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2 col-md-6  @error('projectType.name.en') is-invalid @enderror ">
                            <x-input-label :value="__('names.project-type')" lang="en" :required="false"></x-input-label>
                            <x-text-input wire:model.lazy="projectType.name.en" :required="false" name="name_en"
                                          placeholder="{{ __('names.project-type') }}"></x-text-input>
                            @error('projectType.name.en')
                            <div class="message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2 col-md-6  @error('projectType.group') is-invalid @enderror ">
                            <x-input-label :value="__('names.group')"  :required="false"></x-input-label>
                            <x-text-input wire:model.lazy="projectType.group" :required="false" name="name_en"
                                          placeholder="{{ __('names.group') }}"></x-text-input>
                            @error('projectType.group')
                            <div class="message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary"
                        wire:click.pervent="close('ProjectTypeModal')"
                        data-bs-dismiss="modal">{{ __('names.close') }}</button>
                <button type="button" class="btn btn-{{$color}}"
                        wire:click.pervent="save">{{ __('names.'.$button) }}</button>
            </div>
        </div>
    </div>
</div>
