<div>
    <h2>{{ __('message.'.$title,['model' => __('names.user')]) }}</h2>
    <form method="POST" action="#" wire:submit.prevent="save" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">

                <div class="form-group mb-2 @error('name') is-invalid @enderror">
                    <x-input-label :value="__('names.name')" :required="true"></x-input-label>
                    <x-text-input type="text" wire:model.lazy="name" :required="true" name="name" disabled
                                  placeholder="{{ __('names.name') }}"></x-text-input>
                    @error('name')
                    <div class="message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            {{--            <div class="col-md-6">--}}
            {{--                <div class="form-group mb-2 @error('phone') is-invalid @enderror">--}}
            {{--                    <x-input-label :value="__('names.phone-number')" :required="true"></x-input-label>--}}
            {{--                    <x-text-input type="number" wire:model.lazy="phone" :required="true" name="phone"--}}
            {{--                                  placeholder="{{ __('names.phone-number') }}"></x-text-input>--}}
            {{--                    @error('phone')--}}
            {{--                    <div class="message">{{ $message }}</div>--}}
            {{--                    @enderror--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="col-md-6">
                <div class="form-group mb-2 @error('role_id') is-invalid @enderror">
                    <x-input-label :value="__('names.role')" :required="true"></x-input-label>

                    <x-select :options="$roles"  model="role_id" id="role" class="country-select " placeholder="role"
                              name="role_id" >
                    </x-select>
                    @error('role_id')
                    <div class="message">{{ $message }}</div>
                    @enderror

                </div>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 ">
                <button type="submit" class="btn btn-{{$color}}">
                    {{ __('names.'.$button) }}
                </button>
            </div>
        </div>
    </form>
</div>

