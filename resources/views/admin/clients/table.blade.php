<thead>
    <tr>
        <th>{{ __('names.client-name') }}</th>
        <th>{{ __('names.phone-number') }}</th>
        <th>{{ __('Email') }}</th>
        <th>{{ __('names.card-id') }}</th>
        <th>{{ __('Branch') }}</th>
        <th>{{ __('names.client-status') }}</th>
        <th>{{ __('names.broker-name') }}</th>
        <th>{{ __('Setting') }}</th>
    </tr>
</thead>
@forelse ($data as $key => $model)
<tr>
    {{--  <td>{{ $model->id }}</td>  --}}
    <td>
        <a href="{{ route('admin.clients.show',$model->id) }}">{{ $model->name }}</a>
        {{--  @include('admin.layouts.tables.edit-name',['table'=>'contacts','id'=>$model->id,'edit'=>$model->name[$admin_language]])  --}}
    </td>
    <td>
        {{ $model->phone }}
    </td>
    <td>
        {{ $model->email }}
    </td>
    <td>
        {{ $model->card_id }}
    </td>
    <td>
        <a href="{{ route('admin.branches.show',$model->branch->id) }}">{{ $model->branch->name }}</a>
    </td>
    <td >
        <div class="status-block status-block-ok">
            {{ ClientStatus($model->status) }}
        </div>
    </td>
    <td>
        {{ $model->broker?->name }}
    </td>

{{--    <td>--}}
{{--        @include('admin.layouts.tables.status',['active'=>$model->active,'ajax_class'=>'contactstatus','id'=>$model->id])--}}
{{--    </td>--}}

      <td>
          <ul class="setting-list">
              <li>
                  @include('admin.layouts.tables.edit',['table'=>$model->getTable(),'id'=>$model->id])
              </li>
              <li>
                  @include('admin.layouts.tables.delete',['serivce_model'=>$model->getTable(),'table'=>$model->getTable(),'id'=>$model->id])
              </li>

          </ul>
      </td>
</tr>
@empty
    <tr>
        <td colspan="8">
            <h3>لا توجد نتائج</h3>

        </td>
    </tr>

@endforelse

