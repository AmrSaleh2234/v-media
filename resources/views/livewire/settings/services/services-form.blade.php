<div class="row">
    <div class="col-lg-8">
        <h3>{{ __('message.add', ['model' => __('names.service')]) }}</h3>

        <h6>{{ __('names.service-data') }}</h6>

        <div class="section row">
            <div class="form-group col-md-3">
                <div class="form-check form-switch   ">
                    <input class="form-check-input" wire:model="is_featured" type="checkbox" role="switch" id="is_featured">
                    <label class="form-check-label" for="is_featured">{{ __('names.featured-service') }}</label>
                </div>
                <small class="text-gray">{{ __('message.add-main-page') }}</small>
            </div>
            <div class="col-md-9">
            </div>
            <div class="form-group col-md-6 mb-2   @error('name') is-invalid @enderror ">
                <x-input-label :value="__('names.service-name')" lang="ar" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="name" :required="false" name="name"
                    placeholder="{{ __('names.service-name') }}"></x-text-input>
                @error('name')
                    <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2  col-md-6 @error('name_en') is-invalid @enderror ">
                <x-input-label :value="__('names.service-name')" lang="en" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="name_en" :required="false" name="name"
                    placeholder="{{ __('names.service-name') }}"></x-text-input>
                @error('name_en')
                    <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2 col-md-6 @error('category_id') is-invalid @enderror">
                <x-input-label :value="__('names.category')" :required="true"></x-input-label>
                <x-select-lang :options="$categories" model="category_id" placeholder="category" name="category_id">
                </x-select-lang>
                @error('category_id')
                    <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2 col-md-6  @error('order_id') is-invalid @enderror ">
                <x-input-label :value="__('names.order-id')" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="order_id" :required="false" type="number"></x-text-input>
                @error('order_id')
                    <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2   @error('link') is-invalid @enderror  d-none">
                <x-input-label :value="__('names.link')" :required="false"></x-input-label>
                <x-text-input wire:model.lazy="link" :required="false" name="link"
                    placeholder="{{ __('names.link') }}"></x-text-input>
                @error('link')
                    <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2   @error('description') is-invalid @enderror ">
                <x-input-label :value="__('names.service-description')" lang="ar" :required="true"></x-input-label>
                <x-textarea wire:model.lazy="description" :required="false" name="name"
                    placeholder="{{ __('names.service-description') }}"></x-textarea>
                @error('description')
                    <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2   @error('description_en') is-invalid @enderror ">
                <x-input-label :value="__('names.service-description')" lang="en" :required="true"></x-input-label>
                <x-textarea wire:model.lazy="description_en" :required="false" name="name"
                    placeholder="{{ __('names.service-description') }}"></x-textarea>
                @error('description_en')
                    <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <h4>{{ __('names.previous-work') }}</h4>
                @foreach ($files as $key => $file)
                    <div class="form-group col-md-12 @error('files.' . $key . '.description') is-invalid @enderror">
                        <x-input-label :value="__('names.description')" :required="true"></x-input-label>
                        <x-textarea wire:model.lazy="files.{{ $key }}.description" :required="true"
                            placeholder="{{ __('names.description') }}"></x-textarea>
                        @error('files.' . $key . '.description')
                            <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-10 form-group mb-3">
                        <x-input-label :value="__('names.attachment')" :required="true"></x-input-label>
                        <x-upload model="files.{{ $key }}.file" max_size="32" :size="$files[$key]['size'] ?? null"
                            :original_name="$files[$key]['original_name'] ?? null" :extension="$files[$key]['extension'] ?? null" :file="is_object($files[$key]['file']) ? $files[$key]['file'] : null" :path="!is_object($files[$key]['file'])
                                ? (is_string($files[$key]['path'])
                                    ? asset('/storage/' . $files[$key]['path'])
                                    : null)
                                : null">

                        </x-upload>


                        <div wire:loading wire:target="setting.files.{{ $key }}.file">
                            {{ __('names.uploading') }}...
                        </div>
                        @error('files.' . $key . '.file')
                            <div class="message mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2 d-flex align-content-center justify-content-center">
                        <div class="btn-group me-2" role="group" aria-label="First group" dir="ltr">
                            @if ($loop->count == 1)
                                <button class="btn btn-primary mt-auto" type="button" wire:click.prevent="addFile()">
                                    <i class='bx bx-plus-circle bx-sm'></i>
                                    {{ __('names.add') }}
                                </button>
                            @else
                                @if ($loop->last)
                                    <button class="btn btn-primary mt-auto" type="button"
                                        wire:click.prevent="addFile()">
                                        <i class='bx bx-plus-circle bx-sm'></i>
                                    </button>
                                    <button class="btn btn-danger mt-auto" type="button"
                                        wire:click.prevent="deleteFile({{ $key }})">
                                        <i class='bx bxs-x-circle bx-sm'></i>
                                    </button>
                                @else
                                    <button class="btn btn-danger mt-auto" type="button"
                                        wire:click.prevent="deleteFile({{ $key }})">
                                        <i class='bx bxs-x-circle bx-sm'></i>
                                        {{ __('names.delete') }}
                                    </button>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="form-group col-md-6">
                    <div class="form-check form-switch  ">
                        <label class="form-check-label" for="app">{{ __('names.application') }}</label>
                        <input class="form-check-input" wire:model="app" type="checkbox" role="switch" id="app">
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
            <button type="button" class="btn btn-primary w-100"
                wire:click.prevent="save()">{{ __('names.save') }}</button>

        </div>

    </div>
    <div class="col-lg-4">
        <h4>{{ __('message.add', ['model' => __('names.image')]) }}</h4>
        <h6>{{ __('names.main-image') }}</h6>
        <div class="images-gallery-form">
            <label class="gallery-image main-image">
                @if ($service && !isset($image))
                    <img src="{{ $image_path ? asset('storage/' . $image_path) : asset('assets/images/upload.png') }}"
                        alt="">
                @else
                    <img src="{{ $image ? $image->temporaryUrl() : asset('assets/images/upload.png') }}"
                        alt="">
                @endif
                <div class="on-hover">{{ __('names.edit') }}</div>
                <input type="file" wire:model="image" class="d-none" name="" id="">
            </label>
            <div wire:loading wire:target="image">
                {{ __('names.uploading') }}...
            </div>
            @error('image')
                <div class="form-group is-invalid text-center">
                    <div class="message">{{ $message }}</div>
                </div>
            @enderror
        </div>
        <h6>{{ __('names.icon') }}</h6>
        <div class="images-gallery-form">
            <label class="gallery-image main-image">
                @if ($service && !isset($icon))
                    <img src="{{ $icon_path ? asset('storage/' . $icon_path) : asset('assets/images/upload.png') }}"
                        alt="">
                @else
                    <img src="{{ $icon ? $icon->temporaryUrl() : asset('assets/images/upload.png') }}"
                        alt="">
                @endif
                <div class="on-hover">{{ __('names.edit') }}</div>
                <input type="file" wire:model="icon" class="d-none" name="" id="">
            </label>
            @error('icon')
                <div class="form-group is-invalid text-center">
                    <div class="message">{{ $message }}</div>
                </div>
            @enderror
        </div>
    </div>
</div>
