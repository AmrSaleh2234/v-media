<div class="row">
    <div class="col-lg-8">
        <div class="section">
            <h3>{{ __('names.about-page-setting') }}</h3>
            <div class="row">
                <div class="form-group mb-2 col-md-6 @error('setting.about_page_icons') is-invalid @enderror">
                    <x-input-label :value="__('names.about-page-icons')" :required="true"></x-input-label>
                    <select wire:model="setting.about_page_icons" class="form-select">
                        <option value="">{{ __('message.select', ['model' => __('names.type')]) }}</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ __('names.' . $type) }}</option>
                        @endforeach
                    </select>
                    @error('setting.about_page_icons')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-2   @error('setting.about_us.ar') is-invalid @enderror ">
                    <x-input-label :value="__('names.about-us')" lang="ar" :required="true"></x-input-label>
                    <x-textarea wire:model.lazy="setting.about_us.ar" :required="false" name="name"
                        placeholder="{{ __('names.about-us') }}"></x-textarea>
                    @error('setting.about_us.ar')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-2   @error('setting.about_us.en') is-invalid @enderror ">
                    <x-input-label :value="__('names.about-us')" lang="en" :required="true"></x-input-label>
                    <x-textarea wire:model.lazy="setting.about_us.en" :required="false" name="about_us"
                        placeholder="{{ __('names.about-us') }}"></x-textarea>
                    @error('setting.about_us.en')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-2   @error('setting.vision.ar') is-invalid @enderror ">
                    <x-input-label :value="__('names.vision')" lang="ar" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.vision.ar" :required="false" name="vision"
                        placeholder="{{ __('names.vision') }}"></x-text-input>
                    @error('setting.vision.ar')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-2   @error('setting.vision.en') is-invalid @enderror ">
                    <x-input-label :value="__('names.vision')" lang="en" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.vision.en" :required="false" name="vision"
                        placeholder="{{ __('names.vision') }}"></x-text-input>
                    @error('setting.vision.en')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-2   @error('setting.goal.ar') is-invalid @enderror ">
                    <x-input-label :value="__('names.company-goal')" lang="ar" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.goal.ar" :required="false" name="goal"
                        placeholder="{{ __('names.company-goal') }}"></x-text-input>
                    @error('setting.goal.ar')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-2   @error('setting.goal.en') is-invalid @enderror ">
                    <x-input-label :value="__('names.company-goal')" lang="en" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.goal.en" :required="false" name="goal"
                        placeholder="{{ __('names.company-goal') }}"></x-text-input>
                    @error('setting.goal.en')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-2   @error('setting.about_slogan.ar') is-invalid @enderror ">
                    <x-input-label :value="__('names.company-slogan')" lang="ar" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.about_slogan.ar" :required="false" name="name"
                        placeholder="{{ __('names.company-slogan') }}"></x-text-input>
                    @error('setting.about_slogan.ar')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-2   @error('setting.about_slogan.en') is-invalid @enderror ">
                    <x-input-label :value="__('names.company-slogan')" lang="en" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.about_slogan.en" :required="false" name="name"
                        placeholder="{{ __('names.company-slogan') }}"></x-text-input>
                    @error('setting.about_slogan.en')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                @foreach ($setting['projects'] as $key => $project)
                    <div class="form-group col-md-4 @error('setting.projects.' . $key . '.ar') is-invalid @enderror">
                        <x-input-label :value="__('names.project-type')" lang="ar" :required="true"></x-input-label>
                        <x-text-input wire:model.lazy="setting.projects.{{ $key }}.ar" :required="false"
                            name="name" placeholder="{{ __('names.project-type') }}"></x-text-input>
                        @error('setting.projects.' . $key . '.ar')
                            <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 @error('setting.projects.' . $key . '.en') is-invalid @enderror">
                        <x-input-label :value="__('names.project-type')" lang="en" :required="true"></x-input-label>
                        <x-text-input wire:model.lazy="setting.projects.{{ $key }}.en" :required="false"
                            name="name" placeholder="{{ __('names.project-type') }}"></x-text-input>
                        @error('setting.projects.' . $key . '.en')
                            <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 @error('setting.projects.' . $key . '.num') is-invalid @enderror">
                        <x-input-label :value="__('names.projects-count')" :required="true"></x-input-label>
                        <div class="input-group mb-3  " dir="ltr">
                            @if ($loop->last)
                                <button class="btn btn-primary" type="button" id="button-addon1"
                                    wire:click.prevent="addProject()">
                                    <i class='bx bx-plus-circle bx-sm'></i>
                                </button>
                            @else
                                <button class="btn btn-danger" type="button" id="button-addon1"
                                    wire:click.prevent="deleteProject({{ $key }})">
                                    <i class='bx bxs-x-circle bx-sm'></i>
                                </button>
                            @endif
                            <input type="number" wire:model.lazy="setting.projects.{{ $key }}.num"
                                class="form-control" dir="rtl" placeholder="{{ __('names.projects-count') }}">
                        </div>
                        @error('setting.projects.' . $key . '.num')
                            <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>

            <div class="row">
                <h4>{{ __('names.attachments') }}</h4>
                @foreach ($setting['files'] as $key => $file)
                    <div class="col-md-6 form-group mb-3">
                        <x-input-label :value="__('names.attachments')" :required="true"></x-input-label>
                        <x-upload model="setting.files.{{ $key }}.file" max_size="32" :size="$setting['files'][$key]['size'] ?? null"
                            :original_name="$setting['files'][$key]['original_name'] ?? null" :extension="$setting['files'][$key]['extension'] ?? null" :file="is_object($setting['files'][$key]['file'])
                                ? $setting['files'][$key]['file']
                                : null" :path="!is_object($setting['files'][$key]['file'])
                                ? (is_string($setting['files'][$key]['path'])
                                    ? asset('/storage/' . $setting['files'][$key]['path'])
                                    : null)
                                : null">

                        </x-upload>


                        <div wire:loading wire:target="setting.files.{{ $key }}.file">
                            {{ __('names.uploading') }}...
                        </div>
                        @error('setting.files.' . $key . '.file')
                            <div class="message mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 @error('setting.files.' . $key . '.name') is-invalid @enderror">
                        <x-input-label :value="__('names.file-name')" :required="true"></x-input-label>
                        <x-text-input wire:model.lazy="setting.files.{{ $key }}.name" :required="false"
                            placeholder="{{ __('names.file-name') }}"></x-text-input>
                        @error('setting.files.' . $key . '.name')
                            <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 d-flex align-content-center justify-content-center">
                        <div class="btn-group me-2" role="group" aria-label="First group" dir="ltr">
                            @if ($loop->count == 1)
                                <button class="btn btn-primary mt-auto" type="button"
                                    wire:click.prevent="addFile()">
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
            <button type="button" class="btn btn-primary w-100" wire:click.prevent="save()">{{ __('names.save') }}
            </button>
        </div>
    </div>

    <div class="col-lg-4">
        {{--        <h4>{{ __('message.add',['model'=>__('names.image')]) }}</h4> --}}
        <h4>{{ __('names.about-page-image') }}</h4>
        <div class="images-gallery-form">
            <label class="gallery-image main-image">
                @if (!empty($setting['about_page_image'][0]))
                    <img src="{{ $setting['about_page_image'][0]->temporaryUrl() }}" alt="">
                @elseif(isset($about_image_path))
                    <img src="{{ $about_image_path ? asset('storage/' . $about_image_path) : asset('assets/images/upload.png') }}"
                        alt="">
                @else
                    <img src="{{ asset('assets/images/upload.png') }}" alt="">
                @endif
                <div class="on-hover">{{ __('names.edit') }}</div>
                <input type="file" wire:model="setting.about_page_image.0" class="d-none" name=""
                    id="">
            </label>
            <div wire:loading wire:target="setting.about_page_image.0">
                {{ __('names.uploading') }}...
            </div>
            @error('setting.logo')
                <div class="form-group is-invalid text-center">
                    <div class="message">{{ $message }}</div>
                </div>
            @enderror
        </div>
    </div>
</div>
