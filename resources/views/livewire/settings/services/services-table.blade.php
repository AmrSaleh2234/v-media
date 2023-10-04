<div class="container-fluid ">
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
            @if (havePermissionTo('platforms.services.create'))
                <a href="{{ route('admin.settings.platforms.services.create') }}">
                    <x-button class="  d-flex justify-content-center align-items-center">
                        <i class='bx bx-plus-circle bx-sm'></i>
                        {{ __('message.add', ['model' => __('names.service')]) }}
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
            <x-input-label :value="__('names.status')"></x-input-label>
            <select wire:model="status_id" class="form-select">
                <option value="">{{ __('names.all') }}</option>
            </select>
        </div>
        <div class="col">
            <x-input-label :value="__('names.order-by')"></x-input-label>
            <select wire:model="orderBy" class="form-select">
                <option value="name">{{ __('names.service-name') }}</option>
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
                <th>
                    {{ __('names.service-name') }}
                </th>

                <th>
                    {{ __('names.category') }}
                </th>
                <th>
                    {{ __('names.application') }}
                </th>
                <th>
                    {{ __('names.website') }}
                </th>
                <th>
                    {{ __('names.setting') }}
                </th>
            </thead>
            <tbody>
                @forelse($services as $key => $service)
                    <tr>
                        <td><a
                                href="{{ route('admin.settings.platforms.services.show', $service->id) }}">{{ $service->name[auth()->user()->lang] }}</a>
                        </td>

                        <td>{{ optional($service->category)->name[auth()->user()->lang] }}</td>
                        <td>
                            @if ($service->app)
                                <div class="status active">{{ __('names.active') }}
                                </div>
                            @else
                                <div class="status stopped">{{ __('names.in-active') }}
                                </div>
                            @endif
                        </td>
                        <td>
                            @if ($service->website)
                                <div class="status active ">{{ __('names.active') }}
                                </div>
                            @else
                                <div class="status stopped ">{{ __('names.in-active') }}
                                </div>
                            @endif
                        </td>

                        <td>
                            <div class=" limit-2">
                                @if (havePermissionTo('platforms.services.edit'))
                                    <a href="{{ route('admin.settings.platforms.services.edit', $service->id) }}"
                                        class="px-1">
                                        <i class='bx bxs-edit bx-sm text-gray'></i>
                                    </a>
                                @endif
                                @if (havePermissionTo('platforms.services.delete'))
                                    <a href="#" class="px-1" wire:click.prevent="delete({{ $service->id }})">
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
                            {{ __('message.empty', ['model' => __('names.services')]) }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $services->links() }}
    </div>
</div>
