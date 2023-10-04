@extends('projects::layouts.master')
@section('title')
    @if (isset($title))
        {{ $title }}
    @else
        {{ __('projects::names.tasks') }}
    @endif
@stop
@section('breadcrumb')
    <x-breadcrumb :tree="$tree" current="task" :name="$task->name" ></x-breadcrumb>
@endsection

@section('content')
    <h2>{{$task->name}} ( {{$task->duration . __('names.day')}}  )</h2>

    <section class="row-reverse project-page">


        <mini-chat project-id="{{$task->project_id}}" ></mini-chat>

        <div class="page-content">
            <div class="double-tables">
                <div class="side">
                    <div class="bg-container">
                       @include('projects::projects.components.tasks-table' , ['tasks' => $task->childrens])
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
