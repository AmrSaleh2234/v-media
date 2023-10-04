<div class="row">
    <div class="col-lg-8">
        @if(isset($companyProject))
            <h3>{{ __('message.edit',['model'=>__('names.project')]) }}</h3>

        @else
            <h3>{{ __('message.add',['model'=>__('names.project')]) }}</h3>
        @endif


        <h6>{{ __('names.project-brief') }}</h6>

        <div class="section row">
            <div class="form-group col-md-3">
                <div class="form-check form-switch   ">
                    <input class="form-check-input" wire:model="is_featured" type="checkbox" role="switch"
                           id="is_featured">
                    <label class="form-check-label" for="is_featured">{{ __('names.featured-project') }}</label>

                </div>
                <small class="text-gray">{{ __("message.add-main-page") }}</small>
            </div>
            <div class="col-md-9">
            </div>
            <div class="form-group mb-2 col-md-6  @error('title') is-invalid @enderror ">
                <x-input-label :value="__('names.project-title')" lang="ar" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="title" :required="false" name="name"
                              placeholder="{{ __('names.project-title') }}"></x-text-input>
                @error('title')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2 col-md-6  @error('title_en') is-invalid @enderror ">
                <x-input-label :value="__('names.project-title')" lang="en" :required="false"></x-input-label>
                <x-text-input wire:model.lazy="title_en" :required="false" name="name"
                              placeholder="{{ __('names.project-title') }}"></x-text-input>
                @error('title_en')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2 @error('project_type_id') is-invalid @enderror">
                <x-input-label :value="__('names.project-type')" :required="true"></x-input-label>
                <x-select-lang :options="$projectTypes" model="project_type_id" placeholder="project-type" id="branch"
                          class="country-select "
                          name="project_type_id">
                </x-select-lang>
                @error('project_type_id')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2 col-md-6  @error('name') is-invalid @enderror ">
                <x-input-label :value="__('names.project-name')" lang="ar" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="name" :required="false" name="name"
                              placeholder="{{ __('names.project-name') }}"></x-text-input>
                @error('name')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2 col-md-6  @error('name_en') is-invalid @enderror ">
                <x-input-label :value="__('names.project-name')" lang="en" :required="false"></x-input-label>
                <x-text-input wire:model.lazy="name_en" :required="false" name="name_en"
                              placeholder="{{ __('names.project-name') }}"></x-text-input>
                @error('name_en')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2   @error('description') is-invalid @enderror ">
                <x-input-label :value="__('names.project-description')" lang="ar" :required="true"></x-input-label>
                <x-textarea wire:model.lazy="description" :required="false" name="name"
                            placeholder="{{ __('names.project-description') }}"></x-textarea>
                @error('description')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2   @error('description_en') is-invalid @enderror ">
                <x-input-label :value="__('names.project-description')" lang="en" :required="false"></x-input-label>
                <x-textarea wire:model.lazy="description_en" :required="false" name="name"
                            placeholder="{{ __('names.project-description') }}"></x-textarea>
                @error('description_en')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <h4>{{ __('names.work-zone') }}</h4>
        <div class="section">
            @foreach($workZones as $key => $workZone)
                <div class="row">

                    <div class="form-group mb-2 col-md-6 @error('workZones.'.$key.'.zone') is-invalid @enderror ">
                        <x-input-label :value="__('names.work-zone')" lang="ar" :required="true"></x-input-label>
                        <x-text-input wire:model.lazy="workZones.{{$key}}.zone" :required="false" name="name"
                                      placeholder="{{ __('names.work-zone') }}"></x-text-input>
                        @error('workZones.'.$key.'.zone')
                        <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2 col-md-6 @error('workZones.'.$key.'.zone_en') is-invalid @enderror ">
                        <x-input-label :value="__('names.work-zone')" lang="en" :required="false"></x-input-label>
                        <x-text-input wire:model.lazy="workZones.{{$key}}.zone_en" :required="false" name="name"
                                      placeholder="{{ __('names.work-zone') }}"></x-text-input>
                        @error('workZones.'.$key.'.zone_en')
                        <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
{{--                    <div class="col-md-12 form-group mb-3">--}}
{{--                        <x-input-label :value="__('names.attachment')" :required="true"></x-input-label>--}}
{{--                        <x-upload model="workZones.{{$key}}.file.file" max_size="32"--}}
{{--                                  :size="$workZones[$key]['file']['size'] ?? null"--}}
{{--                                  :original_name="$workZones[$key]['file']['original_name'] ?? null"--}}
{{--                                  :extension="$workZones[$key]['file']['extension'] ?? null"--}}
{{--                                  :file="is_object($workZones[$key]['file']['file']) ?  $workZones[$key]['file']['file'] : null"--}}
{{--                                  :path="!is_object($workZones[$key]['file']['file']) ? is_string($workZones[$key]['file']['path']) ? asset('/storage/' .$workZones[$key]['file']['path']) : null : null"--}}
{{--                        >--}}

{{--                        </x-upload>--}}


