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
            @if (havePermissionTo('users.create'))
                <a href="#"  >
                    <x-button class="  d-flex justify-content-center align-items-center" disabled="true">
                        <i class='bx bx-plus-circle bx-sm'></i>
                        {{ __('message.add', ['model' => __('names.user')]) }}
                    </x-button>
                </a>
            @endif
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

    <div class="row">
        <x-table :responsive="true">

            <thead>
            <th>
                {{ __('names.image') }}
            </th>
            <th>
                {{ __('names.name') }}
            </th>
            <th>
                {{ __('names.roles') }}
            </th>
            <th>
                {{ __('names.join-at') }}
            </th>
            <th>
                {{ __('names.status') }}
            </th>
            <th>
                {{ __('names.setting') }}
            </th>
            </thead>
            <tbody>
            @forelse($users as $key => $user)
                <tr>
                    <td>
                        <img class="user-image  @if ($user->active)active @else expired @endif" src="{{ $user->image ?: $user->avatar }}" alt="">
                    </td>
                    <td>
{{--                        <a href="{{ route('admin.users.show', $user->id) }}">--}}
                            {{ $user->name }}
{{--                        </a>--}}
                    </td>
                    <td>
                        @forelse($user->roles as $role)
                            <span class="badge bg-primary">{{$role->name}}</span>
                        @empty
                            {{ __('names.no-roles') }}
                        @endforelse
                    </td>
                    <td>{{ $user->created }}</td>
                    <td>
                        @if (havePermissionTo('users.active'))
                            <div class="form-check form-switch d-flex align-content-center justify-content-center">
                                <input class="form-check-input" type="checkbox" role="switch"  @if ($user->active)checked @endif wire:click="toggle({{$user->id}})"   id="active">
                                <label class="form-check-label" for="active"></label>
                            </div>
                        @else

                            @if ($user->active)
                                <div class="status active ">{{ __('names.active') }}
                                </div>
                            @else
                                <div class="status stopped ">{{ __('names.in-active') }}
                                </div>
                            @endif
                    </td>
                        @endif


                    <td>
                        <div class=" limit-2">
                            @if (havePermissionTo('users.edit'))
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="px-1">
                                    <i class='bx bxs-edit bx-sm text-gray'></i>
                                </a>
                            @endif
{{--                            @if (havePermissionTo('users.delete'))--}}
{{--                                <a href="#" class="px-1" wire:click.prevent="delete({{ $user->id }})">--}}
{{--                                    <i class='bx bx-trash bx-sm text-danger'></i>--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                                <i class='bx bx-cog bx-sm '></i>--}}
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
                        {{ __('message.empty', ['model' => __('names.users')]) }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </x-table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>
