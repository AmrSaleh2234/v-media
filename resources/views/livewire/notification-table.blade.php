<div class="">
    <h3 class="text-center">{{ __('names.all-notifications') }}</h3>

@forelse($unReadNotifications as $notification)
        <div class="notification-lg-card new">
            <div class="name-date-container">
                <div class="name">{{$notification->data['from']}}</div>
                <div class="date">{{$notification->created_at->diffForHumans()}}</div>
            </div>
            <div class="content">
                <a href="{{ $notification->data['url'] ?? '#' }}">
                    {{$notification->data['message']}}
                </a>
            </div>
        </div>
    @empty
        <div class="" style="height: 100px">{{ __('names.no-new-notification') }}</div>
    @endforelse

{{--    <h3>{{ __('names.read-notifications') }}</h3>--}}
{{--    @forelse($readNotifications as $notification)--}}
{{--        <div class="notification-lg-card new">--}}
{{--            <div class="name-date-container">--}}
{{--                <div class="name">{{$notification->data['from']}}</div>--}}
{{--                <div class="date">{{$notification->created_at->diffForHumans()}}</div>--}}
{{--            </div>--}}
{{--            <div class="content">--}}
{{--                <a href="{{ $notification->data['url'] ?? '#' }}">--}}
{{--                    {{$notification->data['message']}}--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @empty--}}
{{--        <div class="" style="height: 100px">{{ __('names.no-read-notification') }}</div>--}}
{{--    @endforelse--}}
</div>
