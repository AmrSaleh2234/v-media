@extends('projects::layouts.master')
@section('title')
    @if (isset($title))
        {{ $title }}
    @else
        {{ __('Projects') }}
    @endif
@stop
@section('breadcrumb')
    <x-breadcrumb :tree="$tree" current="tasks" ></x-breadcrumb>
@endsection
@section('content')

    <section class="row-reverse project-page">

        <chat project-id="{{$project->id}}" ></chat>

        <div class="page-content">
            <div class="double-tables">
                <div class="side">
                    <div class="bg-container">
                       @include('Projects::projects.components.tasks-table' , ['tasks' => $tasks])
                    </div>
                </div>
            </div>
        </div>
    </section>



@stop
