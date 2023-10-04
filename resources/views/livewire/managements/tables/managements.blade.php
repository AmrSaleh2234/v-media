<div class="container-fluid  section">
    <div class="row">
        <div>
            {{-- Showing Branches --}}
            @if (havePermissionTo('managements.create'))
                <a href="{{ route('admin.managements.create', ['branch_id' => $branch_id]) }}"
                    class="btn btn-primary mx-2 btn-icon">
                    <i class='bx bx-plus-circle bx-sm'></i>
                    {{ __('message.add', ['model' => __('names.management')]) }}
                </a>
            @endif

        </div>
    </div>
    <div class="row">
        <x-table :responsive="true">
            <thead>
                <th>
                    #
                </th>
                <th>
                    {{ __('message.name', ['model' => __('names.management')]) }}
                </th>
                <th>
                    {{ __('names.management-type') }}
                </th>
                <th>
                    {{ __('message.name', ['model' => __('names.manager')]) }}
                </th>
                <th>
                    {{ __('message.count', ['model' => __('names.departments')]) }}
                </th>
                <th>
                    {{ __('message.count', ['model' => __('names.employees')]) }}
                </th>
                <th>
                    {{ __('names.setting') }}
                </th>
            </thead>
            <tbody>
                @foreach ($managements as $key => $managemnt)
                    <tr>
                        <td>
                            {{ $key + 1 }}
                        </td>
                        <td>
                            @if (havePermissionTo('managements.create'))
                                <a href="{{ route('admin.departments.index', ['management_id' => $managemnt->id]) }}">
                                    {{ $managemnt->name }}
                                </a>
                            @else
                                <a href="#">
                                    {{ $managemnt->name }}
                                </a>
                            @endif
                        </td>
                        <td>
                            {{ __('names.' . $managemnt->type) }}
                        </td>
                        <td>
                            {{ $managemnt->manager?->name }}
                        </td>

                        <td>
                            {{ $managemnt->departments_count }}
                        </td>
                        <td>
                            {{ $managemnt->NumberOfEmps() }}
                        </td>
                        <td>
                            @if (havePermissionTo('managements.edit'))
                                <a href="{{ route('admin.managements.edit', $managemnt) }}">
                                    <i class='bx bxs-edit bx-sm text-gray'></i>
                                </a>
                            @endif
                            @if (havePermissionTo('managements.delete'))
                                <a href="#" wire:click="delete({{ $managemnt->id }})">
                                    <i class='bx bx-trash bx-sm text-danger'></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table>

    </div>
</div>
