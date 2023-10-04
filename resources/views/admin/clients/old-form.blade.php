<div class="row">

    <div class="col-md-12 mb-2">

        <div class="radio-control mt-2">
            <input type="radio" name="type"  id="radio1"
                   {{ isset($client) && $broker->type == "individual" ? 'checked' : '' }}
                   {{ !isset($client) && old('type') == "individual" ? 'checked' : '' }}
                   {{ !isset($client) && old('type') == null ? 'checked' : '' }} value="individual" />
            {{ __('names.individual') }}
            <input type="radio" name="type" id="radio2"
                   {{ isset($client) && $broker->type == "company" ? 'checked' : '' }}
                   {{ !isset($client) && old('type') == "company" ? 'checked' : '' }}  value="company"
                   class="mr-4" />
            {{ __('names.company') }}
        </div>
    </div>
        <div class="col-md-6 company" style="display: none;">
            <div class="form-group mb-2">
                <x-input-label :value="__('names.company-name')" :required="true"></x-input-label>
                <x-text-input :value="isset($client) ? $client->name : old('name')" :required="false" name="company_name"
                              placeholder="{{ __('names.company-name') }}"></x-text-input>
            </div>
        </div>
        <div class="col-md-6 company" style="display: none;">
            <div class="form-group mb-2">
                <x-input-label :value="__('names.register-number')" :required="true"></x-input-label>
                <x-text-input type="number" :value="isset($client) ? $client->register_number : old('register_number')" :required="false" name="register_number"
                              placeholder="{{ __('names.register-number') }}"></x-text-input>
            </div>
        </div>
        <div class="col-md-6 company" style="display: none;"    >
            <div class="form-group mb-2">
                <x-input-label :value="__('names.agent-name')" :required="true"></x-input-label>
                <x-text-input :value="isset($client) ? $client->agent_name : old('agent_name')" :required="false" name="agent_name"
                              placeholder="{{ __('names.agent-name') }}"></x-text-input>
            </div>
        </div>

       <div class="col-md-6 individual">
           <div class="form-group mb-2">
               <x-input-label :value="__('names.client-name')" :required="true"></x-input-label>
               <x-text-input :value="isset($client) ? $client->name : old('name')" :required="false" name="name"
                             placeholder="{{ __('names.client-name') }}"></x-text-input>
           </div>
       </div>
       <div class="col-md-6 individual" >
           <div class="form-group mb-2">
               <x-input-label :value="__('names.card-id')" :required="true"></x-input-label>
               <x-text-input type="number" :value="isset($client) ? $client->card_id : old('card_id')" :required="false" name="card_id"
                             placeholder="{{ __('names.card-id') }}"></x-text-input>
           </div>
       </div>
    <div class="col-md-6">
        <div class="form-group mb-2">
            <x-input-label :value="__('names.phone-number')" :required="true"></x-input-label>
            <x-text-input type="number" :value="isset($client) ? $client->phone : old('phone')" :required="true" name="phone"
                          placeholder="{{ __('names.phone-number') }}"></x-text-input>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2">
            <x-input-label :value="__('Email')" :required="true"></x-input-label>
            <x-text-input :value="isset($client) ? $client->email : old('email')" :required="true" name="email"
                          placeholder="{{ __('Email') }}"></x-text-input>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2">
            <x-input-label :value="__('Branch')" :required="true"></x-input-label>
            <x-select :options="$branches" class="country-select select select2" name="branch_id" :selected="$client->branch_id ??  old('branch_id')">
            </x-select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2">
            <x-input-label :value="__('names.broker')" :required="false"></x-input-label>
            <x-select :options="$brokers" class="country-select select select2" name="broker_id" :selected="$client->broker_id ?? old('broker_id')">
            </x-select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2">
            <x-input-label :value="__('names.letter-head')" :required="false"></x-input-label>
{{--           <x-textarea   name="letter_head" ></x-textarea>--}}
            <x-text-input :value="isset($client) ? $client->letter_head : old('letter_head')" :required="false" name="letter_head"
                          placeholder="{{ __('names.letter-head') }}"></x-text-input>
        </div>
    </div>
    <div class="col-md-6 individual">
        <div class="form-group mb-2">
            <x-input-label :value="__('names.card-image')" :required="false"></x-input-label>
{{--            @include('admin.layouts.forms.files.attachment')--}}
            @include('admin.employees.image', ['name' => 'card_image','model'=> $client ?? null])

        </div>
    </div>
    <div class="col-md-6 company" style="display: none;">
        <div class="form-group mb-2">
            <x-input-label :value="__('names.register-image')" :required="false"></x-input-label>
{{--                        @include('admin.layouts.forms.files.attachment')--}}

            @include('admin.employees.image', ['name' => 'register_image','model'=> $client ?? null])

        </div>
    </div>
</div>
    @include('admin.layouts.forms.buttons.form-save')
</div>


@section('after_foot')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var companies = document.querySelectorAll('.company');
            var individuals = document.querySelectorAll('.individual');
            var radioButtons = document.querySelectorAll('input[type=radio][name=type]');
            // Loop through the radio buttons and add a change event listener
            radioButtons.forEach(function(radioButton) {
                radioButton.addEventListener('change', function() {
                    if (this.value === 'individual') {
                        individuals.forEach(function(individual) {
                            individual.style.display = 'block';
                        });
                        companies.forEach(function(company) {
                            company.style.display = 'none';
                        });
                    } else {
                        individuals.forEach(function(individual) {
                            individual.style.display = 'none';
                        });
                        companies.forEach(function(company) {
                            company.style.display = 'block';
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
            $(".image-upload").on("change", function(event) {
                let file = event.target.files[0];
                let file_name = file.name;
                let size = file.size;
                let splited = file_name.split(".");
                let exet = splited[splited.length - 1];
                let name = $(this).attr("name");
                $("." + name + "_exet").html(exet.toUpperCase());
                $("." + name + "_exet").removeClass("d-none");
                $("." + name + "_icon").css("display", "none");
                let p_file_name = $("." + name + "_name").html(file_name);
                $("." + name + "_name").css('color', "#004693");
                let p_file_size = $("." + name + "_size").html((size / (1024 * 1024)).toFixed(2) + " MB");
                $("." + name + "_check").removeClass("d-none");

            });
        });
    </script>
@stop
