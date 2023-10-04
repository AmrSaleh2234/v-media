<div class="row">
    <div class="col-lg-8">
        <h3>{{ __('message.add',['model'=>__('names.university')]) }}</h3>

        <div class="section row">
            <div class="form-group col-md-6 mb-2   @error('name') is-invalid @enderror ">
                <x-input-label :value="__('names.university-name')" lang="en" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="name" :required="false" name="name"
                              placeholder="{{ __('names.university-name') }}"></x-text-input>
                @error('name')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2  col-md-6 @error('name_ar') is-invalid @enderror ">
                <x-input-label :value="__('names.university-name')" lang="ar" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="name_ar" :required="false" name="name"
                              placeholder="{{ __('names.university-name') }}"></x-text-input>
                @error('name_ar')
                    <div class="message">{{ $message }}</div>
                @enderror
            </div>

            <br>
            <button type="button" class="btn btn-primary w-100"
                    wire:click.prevent="save()">
                {{ __('names.'.$button) }}
            </button>
        </div>

    </div>
    <div class="col-lg-4">

    </div>
</div>
