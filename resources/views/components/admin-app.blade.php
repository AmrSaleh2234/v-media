<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('admin.inc._head')
</head>

<body>
    <div id="app" class="layout">
        {{ havePermissionTo('123') }}
        @include('admin.inc._side')
        <div class="body-container">
            @include('admin.inc._navbar')
            <main class="main-view">
                {{ $slot }}
            </main>
            <div class="icon-circuit-board"></div>
        </div>
    </div>

    <script type="module">
        // // Get a reference to the file input element
        // const fileInputs = document.querySelectorAll('input[type="file"]');
        // fileInputs.forEach(function (fileInput){
        //     FilePond.create(fileInput);
        // });

        // function toggleLog() {
        //
        // }

        window.addEventListener('toastr', event => {
            toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
                'timeOut': 10000
            }
        });
        window.addEventListener('closeModal', (event) => {
            // console.log(event.detail.id);
            var myModalEl = document.getElementById(event.detail.id);
            var myModal = bootstrap.Modal.getInstance(myModalEl);
            myModal.hide();
        });

        window.addEventListener('showDeleteConfirmation', event => {
            Swal.fire({
                title: '{{ __('message.sure') }}',
                text: '{{ __('message.delete-warn') }}',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: '{{ __('names.cancel') }}',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#004693',
                confirmButtonText: '{{ __('message.delete-confirm') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('confirmDelete', event.detail.id);
                }
            });
        });

        window.addEventListener('closeModal', (event) => {
            // console.log(event.detail.id);
            var myModalEl = document.getElementById(event.detail.id);
            var myModal = bootstrap.Modal.getInstance(myModalEl);
            myModal.hide();
        });


        window.addEventListener('openModal', (event) => {
            // console.log(event.detail.id);
            var myModalEl = document.getElementById(event.detail.id);
            var myModal = bootstrap.Modal.getInstance(myModalEl);
            myModal.show();
        });

        window.addEventListener('showDeleteConfirmation', event => {
            Swal.fire({
                title: '{{ __('message.sure') }}',
                text: '{{ __('message.delete-warn') }}',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: '{{ __('names.cancel') }}',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#004693',
                confirmButtonText: '{{ __('message.delete-confirm') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('confirmDelete', event.detail.id);
                }
            });
        });

        // window.addEventListener('initMap', event => {
        //     loadGoogleMaps();
        // });

        // function initMap() {
        //     const mapOptions = {
        //         center: {
        //             lat: 0,
        //             lng: 0
        //         },
        //         zoom: 2
        //     };

        //     const map = new google.maps.Map(document.getElementById('map'), mapOptions);

        //     let marker = new google.maps.Marker();

        //     map.addListener('click', function(event) {
        //         if (marker) {
        //             marker.setMap(null);
        //         }


        //         const clickedLocation = event.latLng;
        //         const lat = clickedLocation.lat();
        //         const lng = clickedLocation.lng();

        //         marker = new google.maps.Marker({
        //             position: clickedLocation,
        //             map: map
        //         });

        //         console.log('Latitude: ' + lat + ', Longitude: ' + lng);
        //         var message = lat + "-" + lng;
        //         Livewire.emit("updateLatAndLong", message);

        //     });
        // }

        // // Asynchronously load the Google Maps API with callback
        // function loadGoogleMaps() {
        //     const script = document.createElement('script');
        //     script.src =
        //         'https://maps.googleapis.com/maps/api/js?key=AIzaSyBfjVre0paUOf4kvUNUPTNU3omF6iV-c5Q&libraries=places&callback=initMap';
        //     script.defer = true;
        //     script.async = true;
        //     document.body.appendChild(script);
        // }
    </script>


    <livewire:scripts />
    @stack('script')

</body>

</html>


{{-- <div id="toast-container" class="toast-top-right"> --}}
{{--    <div class="toast toast-success" aria-live="polite" style="display: block;"> --}}
{{--        <div class="toast-message">تم إضافة نوع الوظيفة بنجاح</div> --}}
{{--    </div> --}}
{{-- </div> --}}
