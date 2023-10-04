<div wire:ignore.self class="modal fade" id="JobGradeModal" tabindex="-1" aria-labelledby="JobGradeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="JobGradeModalLabel">{{ __('message.'.$title,['model' => __('names.job-grade')]) }}</h5>
                <a href="#" data-bs-dismiss="modal">
                    <i class='bx bx-x-circle bx-md'></i>
                </a>
            </div>
            <div class="modal-body">

                <form wire:submit.prevent="save">
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-6">
                            <x-input-label :value="__('names.grade')"></x-input-label>
                            <select wire:model.lazy="grade_id" name="grade_id" class="form-control form-select ">
                                <option
                                    value="">{{ __('message.select',['model' => __('names.'.__('grade'))]) }}</option>
                                @foreach($grades as $grade)
                                    <option value="{{$grade->id}}">{{ $grade->name}}</option>
                                @endforeach
                            </select>
                            @error('grade_id')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-input-label :value="__('names.job-type')"></x-input-label>
                            <select wire:model.lazy="job_type_id" name="job_type_id" class="form-control form-select ">
                                <option
                                    value="">{{ __('message.select',['model' => __('names.'.__('job-type'))]) }}</option>
                                @foreach($jobTypes as $jobType)
                                    <option value="{{$jobType->id}}">{{ $jobType->name}}</option>
                                @endforeach
                            </select>
                            @error('job_type_id')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <x-input-label :value=" __('names.salary')"></x-input-label>
                            <input type="number" class="form-control @error('salary') is-invalid @enderror"
                                   wire:model.lazy="salary" autocomplete="salary">

                            @error('salary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <x-input-label :value=" __('names.years')"></x-input-label>
                            <input type="number" class="form-control @error('years') is-invalid @enderror"
                                   wire:model.lazy="years" autocomplete="years">

                            @error('years')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        {{--                        <div class="col-md-6">--}}
                        {{--                            <x-input-label :value=" __('names.status')" ></x-input-label>--}}
                        {{--                            <select wire:model.lazy="active" name="active" class="form-control ">--}}
                        {{--                                <option--}}
                        {{--                                    value="">{{ __('message.select',['model' => __('names.'.__('status'))]) }}</option>--}}
                        {{--                                <option value="1">{{ __('names.active') }}</option>--}}
                        {{--                                <option value="0">{{ __('names.in-active') }}</option>--}}
                        {{--                            </select>--}}
                        {{--                            @error('active')--}}
                        {{--                            <small class="text-danger">{{ $message }}</small>--}}
                        {{--                            @enderror--}}
                        {{--                        </div>--}}

                        <div class="col-md-12">
                            <x-input-label :value=" __('names.certificates')"></x-input-label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('tags_query') is-invalid @enderror"
                                       wire:model.lazy="tags_query"
                                       placeholder="{{__('names.search' , ['model'=> __("names.certificate")])}}"
                                       autocomplete="tags_query">
                            </div>
{{--                            <div class="list-group" wire:loading wire:target="searchTags">--}}
{{--                                <div class="list-group-item">--}}
{{--                                    {{ __('message.loading',['model'=>__('names.tags')]) }}--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            @if(!empty($tags_query))

                                <div class="list-group" wire:loading.remove>
                                    @forelse($searchTags as $tag)
                                        <a href="#" wire:click.prevent="addTag({{$tag->id}})"
                                           class="list-group-item text-decoration-none">
                                            <div class="">{{$tag->name}}</div>
                                        </a>
                                    @empty
                                        <a href="#" wire:click.prevent="addTag()"
                                           class="list-group-item text-decoration-none">
                                            {{__('names.add')}}
                                        </a>
                                    @endforelse
                                </div>
                            @endif

                            @error('tags_query')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="">
                            @forelse($tags as $id => $name)
                                <span class="badge bg-primary ">
                                {{$name}}
                                <a href="#" class="badge text-bg-primary light"
                                   wire:click.prevent="removeTag({{$id}})">X</a>
                            </span>
                            @empty
                                {{ __('message.no-select',['model'=>__('names.certificate')]) }}
                            @endforelse
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary"
                        wire:click.pervent="close('{{ $modal_id }}')"
                        data-bs-dismiss="modal">{{ __('names.close') }}
                </button>

                <button type="button" class="btn btn-{{$color}}"
                        wire:click.pervent="save">{{ __('names.'.$button) }}
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script type="module">
        $(document).ready(function () {
            // $('#selectedTags').select2();

            $('#selectedTags').on('change', function (e) {
                @this.
                set('tagsId', $(this).val());
            });
        });
    </script>
@endpush

