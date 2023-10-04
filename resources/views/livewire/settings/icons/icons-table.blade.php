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
            @if (havePermissionTo('platforms.icons.create'))
                <a href="{{ route('admin.settings.platforms.icons.create') }}">
                    <x-button class="  d-flex justify-content-center align-items-center">
                        <i class='bx bx-plus-circle bx-sm'></i>
                        {{ __('message.add', ['model' => __('names.icon')]) }}
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
            <x-input-label :value="__('names.type')"></x-input-label>
            <select wire:model="type" class="form-select">
                <option value="all">{{ __('names.all') }}</option>
                <option value="partners" >{{ __('names.partners') }}</option>
                <option value="certificates" >{{ __('names.certificates') }}</option>
                <option value="credences" >{{ __('names.credences') }}</option>
            </select>
        </div>
        <div class="col">
            <x-input-label :value="__('names.order-by')"></x-input-label>
            <select wire:model="orderBy" class="form-select">
                <option value="name">{{ __('names.name') }}</option>
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

    <div class=" section custom-cards-container ">

        @forelse($icons as $icon)
            <div class="custom-projects-card ">
                <div class="image-container">
                    <img src="{{ $icon->logo ? asset('storage/' . $icon->logo ) : asset('assets/images/upload.png') }}"
                        alt="{{ $icon->name[auth()->user()->lang] }}">
                </div>
                <div class="content p-3">
                    <div class="data">
                        <h5>{{ $icon->name[auth()->user()->lang] }}</h5>
                        <div class="">{{ __('names.' . $icon->type) }}</div>
                    </div>
                    <div class="settings">
                        <div class="btn-group dropstart">
                            <button type="button" class="btn settings-button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bx bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu p-2 text-center">
                                <!-- Dropdown menu links -->
                                @if (havePermissionTo('platforms.icons.edit'))
                                    <a class="dropdown-item"
                                        href="{{ route('admin.settings.platforms.icons.edit', $icon->id) }}"> <i
                                            class='bx bxs-edit bx-sm text-gray'></i>
                                        {{ __('names.edit') }}
                                    </a>
                                @endif
                                @if (havePermissionTo('platforms.icons.delete'))
                                    <a href="#" class="dropdown-item"
                                        wire:click.prevent="delete({{ $icon->id }})">
                                        <i class='bx bx-trash bx-sm text-danger'></i>
                                        {{ __('names.delete') }}
                                    </a>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="d-flex flex-column justify-content-center">
                <img class="" style="height: 100%" src="{{ asset('assets/images/empty.png') }}" alt="">
                <div class="text-center">
                    {{ __('message.empty', ['model' => __('names.icons')]) }}
                </div>
            </div>
        @endforelse

    </div>
    <div class="d-flex justify-content-center">
        {{ $icons->links() }}
    </div>
</div>
