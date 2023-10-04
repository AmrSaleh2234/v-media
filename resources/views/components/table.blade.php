@props([
    'class' => '',
    'responsive' => true
])

<table class="table table-hover table-borderless {{ $class }} @if($responsive) table-responsive-md  @endif" >
    {{ $slot }}
</table>
