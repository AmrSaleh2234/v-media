<thead>
    <tr>
            <th scope="col">{{ __('Name') }}</th>
            <th scope="col">{{ __('Job Name') }}</th>
            <th scope="col">{{ __('Code ID') }}</th>
            <th scope="col">{{ __('Branch') }}</th>
            <th scope="col">{{ __('Phone') }}</th>
            <th scope="col">{{ __('Email') }}</th>
            <th scope="col">{{ __('Status') }}</th>
            <th scope="col">{{ __('Setting') }}</th>
    </tr>
</thead>
@foreach ($data as $key => $model)
<tr>
    {{--  <td>{{ $model->id }}</td>  --}}
    <td>{{ $model->name }}</td>
    <td>{{ optional(optional($model->employeeManagement)->jobName)->name }}</td>
    <td>{{ $model->code_id }}</td>
    <td>{{ optional($model->branch)->name }}</td>
    <td>{{ $model->phone }}</td>
    <td>{{ $model->email }}</td>
    <td>@include('admin.layouts.tables.fields.active')</td>
    <td>
        <ul class="setting-list">
            <li>
                @include('admin.layouts.tables.edit',['table'=>'employee_types','id'=>$model->id])
            </li>
            {{--  <li>
                @include('admin.layouts.tables.delete',['table'=>'employee_types','id'=>$model->id])
            </li>  --}}
            {{--  <li>
              <a href="#"> <i class="icon-arrow-left"></i></a>
            </li>  --}}
          </ul>
    </td>
</tr>
@endforeach

