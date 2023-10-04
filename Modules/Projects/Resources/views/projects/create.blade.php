@extends('admin.layouts.app')
@section('title') {{ __('Create Project') }}
@stop
{{-- @section('head_content')
@include('admin.employee_types.head')
@stop  --}}
@section('content')
@include('admin.errors.errors')
@include('admin.layouts.forms.create',['table'=>'projects'])
<input type="hidden" name="project_id" value=" {{ $project_id ?? null }}">
<div class="wizard">
    @include('projects::projects.steps-head')
    {{--  <form role="form" action="#">  --}}
        <div class="tab-content" id="main_form">
            @include('projects::projects.steps-'.$step)
            <input type="hidden" name="CURRENT_STEP" value="{{ $step ?? 1}}" />

        </div>
    {{--  </form>  --}}
</div>
@include('admin.layouts.forms.close')
@stop
@section('after_foot')
@include('admin.layouts.image')
@include('projects::projects.change')
@stop
