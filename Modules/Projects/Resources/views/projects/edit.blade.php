@extends('admin.layouts.app')
@section('title') {{ __('Edit Employee') }}
@stop
@section('head_content')
    @include('admin.employees.head')
@stop
@section('content')
    @include('admin.errors.errors')
    {{--  <section class="branch-box">  --}}
        <div class="row">
            <div class="col-sm-6">
                <h2 class="title">{{ __('Employee Data') }}</h2>
                @include('admin.layouts.forms.edit', ['table' => 'employees', 'model' => $employee])
                @include('admin.employees.form')
                @include('admin.layouts.forms.close')
            </div>
            <div class="clearfix"></div>
        </div>

    {{--  </section>  --}}
@stop
@section('after_foot')
    @include('admin.layouts.image')
    @include('admin.employees.change')
@stop
