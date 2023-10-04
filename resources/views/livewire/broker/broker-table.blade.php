<div class="container-fluid ">
    <div class="row my-3 d-flex">
        <div class="col-md-9">
            <input type="search" wire:model.debounce.400ms="search" class="form-control"
                placeholder="{{ __('names.search') }}">
        </div>

        <div class="col d-flex flex-row-reverse ">
            <button class="btn btn-primary light mx-2 d-flex align-items-center" type="button" data-bs-toggle="collapse"
                data-bs-target="#filter" aria-expanded="false" aria-controls="filter">
                <i class='bx bx-filter-alt bx-sm'></i>
                {{ __('names.filter') }}
            </button>
            @if (havePermissionTo('brokers.create'))
                <a href="{{ route('admin.brokers.create') }}">
                    <x-button class="w-100 d-flex justify-content-center align-items-center">
                        <i class='bx bx-plus-circle bx-sm'></i>
                        {{ __('message.add', ['model' => __('names.broker')]) }}
                    </x-button>
                </a>
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
                <option value="name">{{ __('names.broker-name') }}</option>
                <option value="active">{{ __('names.status') }}</option>
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
        <x-table :responsive="true">
            <thead>
                <th>{{ __('names.broker-name') }}</th>
                <th>{{ __('names.phone-number') }}</th>
                <th> {{ __('names.accounting-method') }} </th>
                <th> {{ __('names.percent-from-project') }} </th>
                <th>
                    {{ __('names.setting') }}
                </th>
            </thead>
            <tbody>
                @forelse($brokers as $key => $borker)
                    <tr>
                        <td>
                            {{--                        <a href="{{ route('admin.brokers.show', $borker->id) }}"> --}}
                            {{ $borker->name }}
                            {{--                        </a> --}}
                        </td>
                        <td>{{ $borker->phone }}</td>
                        <td>
                            @if ($borker->accounting_method)
                                {{ __('names.percent-from-project') }}
                            @else
                                {{ __('names.amount-from-project') }}
                            @endif
                        </td>
                        <td>{{ $borker->percentage . '%' ?? null }}</td>
                        <td>
                            <div class=" limit-2">
                                @if (havePermissionTo('brokers.edit'))
                                    <a href="{{ route('admin.brokers.edit', $borker->id) }}" class="px-1">
                                        <i class='bx bxs-edit bx-sm text-gray'></i>
                                    </a>
                                @endif
                                @if (havePermissionTo('brokers.delete'))
                                    <a href="#" class="px-1" wire:click.prevent="delete({{ $borker->id }})">
                                        <i class='bx bx-trash bx-sm text-danger'></i>
                                    </a>
                                @endif
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
                            {{ __('message.empty', ['model' => __('names.brokers')]) }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $brokers->links() }}
    </div>
</div>
