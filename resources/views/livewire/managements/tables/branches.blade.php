<div class="container-fluid section">
    <div class="row">
        <div class="col">
            <x-text-input wire:model.lazy="management_name" :placeholder="__('names.management-name')"></x-text-input>
        </div>
        <div class="col">
            <x-text-input wire:model.lazy="management_manager" :placeholder="__('names.manager-name')"></x-text-input>
        </div>
        <div class="col-md-3 d-flex flex-row-reverse ">
            <button class="btn btn-primary light mx-2 d-inline-flex align-items-center" type="button"
                data-bs-toggle="collapse" data-bs-target="#filter" aria-expanded="false" aria-controls="filter">
                <i class='bx bx-filter-alt bx-sm'></i>
                {{ __('names.filter') }}
            </button>
            <a href="{{ route('admin.managements.create') }}" class="btn btn-primary  btn-icon">
                <i class='bx bx-plus-circle bx-sm'></i>
                {{ __('message.add', ['model' => __('names.management')]) }}
            </a>
        </div>
    </div>
    <div class="row my-3  collapse" id="filter" wire:ignore>
        <div class="col">
            <x-input-label :value="__('names.branch-type')"></x-input-label>
            <select class="form-control" wire:model.lazy="branch_type">
                <option value="all" selected>
                    {{ __('message.select', ['model' => __('names.branch-type')]) }}
                </option>
                <option value="central">
                    {{ __('names.central') }}
                </option>
                <option value="main">
                    {{ __('names.main') }}
                </option>
                <option value="sub">
                    {{ __('names.sub') }}
                </option>
            </select>
        </div>
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
        <div class="col-md-12">
            {{-- Showing Branches --}}

            <x-table :responsive="true">
                <thead>
                    <th>
                        {{ __('message.name', ['model' => __('names.branch')]) }}
                    </th>
                    <th>
                        {{ __('names.branch-type') }}
                    </th>
                    <th>
                        {{ __('names.branch-address') }}
                    </th>
                    <th>
                        {{ __('message.count', ['model' => __('names.managements')]) }}
                    </th>
                    <th>
                        {{ __('message.count', ['model' => __('names.departments')]) }}
                    </th>
                    <th>
                        {{ __('message.count', ['model' => __('names.employees')]) }}
                    </th>
                    <th>
                        {{ __('names.setting') }}
                    </th>
                </thead>
                <tbody>
                    @foreach ($branches as $key => $branch)
                        <tr>
                            <td>
                                <a href="{{ route('admin.managements.index', ['branch_id' => $branch->id]) }}">
                                    {{ $branch->name }}
                                </a>
                            </td>
                            <td>
                                {{ __('names.' . $branch->type) }}
                            </td>
                            <td>
                                {{ $branch->address }}
                            </td>
                            <td>
                                {{ $branch->managements_count }}
                            </td>
                            <td>
                                {{ $branch->departments_count }}
                            </td>
                            <td>
                                {{ $branch->NumberOfEmps() }}
                            </td>
                            <td>
                                <a href="{{ route('admin.managements.index', ['branch_id' => $branch->id]) }}">
                                    <i class='bx bx-chevron-left bx-sm'></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-table>
            <div class="d-flex justify-content-center">
                {{ $branches->links() }}
            </div>
        </div>
    </div>
</div>
