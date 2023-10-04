<div>
    <form action="#" wire:submit.prevent="save" enctype="multipart/form-data">
        @csrf

        <section class="step 2">

            <br />

            <div>

                <div class="row">
                    <div class="col-12 mt-2 mb-1">
                        <h5>{{ __('names.academic-info') }}</h5>
                    </div>

                    @foreach ($academic as $key => $grade)
                        <div
                            class="col-md-4 form-group mb-3 @error('academic.' . $key . '.university_id') is-invalid  @enderror">
                            <x-input-label :value="__('names.university_id')"></x-input-label>
                            <select
                                class="form-select form-control @error('academic.' . $key . '.university_id') is-invalid  @enderror"
                                wire:model="academic.{{ $key }}.university_id">
                                <option value="">
                                    {{ __('names.select', ['model' => __('names.university_id')]) }}
                                </option>
                                @foreach ($univs as  $uni)
                                    <option value="{{ $uni->id }}"
                                        {{ $uni->id == $academic[$key]['university_id'] ? 'selected' : '' }}>
                                        {{ $uni->name }}  {{ $uni->name_ar ?  '- ' . $uni->name_ar : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('academic.' . $key . '.university_id')
                                <div class="message mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div
                            class="col-md-4 form-group mb-3 @error('academic.' . $key . '.qualification') is-invalid  @enderror">
                            <x-input-label :value="__('names.qualification')"></x-input-label>
                            <input
                                class="form-control @error('academic.' . $key . '.qualification') is-invalid  @enderror"
                                wire:model='academic.{{ $key }}.qualification'
                                placeholder="{{ __('names.qualification') }}">
                            @error('academic.' . $key . '.qualification')
                                <div class="message mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div
                            class="col-md-4 form-group mb-3 @error('academic.' . $key . '.specialization') is-invalid  @enderror">
                            <x-input-label :value="__('names.specialization')"></x-input-label>
                            <input
                                class="form-control @error('academic.' . $key . '.specialization') is-invalid  @enderror "
                                wire:model="academic.{{ $key }}.specialization"
                                placeholder="{{ __('names.specialization') }}">
                            @error('academic.' . $key . '.specialization')
                                <div class="message mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div
                            class="col-md-4 form-group mb-3 @error('academic.' . $key . '.qualification_date') is-invalid  @enderror">
                            <x-input-label :value="__('names.qualification-date')"></x-input-label>
                            <input type="date"
                                class="form-control @error('academic.' . $key . '.qualification_date') is-invalid  @enderror"
                                wire:model="academic.{{ $key }}.qualification_date"
                                placeholder="{{ __('names.qualification_date') }}">
                            @error('academic.' . $key . '.qualification_date')
                                <div class="message mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <x-upload model="academic.{{ $key }}.qualification_photo" :path="$grade['qualification_photo'] != ''
                                ? url('/storage/' . $grade['qualification_photo'])
                                : null"
                                :file="gettype($academic[$key]['qualification_photo']) == 'string'
                                    ? null
                                    : $academic[$key]['qualification_photo']" :original_name="$employee->attachments?->where('type', 'acadmic_' . $key)->last()
                                    ?->original_name" :size="$employee->attachments?->where('type', 'acadmic_' . $key)->last()?->size"></x-upload>

                            <div wire:loading wire:target="academic.{{ $key }}.qualification_photo">
                                {{ __('names.uploading') }}...</div>

                            @error('academic.' . $key . '.qualification_photo')
                                <div class="text-danger mt-2">
                                    {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group mb-3">

                            @if (count($academic) - 1 == $key || count($academic) == 1)
                                <button type="button" wire:click="addMoreGrades()" class="btn btn-primary mr-2 mt-3">
                                    <i class="bx bx-plus-circle"></i> {{ __('names.add-more') }}
                                </button>
                            @endif
                            @if (count($academic) >= 2)
                                <button type="button"
                                    wire:click="deleteGrades('{{ $grade['id'] ?? null }}', '{{ $key }}')"
                                    class="btn btn-danger  mr-2 mt-3">
                                    <i class="bx bx-trash-alt"></i>
                                </button>
                            @endif
                        </div>
                    @endforeach

                    <div class="section mb-4">
                        <div class="row">
                            <div class="col-md-9">
                                <h5>{{ __('names.experiences') }}</h5>

                            </div>
                            <div class="col-md-3">
                                <button wire:click="open('addExperince',true)" type="button"
                                    class="btn btn-primary btn-sm w-100" data-bs-toggle="modal"
                                    data-bs-target="#addExperince">
                                    {{ __('names.add-experience') }}
                                </button>
                            </div>

                            <div class="col-md-12">
                                <table class="table table-borderless">
                                    <thead>
                                        <th> # </th>
                                        <th> {{ __('names.company-name') }} </th>
                                        <th> {{ __('names.job-name') }} </th>
                                        <th> {{ __('names.duration-from-to') }} </th>
                                        <th> {{ __('names.years') }} </th>
                                        <th> {{ __('names.certificate') }} </th>
                                        <th> {{ __('names.setting') }} </th>
                                    </thead>
                                    <tbody>
                                        @forelse ($experinces as $key=>$ex)
                                            <tr>
                                                <td>
                                                    {{ ++$key }}
                                                </td>
                                                <td>
                                                    {{ $ex['company_name'] }}
                                                </td>
                                                <td>
                                                    {{ $ex['job_name_id'] }}
                                                </td>
                                                <td>
                                                    {{ $ex['from_date'] . ' - ' . $ex['to_date'] }}
                                                </td>
                                                <td>
                                                    {{ $ex['no_of_years'] }}
                                                </td>
                                                <td>
                                                    @if (!array_key_exists('photo', $ex) || $ex['photo'] != '' || $ex['photo'] != null)
                                                        <a download=""
                                                            href="{{ url('storage/') . '/' . $ex['photo'] }}"
                                                            class="btn btn-link">
                                                            <i class="bx bx-image-alt"></i>
                                                        </a>
                                                    @else
                                                        <a href="#" class="text-danger">
                                                            <i class="bx bx-error-circle"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>


                                                    <div class="">
                                                        <div class=" limit-2">
                                                            <a data-bs-toggle="modal" data-bs-target="#addExperince"
                                                                type="button"
                                                                wire:click="EditExperince('{{ $key }}')"
                                                                class="px-1">
                                                                <i class='bx bxs-edit bx-sm text-gray'></i>
                                                            </a>
                                                            <a href="#" class="px-1"
                                                                wire:click="deleteExperince('{{ $ex['id'] }}')"
                                                                type="button">
                                                                <i class='bx bx-trash bx-sm text-danger'></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    {{ __('names.not-found') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="section ">

                        <div class="row">
                            <div class="col-md-9">
                                <h5>{{ __('names.courses') }}</h5>

                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal"
                                    data-bs-target="#addCourse">
                                    {{ __('names.add-course') }}
                                </button>
                            </div>

                            <div class="col-md-12 loading">

                                <table class="table table-borderless">
                                    <thead>
                                        <th> # </th>
                                        <th> {{ __('names.course-name') }} </th>
                                        <th> {{ __('names.duration') }} </th>
                                        <th> {{ __('names.course-from') }} </th>
                                        <th> {{ __('names.date') }} </th>
                                        <th> {{ __('names.certificate') }} </th>
                                        <th> {{ __('names.setting') }} </th>
                                    </thead>
                                    <tbody>
                                        @forelse ($courses as $key=>$co)
                                            <tr>
                                                <td>
                                                    {{ ++$key }}
                                                </td>
                                                <td>
                                                    {{ $co->name }}
                                                </td>
                                                <td>
                                                    {{ $co->duration }}
                                                </td>
                                                <td>
                                                    {{ $co->course_from }}
                                                </td>
                                                <td>
                                                    {{ $co->date }}
                                                </td>
                                                <td>
                                                    @if ($co->certificate_photo != '' || $co->certificate_photo != null)
                                                        <a download=""
                                                            href="{{ url('storage/') . '/' . $co->certificate_photo }}"
                                                            class="btn btn-link">
                                                            <i class="bx bx-image-alt"></i>
                                                        </a>
                                                    @else
                                                        <a href="#" class="text-danger">
                                                            <i class="bx bx-error-circle"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="">
                                                        <div class=" limit-2">
                                                            <a data-bs-toggle="modal" data-bs-target="#addCourse"
                                                                type="button"
                                                                wire:click="EditCourse('{{ $key }}')"
                                                                class="px-1">
                                                                <i class='bx bxs-edit bx-sm text-gray'></i>
                                                            </a>
                                                            <a href="#" class="px-1"
                                                                wire:click="deleteCourse('{{ $co['id'] }}')"
                                                                type="button">
                                                                <i class='bx bx-trash bx-sm text-danger'></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>

                                                <td colspan="7">
                                                    {{ __('names.not-found') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="col-8 mt-4"></div>
                    <div class="col-4 mt-4">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('admin.custom.create', ['employee_id' => $employee_id, 'step' => 1]) }}"
                                    class="btn btn-outline-{{ $color }} w-100">
                                    {{ __('names.prev') }}
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-{{ $color }} w-100">

                                    {{ __('names.next') }}

                                </button>
                            </div>
                        </div>

                    </div>
                </div>
        </section>

    </form>

    {{-- Modals :) --}}
    <div wire:ignore.self class="modal fade" id="addExperince" tabindex="-1" aria-labelledby="addExperinceLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg @if ($isloading) loading @endif">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addExperinceLabel">
                        {{ __('names.add-experience') }}
                    </h1>

                </div>
                <form action="#" wire:submit.prevent="addExperince" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3 @error('experince.company_name') is-invalid  @enderror">
                                    <x-input-label :value="__('names.company-name')"></x-input-label>
                                    <input class="form-control " wire:model='experince.company_name'
                                        placeholder="{{ __('names.company-name') }}">
                                    @error('company_name')
                                        <div class="message mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3 @error('experince.job_name_id') is-invalid  @enderror">
                                    <x-input-label :value="__('names.job-name')"></x-input-label>
                                    <select class="form-control form-select" wire:model='experince.job_name_id'>
                                        <option value="">
                                            {{ __('names.select', ['model' => __('names.job-name')]) }}
                                        </option>
                                        @foreach ($jobNames as $key => $jobName)
                                            <option value="{{ $key }}">
                                                {{ $jobName }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('job_name_id')
                                        <div class="message mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3 @error('experince.from_date') is-invalid  @enderror">
                                    <x-input-label :value="__('names.from')"></x-input-label>
                                    <input type="date" class="form-control " wire:model='experince.from_date'
                                        placeholder="{{ __('names.from-date') }}">
                                    @error('from_date')
                                        <div class="message mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3 @error('experince.to_date') is-invalid  @enderror">
                                    <x-input-label :value="__('names.to')"></x-input-label>
                                    <input type="date" class="form-control " wire:model='experince.to_date'
                                        placeholder="{{ __('names.to-date') }}">
                                    @error('to_date')
                                        <div class="message mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3 @error('experince.no_of_years') is-invalid  @enderror">
                                    <x-input-label :value="__('names.years')"></x-input-label>
                                    <input type="number" class="form-control " wire:model='experince.no_of_years'
                                        placeholder="{{ __('names.years') }}">
                                    @error('no_of_years')
                                        <div class="message mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">

                                @if ($experince == null)
                                    <x-upload model="experince.photo"></x-upload>
                                @else
                                    @if (gettype($experince) == 'array')
                                        @if (array_key_exists('photo', $experince) && gettype($experince['photo']) == 'object')
                                            <x-upload model="experince.photo" :file="$experince['photo'] ?? null"></x-upload>
                                        @elseif(array_key_exists('photo', $experince) && gettype($experince['photo']) == 'string')
                                            <x-upload model="experince.photo" :path="url('/storage') . '/' . $experince['photo']"></x-upload>
                                        @else
                                            <x-upload model="experince.photo"></x-upload>
                                        @endif
                                    @endif

                                @endif
                                {{-- <x-upload model="experince.photo" :path="gettype($experince) != 'array' && $experince?->photo
                                    ? url('/storage') . '/' . $experince?->photo
                                    : null" :file="$experince != null &&
                                gettype($experince) == 'array' &&
                                array_key_exists('photo', $experince) &&
                                gettype($experince['photo']) != 'string'
                                    ? $experince['photo']
                                    : null">
                                </x-upload> --}}

                                <div wire:loading wire:target="experince.photo">
                                    Uploading...</div>

                                @error('experince.photo')
                                    <div class="message mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div wire:loading wire:target="EditExperince,addExperince">
                        <div class="loader-cotnainer">
                            <div class="loader"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary light" data-bs-dismiss="modal">
                            {{ __('names.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('names.create') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div wire:ignore.self class="modal fade" id="addCourse" tabindex="-1" aria-labelledby="addaddCourseLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addaddCourseLabel">
                        {{ __('names.add-course') }}
                    </h1>

                </div>
                <form action="#" wire:submit.prevent="addCourse" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3 @error('course.name') is-invalid  @enderror">
                                    <x-input-label :value="__('names.name')"></x-input-label>
                                    <input class="form-control " wire:model='course.name'
                                        placeholder="{{ __('names.name') }}">
                                    @error('course.name')
                                        <div class="message mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3 @error('course.course_from') is-invalid  @enderror">
                                    <x-input-label :value="__('names.course-from')"></x-input-label>
                                    <input class="form-control " wire:model='course.course_from'
                                        placeholder="{{ __('names.course-from') }}">
                                    @error('course.course_from')
                                        <div class="message mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3 @error('course.duration') is-invalid  @enderror">
                                    <x-input-label :value="__('names.duration')"></x-input-label>
                                    <input class="form-control " wire:model='course.duration'
                                        placeholder="{{ __('names.duration') }}">
                                    @error('course.duration')
                                        <div class="message mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3 @error('course.date') is-invalid  @enderror">
                                    <x-input-label :value="__('names.date')"></x-input-label>
                                    <input type="date" class="form-control " wire:model='course.date'
                                        placeholder="{{ __('names.date') }}">
                                    @error('course.date')
                                        <div class="message mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">


                                @if ($course == null)
                                    <x-upload model="course.photo"></x-upload>
                                @else
                                    @if (gettype($course) == 'array')
                                        @if (array_key_exists('certificate_photo', $course) && gettype($course['certificate_photo']) == 'object')
                                            <x-upload model="course.certificate_photo" :file="$course['certificate_photo'] ?? null"></x-upload>
                                        @elseif(array_key_exists('certificate_photo', $course) && gettype($course['certificate_photo']) == 'string')
                                            <x-upload model="course.certificate_photo" :path="url('/storage') . '/' . $course['certificate_photo']"></x-upload>
                                        @else
                                            <x-upload model="course.certificate_photo"></x-upload>
                                        @endif
                                    @endif
                                @endif

                                <div wire:loading wire:target="course.certificate_photo">
                                    Uploading...</div>

                                @error('course.certificate_photo')
                                    <div class="message mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div wire:loading wire:target="EditCourse,addCourse">
                        <div class="loader-cotnainer">
                            <div class="loader"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary light" data-bs-dismiss="modal">
                            {{ __('names.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('names.create') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
