@extends('projects::layouts.master')
@section('title')
    @if (isset($title))
        {{ $title }}
    @else
        {{ __('projects::names.workspace') }}
    @endif
@stop
@section('main-class')
    projects-managements-page project-items responsive-page
@endsection

@section('content')

    <section class="row-reverse project-page">

        <mini-chat project-id="{{$project->id}}" ></mini-chat>

        <div class="page-content">
            <div class="double-tables">
                <div class="side">
                    <div class="bg-container">
                        @include('projects::projects.components.items-table' , ['items' => $project->items])
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
