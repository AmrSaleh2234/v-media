<div>
    <div class="row">
        <div class="col-md-9">
            <h4>
                {{ __('names.settings-shift') }}
            </h4>
        </div>
        <div class="col-md-3">
            @if (havePermissionTo('dashboardSetting.shift.create'))
                <a href="{{ route('admin.settings.dashboard.shifts.create') }}" class="btn btn-primary w-100">
                    <i class="bx bx-plux-circle"></i>
                    {{ __('names.add-shift') }}
                </a>
            @endif
        </div>

        <div class="col-md-12 mt-2">
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
                            {{ __('names.setting') }}
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($shifts as $key=>$shift)
                            <tr>
                                <td>
                                    {{ ++$key }}
                                </td>
                                <td>
                                    {{ $shift->name }}
                                </td>
                                <td>
                                    <div class="">
                                        <div class=" limit-2">
                                            @if (havePermissionTo('dashboardSetting.shift.edit'))
                                                <a href="{{ route('admin.settings.dashboard.shifts.create', ['shift_id' => $shift->id]) }}"
                                                    class="px-1">
                                                    <i class='bx bxs-edit bx-sm text-gray'></i>
                                                </a>
                                            @endif
                                            @if (havePermissionTo('dashboardSetting.shift.delete'))
                                                <a wire:click.prevent="delete('{{ $shift->id }}')" class="px-1"
                                                    type="button">
                                                    <i class='bx bx-trash bx-sm text-danger'></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @empty
                        @endforelse
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</div>
