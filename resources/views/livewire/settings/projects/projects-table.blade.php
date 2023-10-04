<div class="container-fluid  my-2 ">
    <div class="row">
        <div class="col">
            <h3>{{ __('names.projects-setting') }}</h3>
        </div>
    </div>
    <div class="row my-3 d-flex">
        <div class="col-md-9">
            <input type="search" wire:model.debounce.400ms="search" class="form-control"
                placeholder="{{ __('names.search') }}">
        </div>
        <div class="col d-flex flex-row-reverse">
            <button class="btn btn-primary light mx-2 d-flex align-items-center" type="button"
                data-bs-toggle="collapse" data-bs-target="#filter" aria-expanded="false" aria-controls="filter">
                <i class='bx bx-filter-alt bx-sm'></i>
                {{ __('names.filter') }}
            </button>
            @if (havePermissionTo('platforms.projects.create'))
                <a href="{{ route('admin.settings.platforms.projects.create') }}">
                    <x-button class="  d-flex justify-content-center align-items-center">
                        <i class='bx bx-plus-circle bx-sm'></i>
                        {{ __('message.add', ['model' => __('names.project')]) }}
                    </x-button>
                </a>
            @endif
        </div>
    </div>
    <div class="row collapse" id="filter" wire:ignore>
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
                <option value="main">{{ __('names.main') }}</option>
                <option value="sub">{{ __('names.sub') }}</option>
            </select>
        </div>
        <div class="col">
            <x-input-label :value="__('names.order-by')"></x-input-label>
            <select wire:model="orderBy" class="form-select">
                <option value="project_type_id">{{ __('names.project-type') }}</option>
                {{--                <option value="employees_count">{{ __('names.employees-count') }}</option> --}}
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
                <option>4</option>
                <option>8</option>
                <option>12</option>
                <option>24</option>
                <option>100</option>
            </select>
        </div>
    </div>
    @include('admin.settings.platforms.projects.nav', ['class' => 'project'])

    <div class=" section custom-cards-container ">

        @forelse($companyProjects as $project)
            <div class="custom-projects-card ">
                <div class="image-container">
                    <img src="{{ $project->main_image ? '/storage/' . $project->main_image : asset('assets/images/empty.png') }}"
                        alt="{{ $project->name['ar'] }}">
                </div>
                <div class="content p-3">
                    <div class="data">
                        <h5>{{ $project->name[auth()->user()->lang] }}</h5>
                        <div>{{ Str::limit($project->description[auth()->user()->lang], 50) }}</div>
                    </div>
                    <div class="settings">
                        <div class="btn-group dropstart">
                            <button type="button" class="btn settings-button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bx bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu p-2 text-center">
                                <!-- Dropdown menu links -->
                                @if (havePermissionTo('platforms.projects.edit'))
                                    <a class="dropdown-item"
                                        href="{{ route('admin.settings.platforms.projects.edit', $project->id) }}">
                                        <i class='bx bxs-edit bx-sm text-gray'></i>

                                        {{ __('names.edit') }}
                                    </a>
                                @endif
                                @if (havePermissionTo('platforms.projects.delete'))
                                    <a href="#" class="dropdown-item"
                                        wire:click.prevent="delete({{ $project->id }})">
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
                    {{ __('message.empty', ['model' => __('names.projects')]) }}
                </div>
            </div>
        @endforelse

    </div>
    <div class="d-flex justify-content-center">
        {{ $companyProjects->links() }}
    </div>
</div>
