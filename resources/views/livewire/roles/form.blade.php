<div>
    <form wire:submit.prevent="save">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <h4>
                    {{ __('message.add', ['model' => __('names.role')]) }}
                </h4>
            </div>
            <div class="col-md-6 mb-4 mt-4">
                <x-input-label :value="__('names.role-name')"></x-input-label>
                <input class="form-control" name="role" wire:model.lazy="name" />
            </div>

            <div class="col-md-8">

            </div>
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-header">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model.lazy="totalPermission">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ __('message.give-all-permission') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mb-2">
                    <div class="card-header">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model.lazy="totalViewPermission">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ __('message.give-all-permission') }} {{ __('names.view') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card mb-2">
                    <div class="card-header">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model.lazy="totalCreatePermission">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ __('message.give-all-permission') }} {{ __('names.create') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mb-2">
                    <div class="card-header">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model.lazy="totalEditPermission">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ __('message.give-all-permission') }} {{ __('names.edit') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model.lazy="totalDeletePermission">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ __('message.give-all-permission') }} {{ __('names.delete') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($permissions as $key => $permission)
                <div class="col-md-3">
                    <div class="card mb-2">
                        <div class="card-header" data-bs-toggle="collapse" href="#{{ $key }}-div"
                            role="button" aria-expanded="false" aria-controls="{{ $key }}-div">
                            <div class="form-check">

                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ __('names.' . $key) }}
                                </label>
                            </div>
                        </div>
                        <div wire:ignore.self class="card-body p-2 collapse" id="{{ $key }}-div">
                            <ul class="list-group">

                                @foreach ($permission as $key => $pr)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input class="form-check-input" wire:model.lazy="choosenPermissions"
                                                type="checkbox" value="{{ $pr }}">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <?php
                                                $names = explode('.', $pr);
                                                ?>
                                                @if (count($names) >= 2)
                                                    @foreach ($names as $key => $name)
                                                        {{ $key > 0 ? __('names.' . $name) : '' }}
                                                    @endforeach
                                                @elseif(count($names) == 1)
                                                    @foreach ($names as $key => $name)
                                                        {{ __('names.' . $name) }}
                                                    @endforeach
                                                @else
                                                    {{ __('names.' . $pr) }}
                                                @endif
                                            </label>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach


            <div class="row mt-4">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('names.save') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
