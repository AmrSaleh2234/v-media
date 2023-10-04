@extends('projects::layouts.master')
@section('title')
    @if(isset($title)) {{ $title }} @else {{ __('names.contracts') }}
    @endif
@stop
@section('breadcrumb')
    <x-breadcrumb :tree="$tree" current="contracts" ></x-breadcrumb>
@endsection
@section('content')
<div class="form-container">
  <form action="" class="contracts-search-component">

    @if(isset($type) && $type == 'newest' || $type == 'total')
        @include('projects::contracts.partial.filter_form')
    @else
         @include('projects::contracts.partial.filter_form2')
    @endif

    <div class="nav-links">
        <a class="{{ $type == 'total' ? 'active' : '' }}" href="{{ route('admin.contract.type','total') }}">
            {{ __('projects::names.contract-information') }}
        </a>
        <a href="{{ route('admin.contract.type','newest') }}" class="{{ $type != 'total' ? 'active' : '' }}">
            {{ __('projects::names.contract-management') }}
        </a>
      </div>
    <section class="p-4 bg-gary">

     @if($type != 'total')
         @include('projects::contracts.partial.navigation',['active' => isset($type) ? $type : ''])
     @endif


        @include('projects::contracts.partial.statuses',['statuses' => $statuses, 'reminderStatuses' => $reminderStatuses , 'type' => $type])

      <div class="table-container">
        @if(isset($type) &&  $type == 'total'  )
             @include('projects::contracts.partial.table',['data' => $data])
        @else
             @include('projects::contracts.partial.table_2',['data' => $data])
        @endif
      </div>
    </section>
  </form>
</div>
@stop

@push('script')
    <script src="{{ asset('modules/projects/js/lib/jquery.js') }}"></script>
    <script src="{{ asset('modules/projects/js/contract_js/index.js') }}"></script>
@endpush
