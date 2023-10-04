<div class="container-fluid section ">
    <div class="row my-3 d-flex">
        <div class="col-md-7">
            <input type="search" wire:model.debounce.400ms="search" class="form-control"
                placeholder="{{ __('names.search') }}">
        </div>

        <div class="col d-flex flex-row-reverse">
            <button class="btn btn-primary mx-2 light" type="button" data-bs-toggle="collapse" data-bs-target="#filter"
                aria-expanded="false" aria-controls="filter">
                <i class='bx bx-filter-alt bx-sm'></i>

                {{ __('names.filter') }}
            </button>

            @if (havePermissionTo('branches.create'))
                <a href="{{ route('admin.branches.create') }}"
                    class="btn btn-primary d-flex justify-content-center align-items-center"> <i
                        class='bx bx-plus-circle bx-sm'></i>
                    {{ __('message.add', ['model' => __('names.branch')]) }}</a>
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
                <option value="main">{{ __('names.main') }}</option>
                <option value="sub">{{ __('names.sub') }}</option>
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
        @foreach ($branches->where('type', 'central') as $branch)
            @include('admin.Branches._shared.branch_element', ['branch' => $branch, 'light' => ''])

            @if (count($branch->childern) >= 1)
                <div class="collapse" id="childern-{{ $branch->id }}">
                    @foreach ($branch->childern as $child)
                        @include('admin.Branches._shared.branch_element', [
                            'branch' => $child,
                            'light' => 'light',
                        ])

                        @if (count($child->childern) >= 1)
                            <div class="collapse" id="childern-{{ $child->id }}">
                                @foreach ($child->childern as $minChild)
                                    @include('admin.Branches._shared.branch_element', [
                                        'branch' => $minChild,
                                        'light' => 'light',
                                    ])
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $branches->links() }}
    </div>
</div>
