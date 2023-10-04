<div class="row">
    <div class="col-lg-8">
        <h3>{{ __('message.add',['model'=>__('names.category')]) }}</h3>

        <div class="section row">
            <div class="form-group col-md-6 mb-2   @error('name') is-invalid @enderror ">
                <x-input-label :value="__('names.category-name')" lang="ar" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="name" :required="false" name="name"
                              placeholder="{{ __('names.category-name') }}"></x-text-input>
                @error('name')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2  col-md-6 @error('name_en') is-invalid @enderror ">
                <x-input-label :value="__('names.category-name')" lang="en" :required="true"></x-input-label>
                <x-text-input wire:model.lazy="name_en" :required="false" name="name"
                              placeholder="{{ __('names.category-name') }}"></x-text-input>
                @error('name_en')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2 col-md-6 @error('type') is-invalid @enderror">
                <x-input-label :value="__('names.type')" :required="true"></x-input-label>
                <select wire:model="type" class="form-select" >
                    <option value="">{{ __('message.select',['model'=>__("names.type")]) }}</option>
                    @foreach($types as $type)
                        <option value="{{$type}}">{{ __('names.'.$type) }}</option>
                    @endforeach
                </select>
                @error('type')
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
