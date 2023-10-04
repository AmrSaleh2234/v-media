<div class="row">
    <div class="col-lg-8">
        <h3>{{ __('message.add',['model'=>__('names.city')]) }}</h3>

        <div class="section row">
            <div class="form-group col-md-6 mb-2 @error('country_id') is-invalid @enderror">
                <x-input-label :value="__('names.country')" :required="true"></x-input-label>
                <x-select :options="$countries" model="country_id" placeholder="country" id="branch"
                               class="country-select "
                               name="country_id">
                </x-select>
                @error('country_id')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2 col-md-6 @error('state_id') is-invalid @enderror">
                <x-input-label :value="__('names.state')" :required="true"></x-input-label>
                <select wire:model="state_id" class="form-select" >
                    <option value="">{{ __('message.select',['model'=>__("names.state")]) }}</option>
                    @foreach($states as $id => $state)
                        <option value="{{$id}}" @if($city?->state_id == $id ) selected @endif>{{ $state }}</option>
                    @endforeach
                </select>
                @error('state_id')
                <div class="message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-2   @error('name') is-invalid @enderror ">
                <x-input-label :value="__('names.city-name')"  :required="true"></x-input-label>
                <x-text-input wire:model.lazy="name" :required="false" name="name"
                              placeholder="{{ __('names.city-name') }}"></x-text-input>
                @error('name')
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
