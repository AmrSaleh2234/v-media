@extends('projects::layouts.master')
@section('title')
    @if (isset($title))
        {{ $title }}
    @else
        {{ __('Messages') }}
    @endif
@stop
@section('classes')
    projects-managements-page project-items responsive-page
@endsection

@section('content')
<section class="projects-chat-page">
    <div class="chat-users-container">
        <div class="search-bar">
            <input type="text" placeholder="{{ __('projects::names.enter-username') }}" />
            <div class="search-icon">Search</div>
        </div>
        <div class="cards-container">
            @foreach($task->messages as $message)
                <div class="chat-card">
                    <div class="right">
                        <img
                            src="{{ asset($message->user->image) }}"
                            alt=""
                        />
                    </div>
                    <div class="left">
                        <div class="head">
                            <h4>{{ $message->user->name }}</h4>
                            <div class="time-and-active" active="active">
                                <h4>{{ $message->created }}</h4>
                            </div>
                        </div>
                        <p class="message-content">
                            {{ $message->content }}
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <div class="user-chat-container">
        <div class="head">
            <div class="user-info">
                <div class="user-profile-image">
                    <img
                        src="{{ asset($user->image) }}"
                        alt="{{$user->name }}"
                    />
                </div>
                <h4>{{ $user->name }}</h4>
            </div>
            <div class="settings-icon">
                <i class="icon-trash"></i>
            </div>
        </div>
        <div class="messages-container" id="chat-cards-container">
            @foreach($user->messages as $message)
                <div class="message-container" by="@if($message->user_id == auth()->id()) user @else other @endif">
                    <div class="message-card">
                        <div class="content">
                            {{ $message->user->name }}
                        </div>
                        <div class="time">{{ $message->created }}</div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
@stop
