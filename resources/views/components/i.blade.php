@props([
    'class' => '',
    'icon' => '',
    'color' => '',
    'disabled' => '',
])
<i data-lucide="{{$icon}}" class="{{$class}}" @if($disabled) disabled @endif  >
    {{ $slot }}
</i>
