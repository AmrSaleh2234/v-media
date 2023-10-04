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
            @if (havePermissionTo('platforms.banners.create'))
                <a href="{{ route('admin.settings.platforms.banners.create') }}">
                    <x-button class="  d-flex justify-content-center align-items-center">
                        <i class='bx bx-plus-circle bx-sm'></i>
                        {{ __('message.add', ['model' => __('names.banner')]) }}
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

        @forelse($banners as $banner)
            <div class="custom-projects-card ">
                <div class="image-container">
                    <img src="{{ $banner->image ? '/storage/' . $banner->image : asset('assets/images/upload.png') }}"
                        alt="{{ $banner->name[auth()->user()->lang] }}">
                </div>
                <div class="content p-3">
                    <div class="data">
                        <h5>{{ $banner->name[auth()->user()->lang] }}</h5>
{{--                        <div class="">{{ Str::limit($banner->description[auth()->user()->lang], 50) }}</div>--}}
                    </div>
                    <div class="settings">
                        <div class="btn-group dropstart">
                            <button type="button" class="btn settings-button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bx bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu p-2 text-center">
                                <!-- Dropdown menu links -->
                                @if (havePermissionTo('platforms.banners.edit'))
                                    <a class="dropdown-item"
                                        href="{{ route('admin.settings.platforms.banners.edit', $banner->id) }}"> <i
                                            class='bx bxs-edit bx-sm text-gray'></i>
                                        {{ __('names.edit') }}
                                    </a>
                                @endif
                                @if (havePermissionTo('platforms.banners.delete'))
                                    <a href="#" class="dropdown-item"
                                        wire:click.prevent="delete({{ $banner->id }})">
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
                    {{ __('message.empty', ['model' => __('names.banners')]) }}
                </div>
            </div>
        @endforelse

    </div>
    <div class="d-flex justify-content-center">
        {{ $banners->links() }}
    </div>
</div>
