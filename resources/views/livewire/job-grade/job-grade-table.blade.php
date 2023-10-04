<div class="container-fluid ">
    <div class="row my-3">
        <div class="col-md-9">
            <input type="search" wire:model.debounce.400ms="search" class="form-control"
                placeholder="{{ __('names.search') }}">
        </div>

        <div class="col d-flex flex-row-reverse">
            <button class="btn btn-primary light mx-2 d-flex align-items-center" type="button" data-bs-toggle="collapse"
                data-bs-target="#filter" aria-expanded="false" aria-controls="filter">
                <i class='bx bx-filter-alt bx-sm'></i>
                {{ __('names.filter') }}
            </button>

            @if (havePermissionTo('jobGrades.create'))
                <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal"
                    wire:click="create()" data-bs-target="#JobGradeModal">
                    <i class='bx bx-plus-circle bx-sm'></i>
                    {{ __('message.create', ['model' => __('names.job-grade')]) }}
                </button>
            @endif
        </div>
    </div>
    <div class="row my-3  collapse" id="filter" wire:ignore>
        <div class="col">
            <x-input-label :value="__('names.date-start')"></x-input-label>
            <input type="date" wire:model="start_date" class="form-control" />
        </div>
        <div class="col">
            <x-input-label :value="__('names.date-end')"></x-input-label>
            <input type="date" wire:model="end_date" class="form-control" />
        </div>
        <div class="col">
            <x-input-label :value="__('names.order-by')"></x-input-label>
            <select wire:model="orderBy" class="form-select">
                <option value="id">{{ __('names.job-grade') }}</option>
                <option value="job-type">{{ __('names.job-type') }}</option>
                <option value="salary">{{ __('names.salary') }}</option>
                <option value="years">{{ __('names.years') }}</option>
                <option value="employees_count">{{ __('message.count', ['model' => __('names.employees')]) }}</option>
                <option value="created_at">{{ __('names.created-at') }}</option>
            </select>
        </div>
        <div class="col">
            <x-input-label :value="__('names.order-desc')"></x-input-label>
            <select wire:model="orderDesc" class="form-select">
                <option value="1">{{ __('names.desc') }}</option>
                <option value="0">{{ __('names.asc') }}</option>
            </select>
        </div>
        <div class="col">
            <x-input-label :value="__('names.per-page')"></x-input-label>
            <select wire:model="perPage" class="form-select">
                <option>5</option>
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
    </div>
    @include('admin.jobs.nav', ['class' => 'job_grade'])
    <div class="row section my-2">
        <x-table :responsive="true">
            <thead>
                <th>
                    {{ __('names.job-grade') }}
                </th>
                <th>
                    {{ __('names.salary') }}
                </th>
                <th>
                    {{ __('names.years') }}
                </th>
                <th>
                    {{ __('message.count', ['model' => __('names.employees')]) }}
                </th>
                <th>
                    {{ __('names.job-type') }}
                </th>
                <th>
                    {{ __('names.status') }}
                </th>
                <th>
                    {{ __('names.setting') }}
                </th>
            </thead>
            <tbody>
                @forelse($jobGrades as $key => $jobGrade)
                    <tr>
                        <td><a
                                href="{{ route('admin.job_grades.show', $jobGrade->id) }}">{{ $jobGrade->grade->name }}</a>
                        </td>
                        <td>{{ $jobGrade->salary }}</td>
                        <td>{{ $jobGrade->years }}</td>
                        <td>{{ $jobGrade->employees_count }}</td>
                        <td class="flex-table-data">
                            {{ $jobGrade->jobType->name }}
                        </td>
                        <td>
                            @if ($jobGrade->active)
                                <span class="text-success">
                                    {{ __('names.active') }}
                                </span>
                            @else
                                <span class="text-danger">
                                    {{ __('names.in-active') }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="">
                                <div class=" limit-2">
                                    @if (havePermissionTo('jobGrades.edit'))
                                        <a data-bs-toggle="modal" data-bs-target="#JobGradeModal"
                                            wire:click.prevent="edit({{ $jobGrade->id }})" href="#"
                                            class="px-1">
                                            <i class='bx bxs-edit bx-sm text-gray'></i>
                                        </a>
                                    @endif
                                    @if (havePermissionTo('jobGrades.delete'))
                                        <a href="#" class="px-1"
                                            wire:click.prevent="delete({{ $jobGrade->id }})">
                                            <i class='bx bx-trash bx-sm text-danger'></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">
                            <div class="">
                                <img class="" style="height: 100%" src="{{ asset('assets/images/empty.png') }}"
                                    alt="">
                            </div>
                            {{ __('message.empty', ['model' => __('names.job-grades')]) }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $jobGrades->links() }}
    </div>

    @if (havePermissionTo('jobGrades.create'))
        <livewire:job-grade.job-grade-modal modal_id="JobGradeModal" />
    @endif
</div>
