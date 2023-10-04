<div>
    <div class="row">
        <div class="col-md-8">
            <h4>
                {{ __('names.employee-request-data') }}
            </h4>
            <p>
                <b>
                    {{ __('names.code') }} : {{ $employeeRequest->id }}
                </b>
            </p>
        </div>
        <div class="col-md-4">
            <h4>
                {{ __('names.status') }} :

                <button class="btn btn-primary status  btn-icon {{ $employeeRequest->status?->color }}"
                    data-bs-toggle="modal" data-bs-target="#changeStatus"
                    @if ($employeeRequest->status?->name == 'resolved') disabled @endif>
                    @if ($employeeRequest->status)
                        {{ __('names.' . $employeeRequest->status?->name) }}
                    @else
                        {{ __('message.select', ['model' => __('names.status')]) }}
                    @endif
                    <i class="bx bx-chevron-left "></i>
                </button>
            </h4>
        </div>
        <div class="col-md-12 mt-2">
            <div class="section">
                <p>
                    <b>
                        {{ __('names.type') }}
                    </b>
                    :
                    {{ __('names.' . $employeeRequest->type) }}
                </p>
                <p>
                    <b>
                        {{ __('names.name') }}
                    </b>
                    :
                    {{ $employeeRequest->employee->first_name . ' ' . $employeeRequest->employee->second_name . ' ' . $employeeRequest->employee->last_name }}
                </p>
                <p>
                    <b>
                        {{ __('names.responsible') }}
                    </b>
                    :
                    {{ $employeeRequest->responsible }}
                </p>
                <p>
                    <b>
                        {{ __('names.from') }}
                    </b>
                    :
                    {{ Carbon\Carbon::parse($employeeRequest->time_from)->timezone($timezone)->format('d-m-Y h:i A') }}
                </p>
                <p>
                    <b>
                        {{ __('names.to') }}
                    </b>
                    :
                    {{ $employeeRequest->time_to? Carbon\Carbon::parse($employeeRequest->time_to)->timezone($timezone)->format('d-m-Y h:i A'): '-' }}
                </p>
                <p>
                    <b>
                        {{ __('names.address') }}
                    </b>
                    :
                    {{ $employeeRequest->address }}
                </p>

                @if ($employeeRequest->type == 'overtime')
                    <p>
                        <b>
                            {{ __('names.reason') }}
                        </b>
                        :
                        {{ $employeeRequest->reason }}
                    </p>
                    <p>
                        <b>
                            {{ __('names.project-name') }}
                        </b>
                        :
                        {{ $employeeRequest->project_name }}
                    </p>
                @endif

            </div>
            {{--            <div class="mt-2"> --}}
            {{--                @if ($clientRequest->type == 'company') --}}
            {{--                    <x-upload :path="url('/storage/' . $clientRequest->register_image)"></x-upload> --}}
            {{--                @else --}}
            {{--                    <x-upload :path="url('/storage/' . $clientRequest->card_image)"></x-upload> --}}
            {{--                @endif --}}
            {{--            </div> --}}
        </div>
        @if ($employeeRequest->type == 'mission')
            <div class="col-md-12 mt-2">
                <section>
                    <h4>
                        {{ __('names.location') }}
                    </h4>
                    <div wire:ignore id="map" style="width: 100%; height:250px"></div>

                </section>

            </div>
        @endif
    </div>
    {{-- havePermissionTo('attendance.requests.changeStatus') --}}
    @if (true)
        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="changeStatus" tabindex="-1" aria-labelledby="changeStatusLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form wire:submit.prevent="save">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <x-input-label :value="__('names.status')"></x-input-label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" wire:model.lazy="employeeRequest.status_id">
                                        <option value="">
                                            {{ __('message.select', ['model' => __('names.status')]) }}
                                        </option>
                                        @foreach ($statues as $key => $status)
                                            <option value="{{ $key }}">
                                                {{ __('names.' . $status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employeeRequest.status_id')
                                        <span class="d-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <x-input-label :value="__('names.response')"></x-input-label>
                                    <textarea row="4" class="form-control"
                                        {{ $employeeRequest['status_id'] == $deniedId ? 'disabled readonly' : '' }}
                                        wire:model.lazy="employeeRequest.response"></textarea>
                                    @error('employeeRequest.response')
                                        <span class="d-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('names.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endif
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
                        lat: parseFloat("{{ $employeeRequest->latitude }}"),
                        lng: parseFloat("{{ $employeeRequest->longitude }}")
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
</div>
