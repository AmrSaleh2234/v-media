@extends('projects::layouts.master')
@section('title')
    @if (isset($title))
        {{ $title }}
    @else
        {{ __('Projects') }}
    @endif
@stop
@section('breadcrumb')
    <x-breadcrumb :tree="$tree" current="project" :name="$project->name" ></x-breadcrumb>
@endsection

@section('content')

        <div class="three-top-cards">
            <div class="top-card">
                <h3>{{ __('projects::names.current-tasks') }}</h3>
                <div class="content ongoing-projects">
                    @foreach($project->tasks as $task)
                        <div class="card-section">
                         <h4>    <a href="{{ route('admin.tasks.show',$task->id) }}"> {{$task->name}}</a></h4>
                            @foreach($task->users as $user)
                                <a href="{{ route('admin.users.show',$user->id) }}"><p>{{ $user->name }}</p></a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="top-card">
                <div class="content status-bars">
                    <div class="row">
                        <div class="right">
                            <h4>{{ __('projects::names.items')}}</h4>
                        </div>
                        <div class="left">
                            <h4>{{__('projects::names.status')}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($project->tasks as $task)
                            <div class="right">
                                <a href="{{ route('admin.tasks.show',$task->id) }}"><p>{{$task->name}}</p></a>
                            </div>
                            <div class="left">
                                <div class="status-bar-container" value="{{$task->progress}}">
                                    <div class="percentage"></div>
                                    <div class="bar">
                                        <div class="fill"></div>
                                    </div>
                                    <div class="dates-container">
                                        <div class="start-date">
                                            <p>{{ __('projects::names.start-date') }}</p>
                                            <p>{{$task->start_at}}</p>
                                        </div>
                                        <div class="end-date">
                                            <p>{{ __('projects::names.end-date') }}</p>
                                            <p>{{$task->expected_at}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="top-card ongoing-projects projects-count overflow-hidden">
                <h3>{{ __('projects::names.required-tasks-count') }}</h3>
                <div class="circular-card ">

                    <h2>{{$project->req_tasks_count}}</h2>
                    <h5>{{ __('projects::names.required-tasks-count') }}</h5>
                    <small>{{ $project->progress }} %</small>
                </div>
            </div>
        </div>


        <section class="row-reverse project-page">

            <mini-chat project-id="{{$project->id}}"  :url="{{ json_encode(route('admin.chat',$project->id)) }}"></mini-chat>

            {{-- @include('projects::projects.components.project-details',$project ) --}}


           <Tabs>
               <Tab  title="{{ __('projects::names.project-info') }}" >
                   <div class="data-item">
                       <h4>{{ __('projects::names.client-name') }}</h4>
                       <p>{{ optional($project->client)->name }}</p>
                   </div>
                   <div class="data-item">
                       <h4>{{ __('projects::names.contract-number') }}</h4>
                         <p>{{ optional($project->contract)->number }}</p>
                     </div>
                     <div class="data-item">
                         <h4>{{ __('projects::names.project') }}</h4>
                         <p>{{ $project->name }}</p>
                     </div>
                     <div class="data-item">
                         <h4>{{ __('projects::names.location-details') }}</h4>
                         <p>{{ $project->location }}</p>
                     </div>
                     <div class="data-item">
                         <h4>{{ __('projects::names.start-date') }}</h4>
                         <p>{{ $project->startAt }}</p>
                     </div>
                     <div class="data-item">
                         <h4>{{ __('projects::names.end-date') }}</h4>
                         <p>{{ $project->end_date ?? $project->expectedAt }}</p>
                     </div>
                     <div class="data-item">
                         <h4>{{ __('projects::names.responsible-engineer') }}</h4>
                         <p>{{ optional($project->responsible)->name }}</p>
                     </div>
                 </Tab>
                 <Tab  title="{{ __('projects::names.items') }}" >this is tab items</Tab>
                 <Tab  title="{{ __('projects::names.attachments') }}" >this is tab attachments</Tab>
                 <Tab  title="{{ __('projects::names.appointments') }}" >this is tab appointments</Tab>
                 <Tab  title="{{ __('projects::names.reports') }}" >this is tab reports</Tab>
                 <Tab  title="{{ __('projects::names.finance') }}" >this is tab finance</Tab>
                 <Tab  title="{{ __('projects::names.movement-log') }}" >this is tab movement-log</Tab>
                 <Tab  title="{{ __('projects::names.requests') }}" >this is tab requests</Tab>
                 <Tab  title="{{ __('projects::names.workspace') }}" >
                      @include('projects::projects.components.tasks-table' , ['tasks' => $tasks])
                 </Tab>
             </Tabs>

{{--              <Items items="{{$projectItems}}"></Items>--}}

        </section>

@stop

@section('after_foot')
<script type="module">

    $(document).ready(function () {
        function HandleProjectStatusBars(className) {
            const container = document.getElementsByClassName(className);
            for (let i = 0; i < container.length; i++) {
                const containerElement = container[i];
                let value = parseInt(containerElement.getAttribute("value"));
                const percentageElement =
                    containerElement.getElementsByClassName("percentage")[0];
                const barElement = containerElement
                    .getElementsByClassName("bar")[0]
                    .getElementsByClassName("fill")[0];
                // Actions Goes Here
                barElement.style.transitionDelay = `${i * 400}ms`;
                percentageElement.innerText = value;
                barElement.style.width = `${value}%`;
                // Adding Colors To the bars by conditions
                if (value <= 30) {
                    barElement.classList.add("yellow");
                } else if (value <= 70) {
                    barElement.classList.add("blue");
                } else if (value > 70) {
                    barElement.classList.add("green");
                }
            }
        }

        HandleProjectStatusBars("status-bar-container");
    });

</script>
@stop
