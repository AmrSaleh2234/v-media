@if (isset($dues) && $dues != null && gettype($dues) == 'array')
    <div class="row">
        @foreach ($dues as $key => $due)
            <div class="col-md-12">

                <div class="row p-0 m-0">
                    <div class="col-md-3">
                        <p class="data-titel"style="display:inline-block">
                            <input disabled type="checkbox" checked />
                            <span class="data-content">
                                {{ __('names.' . $key) }}
                            </span>
                        </p>
                    </div>

                    @if (gettype($due) == 'array')
                        @foreach ($due as $i => $value)
                            @if (gettype($value) == 'boolean' && $value != false)
                                <div class="col-md-2">
                                    <input disabled type="checkbox" {{ $value == true ? 'checked' : '' }} />
                                    <span class="data-content">
                                        {{ __('names.' . $i) }}
                                    </span>
                                </div>
                            @elseif(gettype($value) == 'double' || (gettype($value) == 'string' && $value != false))
                                <div class="col-md-2">
                                    <p class="data-titel">



                                        {{ __('names.' . $i) }}


                                    </p>
                                    <p>
                                        <b>
                                            {{ $value }}
                                        </b>
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
                <div class="splitter mt-1 mb-4" style="width: 100%; background-color:#004693; height: 1px;"></div>
                <div class="clearfix"></div>

            </div>
        @endforeach
    </div>
@endif
