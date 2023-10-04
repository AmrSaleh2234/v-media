<div class="section">
    <h3>{{ __('names.service-page-setting') }}</h3>
    <hr>

    <form wmethod="POST" action="#" wire:submit.prevent="save">
        @csrf
        <div class="row">
            @for ($i = 0; $i < $sections_no; $i++)
                <div class="col-md-10 mb-2">
                    <h4>
                        {{ __('names.section-no') }} {{ $i + 1 }}
                    </h4>
                </div>
                <div class="col-md-2">
                    <div class="btn-group w-100" dir="ltr" role="group" aria-label="Basic example">
                        @if ($sections_no != 1 || gettype($sections) == 'array')
                            <button wire:click="removeSections({{ $i }})" type="button"
                                class="btn btn-danger">
                                <i class="bx bx-trash bx-sm"></i>
                            </button>
                        @endif
                        @if ($i == 0 || $i == $sections_no - 1)
                            <button wire:click="addSections" type="button" class="btn btn-primary">
                                <i class="bx bx-plus bx-sm"></i>
                            </button>
                        @endif
                    </div>
                </div>
                <div
                    class="col-md-6 mb-4 form-group @error("sections.{{ $i }}.title.ar") is-invalid @enderror">
                    <x-input-label :value="__('names.title')" lang="ar" :required="true"></x-input-label>
                    <input type="text" class="form-control"
                        wire:model.lazy="sections.{{ $i }}.title.ar" />
                    @error("sections.{{ $i }}.title.ar")
                        <span class="d-block text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div
                    class="col-md-6 mb-4 form-group @error("sections.{{ $i }}.title.en") is-invalid @enderror">
                    <x-input-label :value="__('names.title')" lang="en" :required="true"></x-input-label>
                    <input type="text" class="form-control"
                        wire:model.lazy="sections.{{ $i }}.title.en" />
                    @error("sections.{{ $i }}.title.en")
                        <span class="d-block text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div
                    class="col-md-6 mb-4 form-group @error("sections.{{ $i }}.description.ar") is-invalid @enderror">
                    <x-input-label :value="__('names.description')" lang="ar" :required="true"></x-input-label>
                    <textarea type="text" class="form-control" wire:model.lazy="sections.{{ $i }}.description.ar"></textarea>
                    @error("sections.{{ $i }}.description.ar")
                        <span class="d-block text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div
                    class="col-md-6 mb-4 form-group @error("sections.{{ $i }}.description.en") is-invalid @enderror">
                    <x-input-label :value="__('names.description')" lang="en" :required="true"></x-input-label>
                    <textarea type="text" class="form-control" wire:model.lazy="sections.{{ $i }}.description.en"></textarea>
                    @error("sections.{{ $i }}.description.en")
                        <span class="d-block text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div
                    class="col-md-6 mb-4 form-group @error("sections.{{ $i }}.design") is-invalid @enderror">
                    <x-input-label :value="__('names.type-of-design')" :required="true"></x-input-label>
                    <select class="form-select" wire:model.lazy="sections.{{ $i }}.design">
                        <option value="">
                            {{ __('message.select', ['Model' => __('names.type-of-design')]) }}
                        </option>
                        @foreach ($designs as $key => $design)
                            <option value="{{ $key }}">
                                {{ $design }}
                            </option>
                        @endforeach
                    </select>
                    @error("sections.{{ $i }}.design")
                        <span class="d-block text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div
                    class="col-md-12 mb-4 form-group @error("sections.{{ $i }}.services") is-invalid @enderror">
                    <x-input-label :value="__('names.services')" :required="true"></x-input-label>
                    <select multiple class="form-select" wire:model.lazy="sections.{{ $i }}.services">
                        @foreach ($services as $key => $service)
                            <option value="{{ $key }}">
                                {{ $service['ar'] }}
                            </option>
                        @endforeach
                    </select>
                    @error("sections.{{ $i }}.services")
                        <span class="d-block text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            @endfor
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('names.save') }}
                </button>
            </div>
        </div>
    </form>

</div>
