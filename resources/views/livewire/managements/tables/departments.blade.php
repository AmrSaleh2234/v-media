<div class="container-fluid section ">
    <div class="row d-none">
        <div class="col-md-3">
            <x-input-label :value="__('names.branch-type')"></x-input-label>
            <select class="form-control" wire:model.lazy="branch_type">
                <option disabled selected>
                    {{ __('names.Select') }} {{ __('names.branch-type') }}
                </option>
                <option value="main">
                    {{ __('names.main') }}
                </option>
                <option value="sub">
                    {{ __('names.sub') }}
                </option>
            </select>
        </div>
        <div class="col-md-3">
            <x-input-label :value="__('names.management-name')"></x-input-label>
            <x-text-input wire:model.lazy="management_name"></x-text-input>
        </div>
        <div class="col-md-3">
            <x-input-label :value="__('names.manager-name')"></x-input-label>
            <x-text-input wire:model.lazy="management_manager"></x-text-input>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary btn-block w-100">
                {{ __('names.Search') }}
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (havePermissionTo('departments.create'))
                <a href="{{ route('admin.departments.create', ['management_id' => $management_id]) }}"
                    class="btn btn-primary btn-icon">
                    <i class="bx bx-plus-circle bx-sm"></i>
                    {{ __('message.add', ['model' => __('names.department')]) }}
                </a>
            @endif
            <x-table :responsive="true">
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        {{ __('message.name', ['model' => __('names.department')]) }}
                    </th>
                    <th>
                        {{ __('names.department-type') }}
                    </th>
                    <th>
                        {{ __('message.name', ['model' => __('names.management')]) }}
                    </th>
                    <th>
                        {{ __('names.management-type') }}
                    </th>
                    <th>
                        {{ __('names.manager-name') }}
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
                    @foreach ($departments as $key => $department)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                {{ $department->name }}
                            </td>
                            <td>
                                {{ __('names.' . $department->type) }}
                            </td>
                            <td>
                                {{ $department->management?->name }}
                            </td>
                            <td>
                                {{ __('names.' . $department->management?->type) }}
                            </td>
                            <td>
                                {{ $department->management?->manager?->name }}
                            </td>
                            <td>
                                {{ $department->management?->departments_count }}
                            </td>
                            <td>
                                {{ count($department->workers) }}
                            </td>
                            <td>
                                @if (havePermissionTo('departments.edit'))
                                    <a href="{{ route('admin.departments.edit', $department) }}">
                                        <i class='bx bxs-edit bx-sm text-gray'></i>
                                    </a>
                                @endif
                                @if (havePermissionTo('departments.delete'))
                                    <a href="#" wire:click="delete({{ $department->id }})">
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
</div>
