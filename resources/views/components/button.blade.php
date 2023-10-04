@props([
    'class' => '',
    'icon' => '',
    'color' => 'primary',
    'disabled' => false,
    'type' => 'button'
])
<button type="{{$type}}" class="btn btn-{{$color}} {{$class}}" @if($disabled) disabled @endif >
    {{ $slot }}
    @if($icon)  <i  data-lucide="{{$icon}}"></i> @endif
</button>
