<div class="container-fluid ">
    <div class="row my-3 d-flex">
        <div class="col-md-9">
            <input type="search" wire:model.debounce.400ms="search" class="form-control"
                   placeholder="{{ __('names.search') }}">
        </div>
        <div class="col d-flex flex-row-reverse ">
            <button class="btn btn-primary mx-2 light  d-inline-flex align-items-center" type="button"
                    data-bs-toggle="collapse" data-bs-target="#filter"
                    aria-expanded="false" aria-controls="filter">
                <i class='bx bx-filter-alt bx-sm'></i>
                {{ __('names.filter') }}
            </button>
            {{--            <a href="{{ route('admin.settings.platforms.news.create') }}">--}}
            {{--                <x-button class="  d-flex justify-content-center align-items-center">--}}
            {{--                    <i class='bx bx-plus-circle bx-sm'></i>--}}
            {{--                    {{ __('message.add', ['model' => __('names.news')]) }}--}}
            {{--                </x-button>--}}
            {{--            </a>--}}
        </div>
    </div>

    <div class="row my-3  collapse" id="filter" wire:ignore>
        <div class="col">
            <x-input-label :value="__('names.date-start')"></x-input-label>
            <input type="date" wire:model="start_date" class="form-control"/>
        </div>
        <div class="col">
            <x-input-label :value="__('names.date-end')"></x-input-label>
            <input type="date" wire:model="end_date" class="form-control"/>
        </div>

        <div class="col">
            <x-input-label :value="__('names.status')"></x-input-label>
            <select wire:model="status_id" class="form-select">
                <option value="">{{ __('names.all') }}</option>
            </select>
        </div>
        <div class="col">
            <x-input-label :value="__('names.order-by')"></x-input-label>
            <select wire:model="orderBy" class="form-select">
                <option value="name">{{ __('names.title') }}</option>
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
    @include('admin.settings.website.reports.nav', ['class' => 'services'])
    <div class="row">
        <x-table :responsive="true">

            <thead>
            <th>
                #
            </th>
            <th>
                {{ __('names.name') }}
            </th>
            <th>
                {{ __('names.email') }}
            </th>
            <th>
                {{ __('names.phone') }}
            </th>
            <th>
                {{ __('names.service') }}
            </th>
            <th>
                {{ __('names.from') }}
            </th>
            <th>
                {{ __('names.status') }}
            </th>
            <th>
                {{ __('names.setting') }}
            </th>
            </thead>
            <tbody>
            @forelse($servicesRequests as $key => $servicesRequest)
                <tr>
                    <td>{{ $servicesRequest->id }}</td>
                    <td>{{ $servicesRequest->first_name }} {{ $servicesRequest->last_name }}</td>
                    <td>{{ $servicesRequest->email }}</td>
                    <td>{{ $servicesRequest->phone }}</td>
                    <td>{{ $servicesRequest->service?->name[auth()->user()->lang]  ?? '-' }}</td>
                    <td>{{ __('names.'.$servicesRequest->from) }}</td>

                    <td>
                        @if($servicesRequest->status)
                            <div class="status">
                                {{ __('names.'.$servicesRequest->status?->name)  }}
                            </div>
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        -
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">
                        <div class="">
                            <img class="" style="height: 100%" src="{{ asset('assets/images/empty.png') }}" alt="">
                        </div>
                        {{ __('message.empty',['model'=> __('names.services-requests')]) }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </x-table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $servicesRequests->links() }}
    </div>
</div>
