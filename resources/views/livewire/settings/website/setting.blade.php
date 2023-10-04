<div class="row">
    <div class="col-lg-8">
        <div class="section">
            <h3>{{ __('names.footer-header-setting') }}</h3>
            <div class="row">
                <div class="form-group col-md-6 mb-2   @error('setting.name.ar') is-invalid @enderror ">
                    <x-input-label :value="__('names.company-name')" lang="ar" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.name.ar" :required="false" name="name"
                        placeholder="{{ __('names.company-name') }}"></x-text-input>
                    @error('setting.name.ar')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-2   @error('setting.name.en') is-invalid @enderror ">
                    <x-input-label :value="__('names.company-name')" lang="en" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.name.en" :required="false" name="name"
                        placeholder="{{ __('names.company-name') }}"></x-text-input>
                    @error('setting.name.en')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-2   @error('setting.slogan.ar') is-invalid @enderror ">
                    <x-input-label :value="__('names.company-slogan')" lang="ar" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.slogan.ar" :required="false" name="name"
                        placeholder="{{ __('names.company-slogan') }}"></x-text-input>
                    @error('setting.slogan.ar')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-2   @error('setting.slogan.en') is-invalid @enderror ">
                    <x-input-label :value="__('names.company-slogan')" lang="en" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.slogan.en" :required="false" name="name"
                        placeholder="{{ __('names.company-slogan') }}"></x-text-input>
                    @error('setting.slogan.en')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-12 mb-2   @error('setting.footer.ar') is-invalid @enderror ">
                    <x-input-label :value="__('names.footer')" lang="ar" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.footer.ar" :required="false" name="name"
                        placeholder="{{ __('names.footer') }}"></x-text-input>
                    @error('setting.footer.ar')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-12 mb-2   @error('setting.footer.en') is-invalid @enderror ">
                    <x-input-label :value="__('names.footer')" lang="en" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.footer.en" :required="false" name="name"
                        placeholder="{{ __('names.footer') }}"></x-text-input>
                    @error('setting.footer.en')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                @foreach ($setting['emails'] as $key => $email)
                    <div class="form-group col-md-6 @error('setting.emails.' . $key) is-invalid @enderror">
                        <x-input-label :value="__('names.email')" :required="true"></x-input-label>
                        <div class="input-group mb-3  " dir="ltr">
                            @if ($loop->last)
                                <button class="btn btn-primary" type="button" id="button-addon1"
                                    wire:click.prevent="addEmail()">
                                    <i class='bx bx-plus-circle bx-sm'></i>
                                </button>
                            @else
                                <button class="btn btn-danger" type="button" id="button-addon1"
                                    wire:click.prevent="deleteEmail({{ $key }})">
                                    <i class='bx bxs-x-circle bx-sm '></i>
                                </button>
                            @endif
                            <input type="email" wire:model.lazy="setting.emails.{{ $key }}"
                                class="form-control" dir="rtl" placeholder="{{ __('names.email') }}">
                        </div>
                        @error('setting.emails.' . $key)
                            <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>
            <div class="row">
                @foreach ($setting['phones'] as $key => $phone)
                    <div class="form-group col-md-6 @error('setting.phones.' . $key) is-invalid @enderror ">
                        <x-input-label :value="__('names.phone')" :required="true"></x-input-label>
                        <div class="input-group mb-3 " dir="ltr">
                            @if ($loop->last)
                                <button class="btn btn-primary" type="button" id="button-addon1"
                                    wire:click.prevent="addPhone()">
                                    <i class='bx bx-plus-circle bx-sm'></i>
                                </button>
                            @else
                                <button class="btn btn-danger" type="button" id="button-addon1"
                                    wire:click.prevent="deletePhone({{ $key }})">
                                    <i class='bx bxs-x-circle bx-sm '></i>
                                </button>
                            @endif
                            <input type="text" wire:model.lazy="setting.phones.{{ $key }}"
                                class="form-control" dir="rtl" placeholder="{{ __('names.phone') }}">

                        </div>
                        @error('setting.phones.' . $key)
                            <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>
            <div class="row">
                @foreach ($setting['whatsapp'] as $key => $number)
                    <div class="form-group col-md-6 @error('setting.whatsapp.' . $key) is-invalid @enderror">
                        <x-input-label :value="__('names.whatsapp')" :required="true"></x-input-label>
                        <div class="input-group mb-3  " dir="ltr">
                            @if ($loop->last)
                                <button class="btn btn-primary" type="button" id="button-addon1"
                                    wire:click.prevent="addWhatsapp()">
                                    <i class='bx bx-plus-circle bx-sm'></i>
                                </button>
                            @else
                                <button class="btn btn-danger" type="button" id="button-addon1"
                                    wire:click.prevent="deleteWhatsapp({{ $key }})">
                                    <i class='bx bxs-x-circle bx-sm '></i>
                                </button>
                            @endif
                            <input type="text" wire:model.lazy="setting.whatsapp.{{ $key }}"
                                class="form-control" dir="rtl" placeholder="{{ __('names.whatsapp') }}">
                        </div>
                        @error('setting.whatsapp.' . $key)
                            <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>
            <div class="row">
                @foreach ($setting['address'] as $key => $add)
                    <div
                        class="form-group col-md-12 @error('setting.address.' . $key . '.address') is-invalid @enderror">
                        <x-input-label :value="__('names.address')" :required="true"></x-input-label>
                        <div class="input-group mb-3  " dir="ltr">
                            <input type="text" wire:model.lazy="setting.address.{{ $key }}.address"
                                class="form-control" dir="rtl" placeholder="{{ __('names.address') }}">
                        </div>
                        @error('setting.address.' . $key . '.address')
                            <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div
                        class="form-group col-md-12 @error('setting.address.' . $key . '.longLat') is-invalid @enderror">
                        <x-input-label :value="__('names.longLat')" :required="true"></x-input-label>
                        <div class="input-group mb-3  " dir="ltr">
                            <input type="text" wire:model.lazy="setting.address.{{ $key }}.longLat"
                                class="form-control" dir="rtl" placeholder="{{ __('names.longLat') }}">
                        </div>
                        @error('setting.address.' . $key . '.longLat')
                            <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div
                        class="form-group col-md-12 @error('setting.address.' . $key . '.link') is-invalid @enderror">
                        <x-input-label :value="__('names.map-link')" :required="true"></x-input-label>
                        <div class="input-group mb-3" dir="ltr">
                            @if ($loop->last)
                                <button class="btn btn-primary" type="button" id="button-addon1"
                                    wire:click.prevent="addAddress()">
                                    <i class='bx bx-plus-circle bx-sm'></i>
                                </button>
                            @else
                                <button class="btn btn-danger" type="button" id="button-addon1"
                                    wire:click.prevent="deleteAddress({{ $key }})">
                                    <i class='bx bxs-x-circle bx-sm '></i>
                                </button>
                            @endif
                            <input type="url" wire:model.lazy="setting.address.{{ $key }}.link"
                                class="form-control" dir="rtl"
                                placeholder="https://goo.gl/maps/Mph3gko8HsLUAL3B9">
                        </div>
                        @error('setting.address.' . $key . '.link')
                            <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>
            <div class="row">
                <h4>{{ __('names.social') }}</h4>
                <div class="form-group col-md-6 mb-2   @error('setting.social.facebook') is-invalid @enderror ">
                    <x-input-label :value="__('names.facebook')" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.social.facebook" :required="false" type="url"
                        placeholder="www.facebook.com"></x-text-input>
                    @error('setting.social.facebook')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-2   @error('setting.social.instagram') is-invalid @enderror ">
                    <x-input-label :value="__('names.instagram')" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.social.instagram" :required="false" type="url"
                        placeholder="www.instagram.com"></x-text-input>
                    @error('setting.social.instagram')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-2   @error('social.snapchat') is-invalid @enderror ">
                    <x-input-label :value="__('names.snapchat')" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.social.snapchat" :required="false" type="url"
                        placeholder="www.snapchat.com"></x-text-input>
                    @error('setting.social.snapchat')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <h4>{{ __('names.applications-links') }}</h4>
                <div class="form-group col-md-6 mb-2   @error('setting.apps.play_store_link') is-invalid @enderror ">
                    <x-input-label :value="__('names.play-store-link')" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.apps.play_store_link" :required="false" type="url"
                        :placeholder="__('names.play-store-link')"></x-text-input>
                    @error('setting.apps.play_store_link')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-2   @error('setting.apps.app_store_link') is-invalid @enderror ">
                    <x-input-label :value="__('names.app-store-link')" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="setting.apps.app_store_link" :required="false" type="url"
                        :placeholder="__('names.app-store-link')"></x-text-input>
                    @error('setting.apps.app_store_link')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>

            <button type="button" class="btn btn-primary w-100" wire:click.prevent="save()">{{ __('names.save') }}
            </button>
        </div>
    </div>

    <div class="col-lg-4">
        {{--        <h4>{{ __('message.add',['model'=>__('names.image')]) }}</h4> --}}
        <h4>{{ __('names.logo') }}</h4>
        <div class="images-gallery-form">
            <label class="gallery-image main-image">
                @if (!empty($setting['logo'][0]))
                    <img src="{{ $setting['logo'][0]->temporaryUrl() }}" alt="">
                @elseif(isset($logo_path))
                    <img src="{{ $logo_path ? asset('storage/' . $logo_path) : asset('assets/images/upload.png') }}"
                        alt="">
                @else
                    <img src="{{ asset('assets/images/upload.png') }}" alt="">
                @endif
                <div class="on-hover">{{ __('names.edit') }}</div>
                <input type="file" wire:model="setting.logo.0" class="d-none" name="" id="">
            </label>
            <div wire:loading wire:target="setting.logo.0">
                {{ __('names.uploading') }} ...
            </div>
            @error('setting.logo')
                <div class="form-group is-invalid text-center">
                    <div class="message">{{ $message }}</div>
                </div>
            @enderror
        </div>
    </div>
</div>
