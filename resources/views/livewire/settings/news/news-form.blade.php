<div class="row">
    <div class="col-lg-8">
        <h3>{{ __('message.add',['model'=>__('names.news')]) }}</h3>

        <h6>{{ __('names.news-data') }}</h6>

        <div class="section row">
            <div class="form-group col-md-6 mb-2   @error('title') is-invalid @enderror ">
                <x-input-label :value="__('names.title')" lang="ar" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="title" :required="false" name="name"
                              placeholder="{{ __('names.title') }}"></x-text-input>
                @error('title')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2  col-md-6 @error('title_en') is-invalid @enderror ">
                <x-input-label :value="__('names.title')" lang="en" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="title_en" :required="false" name="name"
                              placeholder="{{ __('names.title') }}"></x-text-input>
                @error('title_en')
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
            <div class="form-group mb-2  col-md-6 @error('published_at') is-invalid @enderror ">
                <x-input-label :value="__('names.published-at')"  :required="true"></x-input-label>
                <x-text-input wire:model.lazy="published_at" :required="false" type="datetime-local"
                              placeholder="{{ __('names.published-at') }}"></x-text-input>
                @error('published_at')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2  col-md-6 @error('end_at') is-invalid @enderror ">
                <x-input-label :value="__('names.end-date')"  :required="true"></x-input-label>
                <x-text-input wire:model.lazy="end_at" :required="false" type="datetime-local"
                              placeholder="{{ __('names.end-date') }}"></x-text-input>
                @error('end_at')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2   @error('content') is-invalid @enderror ">
                <x-input-label :value="__('names.news-content')" lang="ar" :required="true"></x-input-label>
                <x-textarea wire:model.lazy="content" :required="false" name="name"
                            placeholder="{{ __('names.news-content') }}"></x-textarea>
                @error('content')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2   @error('content_en') is-invalid @enderror ">
                <x-input-label :value="__('names.news-content')" lang="en" :required="true"></x-input-label>
                <x-textarea wire:model.lazy="content_en" :required="false" name="name"
                            placeholder="{{ __('names.news-content') }}"></x-textarea>
                @error('content_en')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>

            <br>
            <br>
            <div class="row">
                <div class="form-group col-md-6">
                    <div class="form-check form-switch  ">
                        <label class="form-check-label" for="app">{{ __('names.application') }}</label>
                        <input class="form-check-input" wire:model="app" type="checkbox" role="switch" disabled id="app">
                    </div>
                </div>
                <div class="form-group col-md-6">

                    <div class="form-check form-switch   ">
                        <label class="form-check-label" for="website">{{ __('names.website') }}</label>

                        <input class="form-check-input" wire:model="website" type="checkbox" role="switch"  id="website">
                    </div>
                </div>
            </div>
            <br>
            <br>
            <button type="button" class="btn btn-primary w-100"
                    wire:click.prevent="save()">{{ __('names.save') }}
            </button>
        </div>

    </div>
    <div class="col-lg-4">
        <h4>{{ __('message.add',['model'=>__('names.image')]) }}</h4>
        <h6>{{ __('names.main-image') }}</h6>
        <div class="images-gallery-form">
            <label class="gallery-image main-image">
                @if ($news && !isset($image))
                    <img src="{{ $image_path ?  asset('storage/'.$image_path) : asset('assets/images/upload.png') }}" alt="">
                @else
                    <img src="{{ $image ?  $image->temporaryUrl() : asset('assets/images/upload.png') }}" alt="">
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
        <h6>{{ __('names.thumbnail') }}</h6>
        <div class="images-gallery-form">
            <label class="gallery-image main-image">
                @if ($news && !isset($thumbnail))
                    <img src="{{ $thumbnail_path ?  asset('storage/'.$thumbnail_path) : asset('assets/images/upload.png') }}" alt="">
                @else
                    <img src="{{ $thumbnail ?  $thumbnail->temporaryUrl() : asset('assets/images/upload.png') }}" alt="">
                @endif
                <div class="on-hover">{{ __('names.edit') }}</div>
                <input type="file" wire:model="thumbnail" class="d-none" name="" id="">
            </label>
            <div wire:loading wire:target="thumbnail">
                {{ __('names.uploading') }}...
            </div>
            @error('thumbnail')
            <div class="form-group is-invalid text-center">
                <div class="message">{{ $message }}</div>
            </div>
            @enderror
        </div>
    </div>
</div>
