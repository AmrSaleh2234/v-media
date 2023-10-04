<thead>
    <tr>
        {{--  <th>{{ __('ID') }}</th>  --}}
        <th>{{ __('Name') }}</th>
        <th>{{ __('Phone') }}</th>
        <th> {{ __('names.accounting-method') }} </th>
        <th> {{ __('names.precent-from-project') }} </th>
        <th>{{ __('Status') }} </th>
        <th> </th>

        {{--  <th>{{ __('Setting') }}</th>  --}}
    </tr>
</thead>
@foreach ($data as $key => $model)
    <tr>
        {{--  <td>{{ $model->id }}</td>  --}}
        <td>
            {{ $model->name }}
            {{--  @include('admin.layouts.tables.edit-name',['table'=>'contacts','id'=>$model->id,'edit'=>$model->name[$admin_language]])  --}}
        </td>

        <td>
            {{ $model->phone }}
        </td>

        <td>
            {{ $model->accounting_method == 1 ? __('names.precent-from-project') : __('names.amount-from-project') }}
        </td>
        <td>
            {{ $model->accounting_method == 1 ? $model->precentage . ' %' : '-' }}
        </td>


        <td>
            <ul class="setting-list">
                <li>
                    @include('admin.layouts.tables.edit', [
                        'table' => $model->getTable(),
                        'id' => $model->id,
                    ])
                </li>
                <li>
                    @include('admin.layouts.tables.delete', [
                        'serivce_model' => $model->getTable(),
                        'table' => $model->getTable(),
                        'id' => $model->id,
                    ])
                </li>

            </ul>
        </td>
    </tr>
@endforeach
