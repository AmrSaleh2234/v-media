<div>
    <h2>{{ __('message.'.$title,['model' => __('names.broker')]) }}</h2>
    <form method="POST" action="#" wire:submit.prevent="save" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-2 @error('name') is-invalid @enderror">
                    <x-input-label :value="__('names.broker-name')" :required="true"></x-input-label>
                    <x-text-input type="text" wire:model.lazy="name" :required="true" name="name"
                                  placeholder="{{ __('names.broker-name') }}"></x-text-input>
                    @error('name')
                    <div class="message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2 @error('phone') is-invalid @enderror">
                    <x-input-label :value="__('names.phone-number')" :required="true"></x-input-label>
                    <x-text-input type="number" wire:model.lazy="phone" :required="true" name="phone"
                                  placeholder="{{ __('names.phone-number') }}"></x-text-input>
                    @error('phone')
                    <div class="message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
            <div class="row mb-2">


            <div class="col-md-6 ">
                <x-input-label :value="__('names.accounting-method')" :required="true"></x-input-label>
                <div class="radio-control mt-2 d-flex">
                    <input type="radio" name="accounting_method" class="mx-2" wire:model="accounting_method" value="1"/>
                    {{ __('names.percent-from-project') }}
                    <input type="radio" name="accounting_method" class="mx-2" wire:model="accounting_method" value="0" class="mr-4"/>
                    {{ __('names.amount-from-project') }}
                </div>
            </div>
                @if($accounting_method )
                    <div class="col-md-6">
                        <div class="form-group mb-2 @error('percentage') is-invalid @enderror">
                            <x-input-label :value="__('names.percent-from-project')" :required="true"></x-input-label>
                            <x-text-input type="number" wire:model.lazy="percentage" :required="true" name="percentage"
                                          placeholder="{{ __('names.percent-from-project') }}"></x-text-input>
                            @error('percentage')
                            <div class="message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endif


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

