<div>
    <h2>{{ __('message.'.$title,['model' => __('names.client')]) }}</h2>
    <form method="POST" action="#" wire:submit.prevent="save" enctype="multipart/form-data">
        @csrf
        <div class="row">


            <div class="col-md-12 mb-2">

                <div class="radio-control mt-2">
                    <input type="radio" name="type" wire:model="type" value="individual"/>
                    {{ __('names.individual') }}
                    <input type="radio" name="type" wire:model="type" value="company" class="mr-4"/>
                    {{ __('names.company') }}
                </div>
            </div>
            @if($type == 'individual')
                <div class="col-md-6 ">
                    <div class="form-group mb-2   @error('name') is-invalid @enderror ">
                        <x-input-label :value="__('names.client-name')" :required="true"></x-input-label>
                        <x-text-input wire:model.lazy="name" :required="false" name="name"
                                      placeholder="{{ __('names.client-name') }}"></x-text-input>
                        @error('name')
                        <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="form-group mb-2 @error('card_id') is-invalid @enderror">
                        <x-input-label :value="__('names.card-id')" :required="true"></x-input-label>
                        <x-text-input type="number" wire:model.lazy="card_id" :required="false" name="card_id"
                                      placeholder="{{ __('names.card-id') }}"></x-text-input>
                        @error('card_id')
                        <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @elseif($type == 'company')
                <div class="col-md-6 ">
                    <div class="form-group mb-2 @error('company_name') is-invalid @enderror">
                        <x-input-label :value="__('names.company-name')" :required="true"></x-input-label>
                        <x-text-input wire:model.lazy="company_name" :required="false" name="company_name"
                                      placeholder="{{ __('names.company-name') }}"></x-text-input>
                        @error('company_name')
                        <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="form-group mb-2 @error('register_number') is-invalid @enderror">
                        <x-input-label :value="__('names.register-number')" :required="true"></x-input-label>
                        <x-text-input type="number" wire:model.lazy="register_number" :required="false"
                                      name="register_number"
                                      placeholder="{{ __('names.register-number') }}"></x-text-input>
                        @error('register_number')
                        <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="form-group mb-2 @error('agent_name') is-invalid @enderror">
                        <x-input-label :value="__('names.agent-name')" :required="true"></x-input-label>
                        <x-text-input wire:model.lazy="agent_name" :required="false" name="agent_name"
                                      placeholder="{{ __('names.agent-name') }}"></x-text-input>
                        @error('agent_name')
                        <div class="message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endif

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
            <div class="col-md-6">
                <div class="form-group mb-2 @error('email') is-invalid @enderror">
                    <x-input-label :value="__('Email')" :required="false"></x-input-label>
                    <x-text-input wire:model.lazy="email" :required="false" name="email"
                                  placeholder="{{ __('names.email') }}"></x-text-input>
                    @error('email')
                    <div class="message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2 @error('branch_id') is-invalid @enderror">
                    <x-input-label :value="__('Branch')" :required="true"></x-input-label>
                    {{--                <x-input.select2 :options="$branches" wire:ignore id="branch" wire:model.lazy="branch_id" class="country-select " >--}}
                    {{--                </x-input.select2>--}}

                    <x-select :options="$branches" model="branch_id" id="branch" class="country-select "
                              name="branch_id" >
                    </x-select>
                    @error('branch_id')
                    <div class="message">{{ $message }}</div>
                    @enderror
                    {{--                <x-input.select2 id="filter-student-status" class="select2"  wire:model.defer="branch_id" >--}}
                    {{--                    @foreach($branches as $key => $status)--}}
                    {{--                        <option value="{{ $key }}">{{ $status }}</option>--}}
                    {{--                    @endforeach--}}
                    {{--                </x-input.select2>--}}

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2 @error('broker_id') is-invalid @enderror">
                    <x-input-label :value="__('names.broker')" :required="false"></x-input-label>
                    <x-select :options="$brokers" model="broker_id" id="broker"
                              class="country-select select select2" name="broker_id">
                    </x-select>
                    @error('broker_id')
                    <div class="message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2 @error('letter_head') is-invalid @enderror">
                    <x-input-label :value="__('names.letter-head')" :required="false"></x-input-label>
                    {{--           <x-textarea   name="letter_head" ></x-textarea>--}}
                    <x-text-input wire:model.lazy="letter_head" :required="false" name="letter_head"
                                  placeholder="{{ __('names.letter-head') }}"></x-text-input>
                    @error('letter_head')
                    <div class="message">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-6 " @if($type == 'company') style="display: none" @endif>
                <div class="form-group mb-2 @error('card_image') is-invalid @enderror">
                    <x-input-label :value="__('names.card-image')" :required="false"></x-input-label>
                    <input type="file" wire:model.lazy="card_image" name="card_image"/>
                    {{--                <x-input.filepond preview="true"   wire:model="card_image" />--}}
                    @error('card_image')
                    <div class="message">{{ $message }}</div>
                    @enderror
                    @if ($client && $card_image_path)
                        Photo Preview:
                        <img width="400" src="{{ asset('storage/'.$card_image_path) }}">
                    @endif
                </div>
            </div>


            <div class="col-md-6 " @if($type == 'individual') style="display: none" @endif>
                <div class="form-group mb-2 @error('register_image') is-invalid @enderror">
                    <x-input-label :value="__('names.register-image')" :required="false"></x-input-label>
                    <input type="file" wire:model.lazy="register_image" name="register_image"/>
                    @error('register_image')
                    <div class="message">{{ $message }}</div>
                    @enderror
                    {{--                <x-input.filepond   wire:model="register_image" />--}}
                    @if ($client && $register_image_path)
                        Photo Preview:
                        <img src="{{ asset('storage/'.$register_image_path) }}">
                    @endif
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

