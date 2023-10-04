<table class="table mt-5">
    <thead>
      <tr>
        <th scope="col"><input type="checkbox" class="checkAll" /></th>
        <th scope="col">{{ __('projects::names.contract-number') }}</th>
        <th scope="col">{{ __('projects::names.coming-date') }}</th>
        <th scope="col">{{ __('projects::names.contract-type') }}</th>
        <th scope="col">{{ __('projects::names.contract-owner') }}</th>
        <th scope="col">{{ __('projects::names.branch-name') }}</th>
        <th scope="col">{{ __('projects::names.management-name') }}</th>
        <th scope="col">{{ __('projects::names.status') }}</th>
        <th scope="col">{{ __('projects::names.old-status') }}</th>
        <th scope="col">{{ __('projects::names.file') }}</th>
      </tr>
    </thead>
    <tbody>
          @foreach($data as $line)
          <tr>
              <td> <input type="checkbox" class="checkRow" name="id[]" value="{{ $line->id }}"/></td>
              <td> <a href="#">{{ $line->number }}</a> </td>
              <td> {{ $line->date }} </td>
              <td> {{ optional($line->type)->name }} </td>
              <td> {{ optional($line->owner)->name }} </td>
              <td> {{ optional($line->branch)->name  }} </td>
              <td> {{ optional($line->management)->name }} </td>
              <td class="status-{{ optional($line->status)->color }}">
                    {{ optional($line->status)->name }}
              </td>
              <td> - </td>
              <td>
                @if($line->attachment != null)
                    <a href="{{ url('uploads/contracts') }}/{{ $line->attachment }}" download>
                        <i class="icon-folder-open"></i>
                    </a>
                @else
                    -
                @endif
              </td>
            </tr>
          @endforeach
    </tbody>
  </table>
