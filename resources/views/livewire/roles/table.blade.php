<div>
    <div class="row">
        <div class="col-md-4">
            @if (havePermissionTo('roles.create'))
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary w-100">
                    {{ __('message.add', ['model' => __('names.role')]) }}
                </a>
            @endif
        </div>
        <div class="col-md-12 mt-4">
            <table class="table table-borderless">
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        {{ __('names.name') }}
                    </th>
                    <th>
                        {{ __('names.permissions') }}
                    </th>
                    <th>
                        {{ __('names.setting') }}
                    </th>
                </thead>
                <tbody>
                    @forelse($roles as $key=>$role)
                        <tr>
                            <td>
                                {{ ++$key }}
                            </td>
                            <td>
                                {{ $role->name }}
                            </td>
                            <td>
                                {{ count($role->permissions) }} {{ __('names.permissions') }}
                            </td>
                            <td>
                                <div class=" limit-2">
                                    @if (havePermissionTo('roles.edit'))
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="px-1">
                                            <i class='bx bxs-edit bx-sm text-gray'></i>
                                        </a>
                                    @endif

                                    @if (havePermissionTo('roles.delete'))
                                        <a class="px-1" wire:click.prevent="delete({{ $role->id }})">
                                            <i class='bx bx-trash bx-sm text-danger'></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="">
                                    <img class="" style="height: 100%"
                                        src="{{ asset('assets/images/empty.png') }}" alt="">
                                </div>
                                {{ __('message.empty', ['model' => __('names.roles')]) }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
