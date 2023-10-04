<div class="contracts-count-section">
    @if($type == 'transfered' || $type == 'total')
        <h3>{{ __('projects::names.contracts-statuses') }}</h3>
    @endif
    <div class="sides-container">

        <div class="count-cards-container">
            @if($type == 'transfered' || $type == 'total')
                    @foreach($statuses as $status)
                        <div class="count-card {{ $status->color }}">
                            <div class="title"> {{ $status->status }} </div>
                            <div class="count"> {{ $status->total }} </div>
                        </div>
                    @endforeach
                    @foreach($reminderStatuses as $status)
                        <div class="count-card {{ $status->color }}">
                            <div class="title"> {{ $status->name }} </div>
                            <div class="count"> 0 </div>
                        </div>
                    @endforeach
             @endif
        </div>

      <div class="filters">
        <form>
            @csrf
            <button id="filter">
                <i class="icon-filter-square"></i>
                {{ __('projects::names.filter') }}
              </button>
        </form>
        <form class="deleteForm" action="{{ route('admin.contract.bulkDelete') }}" method="POST">
                @csrf
                <input type="hidden" name="selected_ids" value="" class="deletedIds" />
                <button type="submit" class="disabled" id="delete">
                    <i class="icon-trash"></i>
                    {{ __('projects::names.delete') }}
                </button>
        </form>
       <form method="#" action="#" >
        @csrf
        <input type="hidden" name="edit_selectes" value="" class="editedId" />
        <button type="submit" id="edit" class="disabled">
            <i class="icon-edit"></i>
            {{ __('projects::names.edit') }}
          </button>
       </form>
      </div>
    </div>
  </div>
