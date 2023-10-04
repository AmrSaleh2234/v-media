@extends('projects::layouts.master')
@section('title')
    @if (isset($title))
        {{ $title }}
    @else
        {{ __('Projects') }}
    @endif
@stop


@section('content')
    <users-chat project-id="{{$id}}" ></users-chat>
@stop

@push('script')
<script>
    // const chatsContainer =
    //     document.getElementById("chat-cards-container");
    // let height = chatsContainer.offsetHeight;
    // console.log(height);
    // chatsContainer.scrollTop(height);
</script>
@endpush
