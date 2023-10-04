@props([
    'value' => '',
    'required' => false,
    'class' => '',
        'lang' => '',
])

<label {{ $attributes->merge(['class' => 'block label-bold ' . ' ' . $class]) }}>
    {{ $value ?? $slot }}
    @if($lang === 'ar')
        {{ __('names.arabic') }}
    @elseif($lang === 'en')
        {{ __('names.english') }}
    @endif
    @if ($required)
        <span class="text-danger"> * </span>
    @endif
</label>
