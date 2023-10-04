@props([
    'disabled' => false,
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'name' => '',
    'row' => '3',
    'class' => '',
])

<textarea  row="{{ $row }}"  {{ $disabled ? 'disabled' : '' }}
    {{ $required ? 'required' : '' }} placeholder="{{ $placeholder }}" name="{{ $name }}"
    {!! $attributes->merge([
        'class' => 'form-control ' . $class,
    ]) !!}>{{ $value }}</textarea>
