@extends('projects::layouts.master')
@section('title')
    @if (isset($title))
        {{ $title }}
    @else
        {{ __('Projects') }}
    @endif
@stop
@section('breadcrumb')
    <x-breadcrumb :tree="$tree" current="projects" ></x-breadcrumb>
@endsection

@section('content')
    <form method="get" action="{{ route('admin.projects.index') }}">
    <div class="row">

            <div class="col">
                <input type="search" class="form-control" for="project_name" name="project_name" value="{{ request()->get('project_name') }}"
                       placeholder="{{ __('projects::names.project-name') }}" />
            </div>
            <div class="col">
                <input type="search"  class="form-control" for="manager-name"  name="responsible_name"
                       value="{{ request()->get('responsible_name') }}"
                       placeholder="{{ __('projects::names.responsible-name') }}" />
            </div>
            <div class="col-md-1">
                <button class="btn btn-primary" type="submit">{{ __('Search') }}</button>
            </div>

    </div>
    </form>

    <section class="py-4">
        <div class=" d-flex justify-content-between">
            <div class="table-with-header mx-1" >
                    <h3 class="title">{{ __('projects::names.missions') }}</h3>
                    <div class="table-container">
                        @include('projects::projects.components.mini-table', [
                            'projects' => $notAssignedProjects,
                        ])
{{--                        {{ $notAssignedProjects->links() }}--}}
                    </div>
            </div>
            <div class="table-with-header mx-1">
                    <h3 class="title">{{ __('projects::names.projects') }}</h3>
                    @include('projects::projects.components.mini-table', ['projects' => $assignedProjects])
{{--                    {{ $assignedProjects->links() }}--}}
            </div>
        </div>
        <div class="progress-bar-section">

            <h4>{{ __('projects::names.all-projects') }}</h4>

            <div class="progress-bar-container">
                <div class="bar" id="porjectsBar">
                    <div class="outer-bar-value" id="outerBarValue" value="{{ $requiredProjects }}">
                        {{ $requiredProjects }}</div>
                    <div class="inner-bar" value="{{ $finishedProjects }}">{{ $finishedProjects }}</div>

                </div>
                <div class="titles">
                    <p>{{ __('projects::names.required-projects-count') }}</p>

                    <p>{{ __('projects::names.finished-projects-count') }}</p>
                </div>
            </div>
        </div>
    </section>



@stop
