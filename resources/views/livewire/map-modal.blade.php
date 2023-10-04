{{-- <div wire:ignore.self>
    <div wire:ignore.self class="modal fade" id="{{ $modal_id }}" tabindex="-1"
        aria-labelledby="{{ $modal_id }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>

    @push('script')
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBx1GmOXC3CLSgfvPNYpu0CEDItEMN3W0M&callback=initMap&v=weekly"
            defer></script>
        <script>
            function initMap() {
                const myLatlng = {
                    lat: -25.363,
                    lng: 131.044
                };
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 4,
                    center: myLatlng,
                });
                // Create the initial InfoWindow.
                let infoWindow = new google.maps.InfoWindow({
                    content: "Click the map to get Lat/Lng!",
                    position: myLatlng,
                });

                infoWindow.open(map);
                // Configure the click listener.
                map.addListener("click", (mapsMouseEvent) => {
                    // Close the current InfoWindow.
                    infoWindow.close();
                    // Create a new InfoWindow.
                    infoWindow = new google.maps.InfoWindow({
                        position: mapsMouseEvent.latLng,
                    });
                    infoWindow.setContent(
                        JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                    );
                    infoWindow.open(map);
                });
            }

            window.initMap = initMap;
        </script>
    @endpush
</div> --}}
<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
