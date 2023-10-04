<div>
    <section class="section">
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
                @if (havePermissionTo('platforms.intrenalNews.create'))
                    <a href="{{ route('admin.settings.platforms.internal-news.create') }}">
                        <x-button class="  d-flex justify-content-center align-items-center">
                            <i class='bx bx-plus-circle bx-sm'></i>
                            {{ __('message.add', ['model' => __('names.internal-news')]) }}
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
        <table class="table table-borderless">
            <thead>
                <td>
                    #
                </td>
                <td>
                    {{ __('names.title') }}
                </td>
                <td>
                    {{ __('names.management') }}
                </td>
                <td>
                    {{ __('names.department') }}
                </td>
                <td>
                    {{ __('names.attachment') }}
                </td>
                <td>
                    {{ __('names.setting') }}
                </td>
            </thead>
            <tbody>
                @forelse($news as $key => $new)
                    <tr>
                        <td>
                            {{ $key + 1 }}
                        </td>
                        <td>
                            {{ $new->title[App::getLocale()] }}
                        </td>
                        <td>
                            {{ $new->management?->name }}
                        </td>
                        <td>
                            {{ $new->department?->name }}
                        </td>
                        <td>
                            <a href="{{ url('/storage/' . $new->attachment) }}" download>
                                <i class="bx bx-file-find"></i>
                            </a>
                            
                        </td>
                        <td>
                           <div class=" limit-2">
                                @if (havePermissionTo('platforms.intrenalNews.edit'))
                                    <a href="{{ route('admin.settings.platforms.internal-news.edit', $new->id) }}"
                                        class="px-1">
                                        <i class='bx bxs-edit bx-sm text-gray'></i>
                                    </a>
                                @endif
                                @if (havePermissionTo("platforms.intrenalNews.delete"))
                                    <a href="#" class="px-1" wire:click.prevent="delete({{ $new->id }})">
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
                            {{ __('message.empty', ['model' => __('names.internal-news')]) }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</div>