{{--                        <div wire:loading wire:target="workZones.{{$key}}.file">--}}
{{--                            {{ __('names.uploading') }}...--}}
{{--                        </div>--}}
{{--                        @error('workZones.'.$key.'.file')--}}
{{--                        <div class="message mt-2">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                    <div class="form-group col mb-2  @error('workZones.'.$key.'.service_id') is-invalid @enderror">
                        <x-input-label :value="__('names.service')" :required="true"></x-input-label>
                        <x-select-lang :options="$services" model="workZones.{{$key}}.service_id" placeholder="service"
                                       id="branch" class="country-select "
                                       name="project_type_id">
                        </x-select-lang>
                        @error('workZones.'.$key.'.service_id')
                        <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                    @if($loop->count > 1)
                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-danger"
                                    wire:click.prevent="deleteZone({{$key}})">{{ __('names.delete') }}</button>
                        </div>
                    @endif
                </div>
                <br>
            @endforeach
            <button class="btn btn-primary d-flex justify-content-center align-items-center" type="button"
                    wire:click.prevent="addZone()">
                <i class='bx bx-plus-circle bx-sm'></i>
                {{ __('message.add', ['model' => __('names.work-zone')]) }}
            </button>
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

                        <input class="form-check-input" wire:model="website" type="checkbox" role="switch" id="website">
                    </div>
                </div>
            </div>
            <br>
            <button type="button" class="btn btn-primary w-100"
                    wire:click.prevent="save()">{{ __('names.save') }}</button>
        </div>


    </div>
    <div class="col-lg-4">
        <h4>{{ __('message.add',['model'=>__('names.image')]) }}</h4>
        <h6>{{ __('names.main-image') }}</h6>
        <div class="images-gallery-form">
            <label class="gallery-image main-image">
                @if ($companyProject && !isset($main_image))
                    <img
                        src="{{ $main_image_path ?  asset('storage/'.$main_image_path) : asset('assets/images/upload.png') }}"
                        alt="">
                @else
                    <img src="{{ $main_image ?  $main_image->temporaryUrl() : asset('assets/images/upload.png') }}"
                         alt="">
                @endif
                <div class="on-hover">{{ __('names.edit') }}</div>
                <input type="file" wire:model="main_image" class="d-none" name="" id="">
            </label>
            <div wire:loading wire:target="main_image">
                {{ __('names.uploading') }}...
            </div>
            @error('main_image')
            <div class="form-group is-invalid text-center">
                <div class="message">{{ $message }}</div>
            </div>
            @enderror
        </div>

        <h6>{{ __('names.sub-images') }}</h6>
        <div class="images-gallery-form">
            <div class="images-row">
                <label class="gallery-image">
                    @if ($companyProject && !isset($sub_image1))
                        <img
                            src="{{ $sub_image1_path ?  asset('storage/'.$sub_image1_path) : asset('assets/images/upload.png') }}"
                            alt="">
                    @else
                        <img src="{{ $sub_image1 ?  $sub_image1->temporaryUrl() : asset('assets/images/upload.png') }}"
                             alt="">
                    @endif
                    <div class="on-hover">تعديل</div>
                    <input type="file" class="d-none" wire:model="sub_image1" name="" id="">
                    @error('sub_image1')
                    <div class="message">{{ $message }}</div>
                    @enderror
                </label>
                <label class="gallery-image">
                    @if ($companyProject && !isset($sub_image2))
                        <img
                            src="{{ $sub_image2_path ?  asset('storage/'.$sub_image2_path) : asset('assets/images/upload.png') }}"
                            alt="">
                    @else
                        <img src="{{ $sub_image2 ?  $sub_image2->temporaryUrl() : asset('assets/images/upload.png') }}"
                             alt="">
                    @endif
                    <div class="on-hover">تعديل</div>
                    <input type="file" class="d-none" wire:model="sub_image2" name="" id="">
                    @error('sub_image2')
                    <div class="message">{{ $message }}</div>
                    @enderror
                </label>
            </div>
            <div class="images-row">
                <label class="gallery-image">
                    @if ($companyProject && !isset($sub_image3))
                        <img
                            src="{{ $sub_image3_path ?  asset('storage/'.$sub_image3_path) : asset('assets/images/upload.png') }}"
                            alt="">
                    @else
                        <img src="{{ $sub_image3 ?  $sub_image3->temporaryUrl() : asset('assets/images/upload.png') }}"
                             alt="">
                    @endif
                    <div class="on-hover">{{ __('names.edit') }}</div>
                    <input type="file" class="d-none" wire:model="sub_image3" name="" id="">
                    @error('sub_image3')
                    <div class="message">{{ $message }}</div>
                    @enderror
                </label>
                <label class="gallery-image">
                    @if ($companyProject && !isset($sub_image4))
                        <img
                            src="{{ $sub_image4_path ?  asset('storage/'.$sub_image4_path) : asset('assets/images/upload.png') }}"
                            alt="">
                    @else
                        <img src="{{ $sub_image4 ?  $sub_image4->temporaryUrl() : asset('assets/images/upload.png') }}"
                             alt="">
                    @endif
                    <div class="on-hover">تعديل</div>
                    <input type="file" class="d-none" wire:model="sub_image4" name="" id="">

                </label>
            </div>
            <div wire:loading wire:target="sub_image1">
                {{ __('names.uploading') }}...
            </div>
            @error('sub_image1')
            <div class="message">{{ $message }}</div>
            @enderror
            <div wire:loading wire:target="sub_image2">
                {{ __('names.uploading') }}...
            </div>
            @error('sub_image2')
            <div class="message">{{ $message }}</div>
            @enderror
            <div wire:loading wire:target="sub_image3">
                {{ __('names.uploading') }}...
            </div>
            @error('sub_image3')
            <div class="message">{{ $message }}</div>
            @enderror
            <div wire:loading wire:target="sub_image4">
                {{ __('names.uploading') }}...
            </div>
            @error('sub_image4')
            <div class="message">{{ $message }}</div>
            @enderror
        </div>

    </div>
</div>
