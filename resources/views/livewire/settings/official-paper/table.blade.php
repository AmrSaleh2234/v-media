<div>
    <div class="row">
        <div class="col-md-12 mb-4">

            <a href="#" wire:click="resetPaper" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#addPaper">
                <i class="bx bx-plus-circle"></i> {{ __('names.add-official-paper') }}
            </a>

        </div>
        <div class="col-md-12">
            <section class="section">
                <table class="table table-borderless">
                    <thead>
                        <th>
                            #
                        </th>
                        <th>
                            {{ __('names.name') }}
                        </th>


                        <th>
                            {{ __('names.notification-duration') }}
                        </th>
                        <th>
                            {{ __('names.notification-status') }}
                        </th>
                        <th>
                            {{ __('names.send-notification-way') }}
                        </th>
                        <th>
                            {{ __('names.setting') }}
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($papers as $key=>$paper)
                            <tr>
                                <td>
                                    {{ ++$key }}
                                </td>
                                <td>
                                    {{ $paper->name }}
                                </td>
                                <td>
                                    {{ $paper->duration }}
                                </td>
                                <td>
                                    {{ $paper->status }}
                                </td>
                                <td>
                                    {{ __('names.' . $paper->way_to_send) }}
                                </td>
                                <td>
                                    <div class="">
                                        <div class=" limit-2">
                                            @if (havePermissionTo('dashboardSetting.branches.officialPaper.edit'))
                                                <a data-bs-toggle="modal" data-bs-target="#addPaper" type="button"
                                                    wire:click="updateThisPaper({{ $paper }})" class="px-1">
                                                    <i class='bx bxs-edit bx-sm text-gray'></i>
                                                </a>
                                            @endif
                                            @if (havePermissionTo('dashboardSetting.branches.officialPaper.delete'))
                                                <a href="#" class="px-1"
                                                    wire:click.prevent="delete('{{ $paper->id }}')" type="button">
                                                    <i class='bx bx-trash bx-sm text-danger'></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    No data found!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </div>




        <div wire:ignore.self class="modal fade" id="addPaper" tabindex="-1" aria-labelledby="addPaperLabel"
            aria-hidden="true">
            <div class="modal-dialog loading">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addPaperLabel">
                            {{ __('names.add-paper') }}
                        </h1>

                    </div>
                    <form wire:submit.prevent="save">
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3 form-group @error('newPaper.name') is-invalid @enderror">
                                    <x-input-label :value="__('names.name')"></x-input-label>
                                    <input type="text" wire:model.lazy="newPaper.name" class="form-control" />
                                    @error('newPaper.name')
                                        <span class="d-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3 form-group @error('newPaper.duration') is-invalid @enderror">
                                    <x-input-label :value="__('names.notification-duration')"></x-input-label>
                                    <input type="number" wire:model.lazy="newPaper.duration" class="form-control" />
                                    @error('newPaper.duration')
                                        <span class="d-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3 form-group @error('newPaper.status') is-invalid @enderror">
                                    <x-input-label :value="__('names.notification-status')"></x-input-label>
                                    <input type="text" wire:model.lazy="newPaper.status" class="form-control" />
                                    @error('newPaper.status')
                                        <span class="d-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-4 row">
                                    <div class="col-md-12 mb-2">
                                        <x-input-label :value="__('names.send-notification-way')"></x-input-label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" class="form-check" value="phone" name="send"
                                            wire:model.lazy="newPaper.way_to_send" />
                                        <x-input-label :value="__('names.phone')"></x-input-label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" class="form-check" value="email" name="send"
                                            wire:model.lazy="newPaper.way_to_send" />
                                        <x-input-label :value="__('names.email')"></x-input-label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div wire:loading wire:target="save,updateThisPaper,resetPaper">
                            <div class="loader-cotnainer">
                                <div class="loader"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                                {{ __('names.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('names.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
