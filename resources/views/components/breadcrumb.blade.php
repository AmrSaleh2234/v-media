@props([
    'class' => '',
    'tree' => [url('/admin')=>'dashboard'],
    'current' => '',
     'name' => ''

])

<ol class="breadcrumb">
    @foreach($tree as $href => $title)
        <li class="breadcrumb-item ">
            <a href="{{$href}}">{{__('names.'.$title)}}</a>
        </li>
    @endforeach
    <li class="breadcrumb-item active" aria-current="page">@if(!empty($current)) {{__('names.'.$current)}}@endif @if(!empty($name)){{$name}} @endif </li>
</ol>
