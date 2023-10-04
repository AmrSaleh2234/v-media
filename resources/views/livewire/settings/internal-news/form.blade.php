<div>
    <section class="section">
        <h4>
            {{ __('message.add',['Model' => __('names.internal-news')]) }}
        </h4>
        <hr>
        <form method="post" wire:submit.prevent="save" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 form-group mb-4  @error('internal.title.ar') is-invalid @enderror">
                    <x-input-label :value="__('names.title')" lang="ar" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="internal.title.ar" :required="false" name="name"></x-text-input>
                    @error('internal.title.ar')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 form-group mb-4  @error('internal.title.en') is-invalid @enderror">
                    <x-input-label :value="__('names.title')" lang="en" :required="true"></x-input-label>
                    <x-text-input wire:model.lazy="internal.title.en" :required="false" name="name"></x-text-input>
                    @error('internal.title.en')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group mb-4  @error('internal.management_id') is-invalid @enderror">
                    <x-input-label :value="__('names.management')" lang="ar" :required="true"></x-input-label>
                    <select class="form-select" wire:model.lazy="internal.management_id">
                        <option value="">
                            {{ __('message.select',["Model" => __('names.management')]) }}
                        </option>

                        @foreach($managements as $key => $management)
                            <option value="{{ $key }}">
                                {{ $management }}
                            </option>
                        @endforeach
                    </select>
                    @error('internal.management_id')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 form-group mb-4  @error('internal.department_id') is-invalid @enderror">
                    <x-input-label :value="__('names.department')" lang="ar" :required="true"></x-input-label>
                    <select class="form-select" wire:model.lazy="internal.department_id">
                        <option value="">
                            {{ __('message.select',["Model" => __('names.department')]) }}
                        </option>
                        @foreach($departments as $key => $department)
                            <option value="{{ $key }}">
                                {{ $department }}
                            </option>
                        @endforeach
                    </select>
                    @error('internal.department_id')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 form-group mb-4  @error('internal.attachment') is-invalid @enderror">
                    <x-input-label :value="__('names.attachment')" lang="ar" :required="true"></x-input-label>
                     <x-upload model="internal.attachment" 
                              :file=" !empty($internal) && array_key_exists('attachment', $internal) && gettype($internal['attachment']) != 'string' ? $internal['attachment'] : null" 
                              :path=" !empty($internal) && array_key_exists('attachment', $internal) && gettype($internal['attachment']) == 'string' ? url('/storage/' . $internal['attachment']) : null"></x-upload> 
                 
                    @error('internal.attachment')
                        <div class="message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2 form-group mb-4 ">
                    <div class="form-check form-switch   ">
                        <label class="form-check-label" for="website">{{ __('names.active') }}</label>
                        <input class="form-check-input" wire:model="internal.active" type="checkbox" role="switch"
                            id="website">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-3">
                    <input type="submit" value="{{ __('names.save') }}"
                        class="btn btn-primary w-100" />
                </div>
            </div>
        </form>

    </section>
</div>
