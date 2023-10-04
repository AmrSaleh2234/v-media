@if (env('APP_DEBUG') && isset($logs))
    <div class="log-button"
         onclick=' (document.getElementById("logContainer").classList.contains("show")) ? document.getElementById("logContainer").classList.remove("show") : document.getElementById("logContainer").classList.add("show")'>
        <button class="btn btn-danger p-1 btn-icon rounded-5"><i class='bx bxl-blogger bx-sm'></i></button>
    </div>
    <div class="log-container" id="logContainer" dir="ltr">

        @forelse($logs as $log)
            <div class="card mb-2 w-100"  style="width: 18rem; ">
                <div class="card-header">
                    {{$log->log_name}}
                    <small class="text-primary">{{$log->description}}</small>
                </div>
                <div class="card-body">
                    <h5 class="card-title">By {{ $log->causer_type }} with ID {{ $log->causer_id }} </h5>
                    <p class="card-text">{{ print_r($log->properties) }}</p>
                    <span class="badge bg-primary">{{ $log->event }}</span>
                    <small class="text-info">{{$log->updated_at}}</small>

                </div>
            </div>
        @empty
            <p>No Logs For This Model</p>
        @endforelse
    </div>
@endif
