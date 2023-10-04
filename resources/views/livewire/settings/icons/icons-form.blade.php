<div class="row">
    <div class="col-lg-8">
        <h3>{{ __('message.add', ['model' => __('names.icon')]) }}</h3>

        <h6>{{ __('names.icon-data') }}</h6>

        <div class="section row">
            <div class="form-group col-md-6 mb-2   @error('name') is-invalid @enderror ">
                <x-input-label :value="__('names.icon-name')" lang="ar" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="name" :required="false" name="name"
                    placeholder="{{ __('names.icon-name') }}"></x-text-input>
                @error('name')
                    <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2  col-md-6 @error('name_en') is-invalid @enderror ">
                <x-input-label :value="__('names.icon-name')" lang="en" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="name_en" :required="false" name="name"
                    placeholder="{{ __('names.icon-name') }}"></x-text-input>
                @error('name_en')
                    <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2 col-md-6 @error('type') is-invalid @enderror">
                <x-input-label :value="__('names.category')" :required="true"></x-input-label>
                <select wire:model="type" class="form-select">
                    <option value="">{{ __('message.select', ['model' => __('names.type')]) }}</option>
                    @foreach ($types as $type)
                        <option value="{{ $type }}">{{ __('names.' . $type) }}</option>
                    @endforeach
                </select>
                @error('type')
                    <div class="message">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="form-group mb-2  col-md-6 @error('link') is-invalid @enderror ">
                <x-input-label :value="__('names.link')"  :required="false"></x-input-label>
                <x-text-input wire:model.lazy="link" :required="false" type="link"
                              placeholder="{{ __('names.link') }}"></x-text-input>
                @error('link')
                <div class="message">{{ $message }}</div>
                @enderror
            </div> --}}
            <br>
            <br>
            <div class="row">
                <div class="form-group col-md-6">
                    <div class="form-check form-switch  ">
                        <label class="form-check-label" for="app">{{ __('names.application') }}</label>
                        <input class="form-check-input" wire:model="app" type="checkbox" role="switch" disabled
                            id="app">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-check form-switch   ">
                        <label class="form-check-label" for="website">{{ __('names.website') }}</label>
                        <input class="form-check-input" wire:model="website" type="checkbox" role="switch"
                            id="website">
                    </div>
                </div>
            </div>
            <br>
            <br>
            <button type="button" class="btn btn-primary w-100" wire:click.prevent="save()">{{ __('names.save') }}
            </button>
        </div>

    </div>
    <div class="col-lg-4">
        <h4>{{ __('message.add', ['model' => __('names.image')]) }}</h4>
        <h6>{{ __('names.logo') }}</h6>
        <div class="images-gallery-form">
            <label class="gallery-image main-image">
                @if ($icon && !isset($logo))
                    <img src="{{ $logo_path ? asset('storage/' . $logo_path) : asset('assets/images/upload.png') }}"
                        alt="">
                @else
                    <img src="{{ $logo ? $logo->temporaryUrl() : asset('assets/images/upload.png') }}" alt="">
                @endif
                <div class="on-hover">{{ __('names.edit') }}</div>
                <input type="file" wire:model="logo" class="d-none" name="" id="">
            </label>
            <div wire:loading wire:target="image">
                {{ __('names.uploading') }}...
            </div>
            @error('logo')
                <div class="form-group is-invalid text-center">
                    <div class="message">{{ $message }}</div>
                </div>
            @enderror
        </div>
    </div>
</div>
