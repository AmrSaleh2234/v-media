<table class="table mt-5">
          <thead>
            <tr>
              <th scope="col"><input type="checkbox" class="checkAll" /></th>
              <th scope="col">{{ __('projects::names.contract-number') }}</th>
              <th scope="col">{{ __('projects::names.contract-type') }}</th>
              <th scope="col">{{ __('projects::names.client-name') }}</th>
              <th scope="col">{{ __('projects::names.client-phone') }}</th>
              <th scope="col">{{ __('projects::names.duration') }}</th>
              <th scope="col">{{ __('projects::names.end-date') }}</th>
              <th scope="col">{{ __('projects::names.responsible-engineer') }}</th>
              <th scope="col">{{ __('projects::names.file') }}</th>
            </tr>
          </thead>
          <tbody>
                @foreach($data as $line)
                <tr>
                    <td> <input type="checkbox" class="checkRow" name="id[]" value="{{ $line->id }}"/></td>
                    <td> <a href="#">{{ $line->number }}</a> </td>
                    <td> {{ optional($line->type)->name }} </td>
                    <td> {{ optional($line->owner)->name }} </td>
                    <td> {{ optional($line->owner)->phone }} </td>
                    <td> {{ optional($line->items)->sum('period') }} {{ __('أشهر')  }} </td>
                    <td>
                         {{ Date('d-m-Y', strtotime('+'.optional($line->items)->sum('period') .' month')) }}
                    </td>
                    <td> {{  optional($line->management)->manger_name  }} </td>
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
