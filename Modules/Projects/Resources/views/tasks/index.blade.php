@extends('projects::layouts.master')
@section('title')
    @if (isset($title))
        {{ $title }}
    @else
        {{ __('Projects') }}
    @endif
@stop
@section('classes')
    projects-managements-page responsive-page
@endsection

@section('content')
    <form method="get" action="{{route('admin.projects.index')}}"  >
    <div class="search-container double">
            <div class="inputs-container search-inputs-container">
                <input type="search" for="project_name" name="project_name" value="{{ request()->get('project_name') }}"  placeholder="{{ __('projects::names.project-name') }}" />
                <input type="search" for="manager-name" name="responsible_name" value="{{ request()->get('responsible_name') }}" placeholder="{{ __('projects::names.responsible-name') }}" />
            </div>
            <div class="buttons-container">
                <button class="main-btn" type="submit">{{__('Search')}}</button>
            </div>
    </div>
    </form>

    <example-component title="Hello" message="Welcome to Laravel"></example-component>

    <section class="p-4">
        <div class="double-tables">
            <div class="side">
                <div class="bg-container">
                    <h3>{{ __('projects::names.missions') }}</h3>
                    <div class="table-container">
                       @include('projects::projects.components.mini-table' ,['projects' => $notAssignedProjects ])
                        {{ $notAssignedProjects->links() }}
                    </div>
                </div>
            </div>
            <div class="side">
                <div class="bg-container">
                    <h3>{{ __('projects::names.projects') }}</h3>
                    @include('projects::projects.components.mini-table' ,['projects' => $assignedProjects ])
                    {{ $assignedProjects->links() }}
                </div>
            </div>
        </div>
        <div class="progress-bar-section">

            <h4>{{ __('projects::names.all-projects') }}</h4>

            <div class="progress-bar-container">
                <div class="bar" id="porjectsBar">
                    <div class="outer-bar-value" id="outerBarValue" value="2">0</div>
                    <div class="inner-bar" value="8">0</div>
                </div>
                <div class="titles">
                    <p>{{ __('projects::names.required-projects-count') }}</p>
                    <p>{{ __('projects::names.finished-projects-count') }}</p>
                </div>
            </div>
        </div>
    </section>



@stop
