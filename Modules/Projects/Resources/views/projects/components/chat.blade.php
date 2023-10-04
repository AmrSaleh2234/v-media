<div class="chat-section" id="chatSection">
    <h3>{{__('projects::names.tasks-chat')}}</h3>
    <div class="messages-container">
        @foreach($messages as $message)
            <div class="message-row">
                <div class="message-card">
                    <div class="head">
                        <div class="person-info">
                            <img
                                src="{{ 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50' ?? asset(optional($message->from)->image)   }}"
                                alt="profile pic"
                                class="user-image-chat"
                            />
                            <h3 class="name"><a href="{{ route('admin.users.show',$message->from->id ) }}"></a>{{optional($message->from)->name}}</h3>
                        </div>
                        <div class="message-privacy">
                            <div class="message" privacy="@if($message->public){{'public'}}@else{{'private'}}@endif"></div>
                        </div>
                    </div>
                    <p class="content">
                        {{ $message->content }}
                    </p>
                </div>
                <div class="message-buttons">
                    <i class="icon-category"></i>
                    <i class="icon-chart"></i>
                </div>
            </div>
        @endforeach

    </div>
    <form class="send-message-form" method="post" action="{{ route('admin.projects.store') }}">
        <input type="text" name="content" placeholder="{{ __('projects::messages.write-your-message') }}" />

        <i class="icon-category"></i>
        <i class="icon-chart"></i>
    </form>
</div>
