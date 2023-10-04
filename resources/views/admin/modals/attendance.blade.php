<!-- Modal -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach (weekDays() as $key => $value)
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    {{-- <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="day[]"
                                            value="{{ $value }}">

                                        <x-input-label class="form-check-label" :value="__($value)"></x-input-label>

                                    </div> --}}
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Default checkbox
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <select class="form-control" name="start[]">
                                        @foreach (hourType() as $hour)
                                            <option value="{{ $hour }}">
                                                {{ $hour }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="end[]">
                                        @foreach (hourType() as $hour)
                                            <option value="{{ $hour }}">
                                                {{ $hour }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('names.cancel') }}
                </button>
                <button type="button" class="btn btn-primary">
                    {{ __('names.save') }}
                </button>
            </div>
        </div>
    </div>
</div>
