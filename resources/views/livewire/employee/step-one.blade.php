<div>
    <form action="#" wire:submit.prevent="save" enctype="multipart/form-data">
        @csrf

        <section class="step 1">

            <br />

            <div class="section">
                <div class="user-image-upload">
                    <label class="create-user-image" id="userImageContainer">
                        @if ($personalImage)
                            <img class="user-image" src="{{ $personalImage->temporaryUrl() }}" alt=""
                                srcset="">
                        @else
                            <img class="user-image"
                                src="{{ isset($employee) && !empty($employee->info) ? asset('/storage/' . $employee->attachments?->where('type', 'personal_photo')?->last()?->path) : url('assets/images/profile-image.png') }}"
                                alt="" srcset="">
                        @endif

                        <a class="mt-2">
                            {{ __('names.upload-file') }}
                        </a>

                        <input type="file" wire:model.lazy="personalImage" class="image-upload d-none"
                            accept="image/*">

                        <div wire:loading wire:target="personalImage">{{ __('names.uploading') }}...</div>




                    </label>

                    @error('personalImage')
                        <div class="message mt-2 text-center">{{ $message }}</div>
                    @enderror

                </div>
            </div>

            <br />

            <div class="row">
                <div class="col-12">
                    <h4>
                        {{ __('names.personal-information') }}
                    </h4>
                </div>

                <div class="col-md-4 form-group mb-3 @error('employee.first_name') is-invalid  @enderror">
                    <x-input-label :value="__('names.first-name')"></x-input-label>
                    <input class="form-control " wire:model.lazy="employee.first_name"
                        placeholder="{{ __('names.first-name') }}">
                    @error('employee.first_name')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 form-group mb-3 @error('employee.second_name') is-invalid  @enderror">
                    <x-input-label :value="__('names.second-name')"></x-input-label>
                    <input class="form-control " wire:model.lazy="employee.second_name"
                        placeholder="{{ __('names.second-name') }}">
                    @error('employee.second_name')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 form-group mb-3 @error('employee.last_name') is-invalid  @enderror">
                    <x-input-label :value="__('names.last-name')"></x-input-label>
                    <input class="form-control " wire:model.lazy="employee.last_name"
                        placeholder="{{ __('names.last-name') }}">
                    @error('employee.last_name')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group mb-3 @error('employee.phone') is-invalid  @enderror">
                    <x-input-label :value="__('names.phone')"></x-input-label>
                    <input type="number" class="form-control " wire:model.lazy="employee.phone"
                        placeholder="{{ __('names.phone') }}">
                    @error('employee.phone')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group mb-3 @error('employee.email') is-invalid  @enderror">
                    <x-input-label :value="__('names.email')"></x-input-label>
                    <input type="email" class="form-control " wire:model.lazy="employee.email"
                        placeholder="{{ __('names.email') }}">
                    @error('employee.email')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group mb-3 @error('info.id_number') is-invalid  @enderror">
                    <x-input-label :value="__('names.id-number')"></x-input-label>
                    <input type="number" class="form-control " wire:model.lazy="info.id_number"
                        placeholder="{{ __('names.id-number') }}">
                    @error('info.id_number')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 form-group mb-3 @error('info.border_no') is-invalid  @enderror">
                    <x-input-label :value="__('names.border-no')"></x-input-label>
                    <input type="number" class="form-control " wire:model.lazy="info.border_no"
                        placeholder="{{ __('names.border-no') }}">
                    @error('info.border_no')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 form-group mb-3 @error('info.passport_no') is-invalid  @enderror">
                    <x-input-label :value="__('names.passport')"></x-input-label>
                    <input type="text" class="form-control " wire:model.lazy="info.passport_no"
                        placeholder="{{ __('names.passport') }}">
                    @error('info.passport_no')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 form-group mb-3 @error('info.national_id') is-invalid  @enderror">
                    <x-input-label :value="__('names.national-id')"></x-input-label>
                    <input type="number" class="form-control " wire:model.lazy="info.national_id"
                        placeholder="{{ __('names.national-id') }}">
                    @error('info.national_id')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group mb-3">
                    @if ($employee_id != null)
                        <x-upload model="border_photo" :file="$border_photo ?? null" :path="$info != null
                            ? url('/storage/' . $employee->attachments->where('type', 'border_photo')?->last()?->path)
                            : null" :original_name="$employee->attachments->where('type', 'border_photo')->value('original_name')"
                            :extension="$employee->attachments->where('type', 'border_photo')->value('extension')" :size="$employee->attachments->where('type', 'border_photo')->value('size')">
                        </x-upload>
                    @else
                        <x-upload model="border_photo" :file="$border_photo ?? null"></x-upload>
                    @endif



                    <div wire:loading wire:target="border_photo">{{ __('names.uploading') }}...</div>

                    @error('border_photo')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group mb-3">

                    @if ($employee_id != null)
                        <x-upload model="passport_photo" :file="$passport_photo ?? null" :path="$info != null
                            ? url('/storage/' . $employee->attachments->where('type', 'passport_photo')?->last()?->path)
                            : null" :original_name="$employee->attachments->where('type', 'passport_photo')->value('original_name')"
                            :extension="$employee->attachments->where('type', 'passport_photo')->value('extension')" :size="$employee->attachments->where('type', 'passport_photo')->value('size')">
                        </x-upload>
                    @else
                        <x-upload model="passport_photo" :file="$passport_photo ?? null"></x-upload>
                    @endif


                    <div wire:loading wire:target="passport_photo">{{ __('names.uploading') }}...</div>
                    @error('passport_photo')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group mb-3">

                    @if ($employee_id != null)
                        <x-upload model="national_photo" :file="$national_photo ?? null" :path="$info != null
                            ? url('/storage/' . $employee->attachments->where('type', 'national_photo')?->last()?->path)
                            : null" :original_name="$employee->attachments->where('type', 'national_photo')->value('original_name')"
                            :extension="$employee->attachments->where('type', 'national_photo')->value('extension')" :size="$employee->attachments->where('type', 'national_photo')->value('size')">
                        </x-upload>
                    @else
                        <x-upload model="national_photo" :file="$national_photo ?? null"></x-upload>
                    @endif


                    <div wire:loading wire:target="national_photo">{{ __('names.uploading') }}...</div>
                    @error('info.national_photo')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group mb-3 @error('info.nationality') is-invalid  @enderror">
                    <x-input-label :value="__('names.nationality')"></x-input-label>
                    <select class="form-control form-select @error('info.nationality') is-invalid  @enderror"
                        wire:model.lazy="info.nationality">
                        <option value="">
                            {{ __('names.select', ['model' => __('names.nationality')]) }}
                        </option>
                        <option value="egyption">
                            {{ __('names.egyption') }}
                        </option>
                        <option value="saudi">
                            {{ __('names.saudi') }}
                        </option>

                    </select>
                    @error('info.nationality')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 form-group mb-3 @error('info.gender') is-invalid  @enderror">
                    <x-input-label :value="__('names.gender')"></x-input-label>
                    <select class="form-control form-select  @error('info.gender') is-invalid  @enderror"
                        wire:model.lazy="info.gender">
                        <option value="">{{ __('message.select', ['model' => __('names.gender')]) }}</option>
                        <option value="{{ __('names.male') }}">
                            {{ __('names.male') }}
                        </option>
                        <option value="{{ __('names.female') }}">
                            {{ __('names.female') }}
                        </option>
                    </select>
                    @error('employee.gender')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 form-group mb-3 @error('info.birth_date') is-invalid  @enderror">
                    <x-input-label :value="__('names.birthdate')"></x-input-label>
                    <input type="date" wire:model.lazy="info.birth_date" class="form-control" />
                    @error('employee.gender')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-4 mb-3">
                    <h4>
                        {{ __('names.current-address') }}
                    </h4>
                </div>


                <div class="col-md-4 form-group mb-3 @error('employee.country_id') is-invalid  @enderror">
                    <x-input-label :value="__('names.country')"></x-input-label>
                    <select class="form-select" wire:model.lazy="employee.country_id">
                        <option value="">{{ __('message.select', ['model' => __('names.country')]) }}</option>

                        @foreach ($countries as $key => $country)
                            <option value="{{ $key }}">
                                {{ $country }}
                            </option>
                        @endforeach
                    </select>
                    @error('employee.country_id')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 form-group mb-3 @error('employee.city_id') is-invalid  @enderror">
                    <x-input-label :value="__('names.city')"></x-input-label>
                    <select class="form-select" wire:model.lazy="employee.city_id">
                        <option value="">{{ __('message.select', ['model' => __('names.city')]) }}</option>
                        @foreach ($cities as $key => $city)
                            <option value="{{ $key }}">
                                {{ $city }}
                            </option>
                        @endforeach
                    </select>
                    @error('employee.city_id')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group mb-3 @error('employee.address') is-invalid  @enderror">
                    <x-input-label :value="__('names.address')"></x-input-label>
                    <input class="form-control " wire:model.lazy="employee.address"
                        placeholder="{{ __('names.address') }}">
                    @error('employee.address')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-12 mt-4 mb-3">
                    <h4>
                        {{ __('names.mother-address') }}
                    </h4>
                </div>


                <div class="col-md-4 form-group mb-3 @error('motherAddress.country_id') is-invalid  @enderror">
                    <x-input-label :value="__('names.country')"></x-input-label>
                    <select class="form-select" wire:model.lazy="motherAddress.country_id">
                        <option value="">{{ __('message.select', ['model' => __('names.country')]) }}</option>
                        @foreach ($countries as $key => $country)
                            <option value="{{ $key }}">
                                {{ $country }}
                            </option>
                        @endforeach
                    </select>
                    @error('motherAddress.country_id')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 form-group mb-3 @error('motherAddress.city_id') is-invalid  @enderror">
                    <x-input-label :value="__('names.city')"></x-input-label>

                    <select class="form-select" wire:model.lazy="motherAddress.city_id">
                        <option value="">{{ __('message.select', ['model' => __('names.city')]) }}</option>
                        @foreach ($cities_2 as $key => $city)
                            <option value="{{ $key }}">
                                {{ $city }}
                            </option>
                        @endforeach
                    </select>
                    @error('motherAddress.city_id')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group mb-3 @error('motherAddress.address') is-invalid  @enderror">
                    <x-input-label :value="__('names.address')"></x-input-label>

                    <input type="text" class="form-control " wire:model.lazy.lazy="motherAddress.address"
                        placeholder="{{ __('names.address') }}">
                    @error('motherAddress.address')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-12 mt-4 mb-3">
                    <h4>
                        {{ __('names.relative-information') }}
                    </h4>
                </div>

                <div class="col-md-4 form-group mb-3 @error('relative.full_name') is-invalid  @enderror">
                    <x-input-label :value="__('names.name')"></x-input-label>
                    <input class="form-control " wire:model.lazy="relative.full_name"
                        placeholder="{{ __('names.name') }}">
                    @error('relative.full_name')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 form-group mb-3 @error('relative.phone') is-invalid  @enderror">
                    <x-input-label :value="__('names.phone')"></x-input-label>
                    <input type="number" class="form-control " wire:model.lazy="relative.phone"
                        placeholder="{{ __('names.phone') }}">
                    @error('relative.phone')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group mb-3 @error('relative.relative_Type') is-invalid  @enderror">
                    <x-input-label :value="__('names.relative-type')"></x-input-label>

                    <select class="form-control" wire:model.lazy="relative.relative_Type">
{{--                        <option value="">{{ __('message.select', ['model' => __('names.relative-type')]) }}--}}
{{--                        </option>--}}
                        @foreach ($relativeTypes as $key => $relative)
                            <option value="{{ $key }}">
                                {{ $relative }}
                            </option>
                        @endforeach
                    </select>

                    @error('relative.relative_Type')
                        <div class="message mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-8 mt-4"></div>
                <div class="col-4 mt-4">
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" disabled class="btn btn-outline-{{ $color }} w-100">
                                {{ __('names.prev') }}
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-{{ $color }} w-100">

                                {{ __('names.next') }}

                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </form>
</div>
