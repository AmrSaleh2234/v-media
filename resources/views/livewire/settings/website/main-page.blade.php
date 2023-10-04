<div class="col-md-10 section row">

    <h3>{{ __('names.main-page-setting') }}</h3>
    <div class="form-group mb-2 col-md-6 @error('setting.main_page_icon') is-invalid @enderror">
        <x-input-label :value="__('names.main-page-icon')" :required="true"></x-input-label>
        <select wire:model="setting.main_page_icon" class="form-select">
            <option value="">{{ __('message.select',['model'=>__("names.type")]) }}</option>
            @foreach($types as $type)
                <option value="{{$type}}">{{ __('names.'.$type) }}</option>
            @endforeach
        </select>
        @error('setting.main_page_icon')
        <div class="message">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 form-group   @error('setting.organization_chart.0') is-invalid @enderror mb-3">
        <x-input-label :value="__('names.company-profile-file')" :required="true"></x-input-label>
        <x-upload model="setting.organization_chart.0" max_size="32" :size="$file?->size ?? null" :original_name="$file?->original_name ?? null" :extension="$file?->extension ?? null"
                  :file="!empty($setting['organization_chart'][0]) ? $setting['organization_chart'][0] : null"
                  :path="!empty($organization_chart_path) ? asset('/storage/' . $organization_chart_path) : null"></x-upload>
        <div wire:loading wire:target="setting.organization_chart.0">
            {{ __('names.uploading') }}...
        </div>
        @error('setting.organization_chart.0')
        <div class="message mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group mb-2   @error('setting.main_description.ar') is-invalid @enderror ">
        <x-input-label :value="__('names.main-page-description')" lang="ar" :required="true"></x-input-label>
        <x-textarea wire:model.lazy="setting.main_description.ar" :required="false"
                    placeholder="{{ __('names.main-page-description') }}"></x-textarea>
        @error('setting.main_description.ar')
        <div class="message">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group mb-2   @error('setting.main_description.en') is-invalid @enderror ">
        <x-input-label :value="__('names.main-page-description')" lang="en" :required="true"></x-input-label>
        <x-textarea wire:model.lazy="setting.main_description.en" :required="false"
                    placeholder="{{ __('names.main-page-description') }}"></x-textarea>
        @error('setting.main_description.en')
        <div class="message">{{ $message }}</div>
        @enderror
    </div>
    <br>
    <br>
    <br>
    <br>
    <button type="button" class="btn btn-primary"
            wire:click.prevent="save()">{{ __('names.save') }}
    </button>
</div>
