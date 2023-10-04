<div class="container-fluid ">
    <div class="row">

    </div>
    <div class="row my-3 d-flex">
        <div class="col-md-9">
            <input type="search" wire:model.debounce.400ms="search" class="form-control"
                placeholder="{{ __('names.search') }}">
        </div>

        <div class="col d-flex flex-row-reverse ">

            <button class="btn btn-primary mx-2 light  d-inline-flex align-items-center" type="button"
                data-bs-toggle="collapse" data-bs-target="#filter" aria-expanded="false" aria-controls="filter">
                <i class='bx bx-filter-alt bx-sm'></i>
                {{ __('names.filter') }}
            </button>

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
            <x-input-label :value="__('names.status')"></x-input-label>
            <select wire:model="status" class="form-select">
                <option value="all">{{ __('names.all') }}</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <x-input-label :value="__('names.order-by')"></x-input-label>
            <select wire:model="orderBy" class="form-select">
                <option value="name">{{ __('names.branch-name') }}</option>
                <option value="type">{{ __('names.branch-type') }}</option>
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

    <div class="row">
        <div class="col-md-8">
            <div class="table-with-header">
                <h4 class="title">
                    {{ __('names.support-requests') }}
                </h4>
                <div class="table-container">
                    <x-table :responsive="true">
                        <thead>
                            <th>
                                {{ __('names.name') }}
                            </th>
                            <th>
                                {{ __('names.type') }}
                            </th>
                            <th>
                                {{ __('names.employee') }}
                            </th>
                            <th>
                                {{ __('names.responsible') }}
                            </th>
                            <th>
                                {{ __('names.from') }}
                            </th>

                            <th>
                                {{ __('names.to') }}
                            </th>
                            <th>
                                {{ __('names.address') }}
                            </th>
                            <th>
                                {{ __('names.view') }}
                            </th>
                        </thead>
                        <tbody>
                            @forelse($employeeRequests as $key => $employeeRequest)
                                <tr>
                                    <td><a
                                            href="{{ route('admin.attendance.requests.show', $employeeRequest->id) }}">{{ $employeeRequest->name }}</a>
                                    </td>
                                    <td>{{ __('names.' . $employeeRequest->type) }}</td>

                                    <td>{{ Str::limit(optional($employeeRequest->employee)->name, 30) }}</td>
                                    <td>
                                        {{ $employeeRequest->responsible }}
                                    </td>
                                    <td>

                                        {{ Carbon\Carbon::parse($employeeRequest->from_time)->timezone($userTimeZone)->format('h:i A') }}
                                    </td>
                                    <td>

                                        {{ Carbon\Carbon::parse($employeeRequest->to_time)->timezone($userTimeZone)->format('h:i A') }}
                                    </td>
                                    <td>{{ Str::limit($employeeRequest->address, 30) }}</td>
                                    <td>
                                        <div class=" limit-2">
                                            @if (havePermissionTo('attendance.requests.changeStatus'))
                                                <a href="{{ route('admin.attendance.requests.show', $employeeRequest->id) }}"
                                                    class="px-1">
                                                    <i class='bx bx-chevron-left bx-sm  text-gray'></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">
                                        <div class="">
                                            <img class="" style="height: 100%"
                                                src="{{ asset('assets/images/empty.png') }}" alt="">
                                        </div>
                                        {{ __('message.empty', ['model' => __('names.employees-requests')]) }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </x-table>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="table-with-header">
                <h4 class="title">
                    {{ __('names.notes') }}
                </h4>
                <div class="table-container">
                    <x-table :responsive="true">

                        <thead>

                            <th>
                                {{ __('names.status') }}
                            </th>
                            <th>
                                {{ __('names.response') }}
                            </th>

                        </thead>
                        <tbody>
                            @forelse($employeeRequests as $key => $employeeRequest)
                                <tr>

                                    <td>
                                        @if (isset($employeeRequest->status))
                                            <small>
                                                <div class="status {{ $employeeRequest->status?->color }}">
                                                    {{ __('names.' . $employeeRequest->status?->name) }}</div>
                                            </small>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($employeeRequest->response)
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $employeeRequest->response }}">
                                                {{ Str::limit($employeeRequest->response, 15, '...') }}
                                            </a>
                                        @else
                                            -
                                        @endif


                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">
                                        <div class="">
                                            <img class="" style="height: 100%"
                                                src="{{ asset('assets/images/empty.png') }}" alt="">
                                        </div>
                                        {{ __('message.empty', ['model' => __('names.employees-requests')]) }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $employeeRequests->links() }}
    </div>
</div>
