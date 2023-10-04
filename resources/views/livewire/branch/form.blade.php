<div>
    <h2>{{ __('message.' . $title, ['model' => __('names.branch')]) }} </h2>
    <form method="POST" action="#" wire:submit.prevent="save">
        @csrf
        <input type="submit" wire:click.prevent="" class="d-none">


        <button type="button" class="btn btn-primary light w-100 arrow-btn collapsed my-2" data-bs-toggle="collapse"
            data-bs-target="#branch-info" aria-expanded="true">
            {{ __('names.branch-information') }}
            <i class="bx bx-sm bx-plus-circle"></i>
        </button>

        <div wire:ignore.self class="collapse section light mb-2" id="branch-info" style="">
            <div class="row">
                <div class="col-md-6">
                    <x-input-label :value="__('names.branch-name')"></x-input-label>
                    <input type="text" class="form-control @error('branch.name') is-invalid @enderror"
                        wire:model.lazy="branch.name" name="name">
                    @error('branch.name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-input-label :value="__('names.type')"></x-input-label>

                        <select class=" form-control @error('branch.type') is-invalid @enderror"
                            wire:model.lazy="branch.type">
                            <option value=""> {{ __('message.select', ['model' => __('names.type')]) }}
                            </option>
                            @foreach ($types as $ty)
                                <option value="{{ $ty }}">{{ __('names.' . $ty) }}</option>
                            @endforeach
                        </select>
                        @error('branch.type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2   {{ $type != 'central' ? 'd-block' : 'd-none' }}">
                        <x-input-label :value="__('names.parent_branch')"></x-input-label>
                        <select class="form-control @error('branch.parent_id') is-invalid @enderror"
                            wire:model.lazy="branch.parent_id">
                            <option value="">
                                {{ __('message.select', ['model' => __('names.parent_branch')]) }}
                            </option>
                            @foreach ($mainBranches as $mainBranch)
                                <option value="{{ $mainBranch->id }}">{{ $mainBranch->name }}</option>
                            @endforeach
                        </select>
                        @error('branch.parent_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-input-label :value="__('names.country')"></x-input-label>

                        <select class=" form-control @error('country_id') is-invalid @enderror"
                            wire:model.lazy="country_id">
                            <option value=""> {{ __('message.select', ['model' => __('names.country')]) }}
                            </option>
                            @foreach ($countries as $key => $country)
                                <option value="{{ $country }}"> {{ $key }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-input-label :value="__('names.city')"></x-input-label>

                        <select class=" form-control @error('branch.city_id') is-invalid @enderror"
                            wire:model.lazy="branch.city_id">
                            <option value=""> {{ __('message.select', ['model' => __('names.city')]) }}
                            </option>
                            @foreach ($cities as $key => $city)
                                <option value="{{ $key }}"> {{ $city }}</option>
                            @endforeach
                        </select>
                        @error('branch.city_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-input-label :value="__('names.email')"></x-input-label>
                        <input type="email" class="form-control @error('branch.email') is-invalid @enderror"
                            wire:model.lazy="branch.email" name="email">
                        @error('branch.email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-input-label :value="__('names.phone')"></x-input-label>
                        <input type="text" class="form-control @error('branch.phone') is-invalid @enderror"
                            wire:model.lazy="branch.phone" name="phone">
                        @error('branch.phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-input-label :value="__('names.manager')"></x-input-label>
                        <select wire:model.lazy="branch.manager_id" class="form-select">
                            <option value="">{{ __('message.select',['model'=>__('names.manager')]) }}</option>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->user_id }}"
                                    {{ !empty($branch) && (is_array($branch) ? array_key_exists('manager_id', $branch) : $branch->manager_id ) && $manager->user_id == $branch['manager_id'] ? 'selected' : '' }}>
                                    {{ $manager->first_name . ' ' . $manager->second_name . ' ' . $manager->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('branch.manager_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>



        <button type="button" class="btn btn-primary light w-100 arrow-btn collapsed my-2 mb-2"
            data-bs-toggle="collapse" data-bs-target="#branch-settings" aria-expanded="true">
            {{ __('names.branch-setting') }}
            <i class="bx bx-sm bx-plus-circle"></i>
        </button>

        <div wire:ignore.self class="collapse section light mb-2" id="branch-settings" style="">
            <div class="row">
                <div class="col-md-6">
                    <div
                        class="form-group form-control @error('branch.latitude') is-invalid @enderror @error('branch.longitude') is-invalid @enderror mb-2">
                        <x-input-label :value="__('names.location')"></x-input-label>
                        <button type="button" class="btn btn-primary btn-block w-100" data-bs-toggle="collapse"
                            data-bs-target="#mapContainer" aria-expanded="true">
                            <i class="bx bx-map-pin"></i>
                            @if (isset($branch))
                                @if (gettype($branch) == 'array' && array_key_exists('address', $branch))
                                    {{ $branch['address'] }}
                                @elseif(gettype($branch) == 'object' && $branch->address != null)
                                    {{ $branch->address }}
                                @else
                                    {{ __('names.choose-address') }}
                                @endif
                            @else
                                {{ __('names.choose-address') }}
                            @endif
                        </button>
                        @error('branch.latitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('branch.longitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <x-input-label :value="__('names.attendance')"></x-input-label>
                    <br>
                    <select class="form-select @error('branch.shift_id') is-invalid @enderror" name="attendance"
                        wire:model.lazy="branch.shift_id">
                        <option>
                            {{ __('names.select') }}
                        </option>
                        @foreach ($shifts as $key => $shift)
                            <option value="{{ $shift }}">
                                {{ $key }}
                            </option>
                        @endforeach
                    </select>
                    @error('branch.shift_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-2 mb-2 loading">
                    <div class="collapse " id="mapContainer">
                        <div wire:ignore id="map" style="width: 100%; height:250px"></div>
                    </div>

                    <div wire:loading wire:target="updateLatAndLong">
                        <div class="loader-cotnainer">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary light w-100 arrow-btn collapsed my-2 mb-2"
            data-bs-toggle="collapse" data-bs-target="#formal-settings" aria-expanded="true">
            {{ __('names.formal-papers') }}
            <i class="bx bx-sm bx-plus-circle"></i>
        </button>

        <div wire:ignore.self class="collapse section light mb-2" id="formal-settings" style="">
            <div class="table-holder">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#paper">
                            <i class="bx bx-plus-circle bx-sm"></i>

                            {{ __('message.add', ['model' => __('names.branch-paper')]) }}
                        </button>
                    </div>
                </div>

                <hr>

                <x-table>
                    <thead>
                        <th>
                            #
                        </th>
                        <th>
                            {{ __('names.name') }}
                        </th>
                        <th>
                            {{ __('names.end-date') }}
                        </th>
                        <th>
                            {{ __('names.notification-date') }}
                        </th>
                        <th>
                            {{ __('names.file') }}
                        </th>
                        <th>
                            {{ __('names.setting') }}
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($papers as $key => $paper)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    {{ isset($paper->official) ? $paper->official->name : $paper['official_paper_id'] }}
                                </td>
                                <td>
                                    {{ $paper['finish_date'] }}
                                </td>
                                <td>
                                    {{ $paper['notification_date'] }}
                                </td>
                                <td>
                                    <a href="{{ asset('/storage/' . $paper['attachment']) }}" download="">
                                        <i class="bx bx-download"></i>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger"
                                        wire:click="deletePaper('{{ $paper['official_paper_id'] }}', '{{ $key }}')">
                                        {{ __('names.delete') }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </div>
        </div>


        <input type="submit" class="btn btn-primary mt-4 w-100" value="{{ __('names.save') }}">
    </form>



    @livewire('paper-modal', ['modal_id' => 'paper', 'title_in' => __('names.paper')], key(rand(99, 999999)))
    @livewire('map-modal', ['modal_id' => 'map', 'title_in' => __('names.map')], key(rand(99, 999999)))

</div>
@push('script')
    <script>
        window.addEventListener('load', function() {
            loadGoogleMaps();
        });

        function initMap() {
            const mapOptions = {
                center: {
                    lat: 0,
                    lng: 0
                },
                zoom: 2
            };

            const map = new google.maps.Map(document.getElementById('map'), mapOptions);

            let marker = new google.maps.Marker({
                position: {
                    lat: parseFloat("{{ $branch->latitude ?? 30.03 }}"),
                    lng: parseFloat("{{ $branch->longitude ?? 31.23 }}")
                },
                map: map
            });

            map.setZoom(10);
            map.panTo(marker.position);
            map.addListener('click', function(event) {
                if (marker) {
                    marker.setMap(null);
                }

                const clickedLocation = event.latLng;
                const lat = clickedLocation.lat();
                const lng = clickedLocation.lng();

                marker = new google.maps.Marker({
                    position: clickedLocation,
                    map: map
                });

                console.log('Latitude: ' + lat + ', Longitude: ' + lng);
                var message = lat + "-" + lng;

                $.get('https://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + ',' + lng +
                    '&key=AIzaSyBfjVre0paUOf4kvUNUPTNU3omF6iV-c5Q',
                    function(response) {
                        Livewire.emit("updateAddress", response['results'][2]['formatted_address']);
                    });

                Livewire.emit("updateLatAndLong", message);

            });
        }

        // Asynchronously load the Google Maps API with callback
        function loadGoogleMaps() {
            const script = document.createElement('script');
            script.src =
                'https://maps.googleapis.com/maps/api/js?key=AIzaSyBfjVre0paUOf4kvUNUPTNU3omF6iV-c5Q&libraries=places&callback=initMap';
            script.defer = true;
            script.async = true;
            document.body.appendChild(script);
        }
    </script>
@endpush
