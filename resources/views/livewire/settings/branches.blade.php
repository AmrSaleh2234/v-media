<div class="row ">
    <div class="col-md-6">

        <div class="row ">
            <div class="col-md-6">
                <h4>{{__('names.branch')}}</h4>
                <select name="branch_id" id="branch_id" wire:model="branch_id" class="form-select">
                    <option value="0">{{ __('names.all') }}</option>
                    @foreach($branches as $key => $name)
                        <option value="{{$key}}" @if($key == optional($branch)->id) selected @endif >{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <h4>{{__("names.status")}}</h4>
                <select wire:model="status" class="form-select">
                    <option value="1">{{ __('names.active') }}</option>
                    <option value="0">{{ __('names.in-active') }}</option>
                </select>
            </div>
        </div>

    </div>
    <div class="row my-2">
        <div class="col-md-6">
            <div >
                <input type="checkbox" id="ch_1" wire:model="share_client" class="form-check-input mx-2" name="share_client">
                <label for="ch_1" class="form-check-label">
                    {{ __('names.share_client') }}
                </label>
            </div>
            <div>
                <input type="checkbox" id="ch_2" wire:model="share_service" class="form-check-input mx-2" name="share_service"><label for="ch_2">
                    {{ __('names.share_service') }}
                </label>
            </div>
            <div>
                <input type="checkbox" id="ch_3" wire:model="share_paper" class="form-check-input mx-2" name="share_paper">
                <label for="ch_3">
                    {{ __('names.share_paper') }}
                </label>
            </div>
            <div><input type="checkbox" id="ch_4" wire:model="share_shift" class="form-check-input mx-2" name="share_shift"><label for="ch_4">
                    مشاركة
                    {{ __('names.share_paper') }}
                </label>
            </div>
            <div><input type="checkbox" id="ch_5" wire:model="share_manager" class="form-check-input mx-2" name="share_manger">
                <label for="ch_5 ">
                    {{ __('names.share_manager') }}
                </label>
            </div>

            <button type="button" class="btn btn-primary mt-2" wire:click="save">{{ __('names.save') }}</button>
        </div>
    </div>
</div>


