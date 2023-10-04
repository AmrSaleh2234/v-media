<div class="row">
    @if (isset($broker))
        <input type="hidden" name="id" value="{{ $broker->id }}" />
    @endif
    <div class="col-md-6">
        <div class="form-group mb-2">
            <x-input-label :value="__('names.broker-name')" :required="true"></x-input-label>
            <x-text-input :value="isset($broker) ? $broker->name : old('name')" :required="true" name="name" placeholder="{{ __('names.broker-name') }}">
            </x-text-input>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-2">
            <x-input-label :value="__('names.phone-number')" :required="true"></x-input-label>
            <x-text-input :value="isset($broker) ? $broker->phone : old('phone')" :required="true" name="phone"
                placeholder="{{ __('names.phone-number') }}"></x-text-input>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check mb-2">
                    <x-input-label :value="__('names.accounting-method')" :required="true"></x-input-label>
                    <div class="radio-control mt-2">
                        <input type="radio" name="accounting_method"
                            {{ isset($broker) && $broker->accounting_method == 1 ? 'checked' : '' }}
                            {{ !isset($broker) && old('accounting_method') == 1 ? 'checked' : '' }}
                            {{ !isset($broker) && old('accounting_method') == null ? 'checked' : '' }} value="1" />
                        {{ __('names.precent-from-project') }}
                        <input type="radio" name="accounting_method"
                            {{ isset($broker) && $broker->accounting_method == 2 ? 'checked' : '' }}
                            {{ !isset($broker) && old('accounting_method') == 2 ? 'checked' : '' }} value="2"
                            class="mr-4" />
                        {{ __('names.amount-from-project') }}
                    </div>
                </div>
                <div class="form-group precent_div mt-2 mb-2"
                    style="display:{{ (isset($broker) && $broker->accounting_method == 1) || !isset($broker) ? 'block' : 'none' }}">
                    <x-input-label :value="__('names.precent-from-project')" :required="true"></x-input-label>
                    <x-text-input :value="isset($broker) ? $broker->precentage : old('precentage')" :required="true" :class="'precentage'" name="precentage"
                        placeholder="{{ __('names.precent-from-project') }}"></x-text-input>
                </div>
            </div>
        </div>
    </div>


    @include('admin.layouts.forms.buttons.form-save')
</div>

@section('after_foot')
    <script>
        $(document).ready(function() {

            var value = $('input[name="accounting_method"]').val();

            $('input[name="accounting_method"]').change(function() {
                var value = $(this).val();

                if (value == "1") {
                    $(".precent_div").show();
                    $('.precentage').prop('disabled', false);
                } else {
                    $(".precent_div").hide();
                    $('.precentage').prop('disabled', true);
                }
            });
        });
    </script>
@endsection
