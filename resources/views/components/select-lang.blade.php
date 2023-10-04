@props([
    'options' => null,
    'selected' => '',
    'multiple' => false,
    'name' => '',
    'class' => '',
        'model' => '',
        'placeholder' => ''
])

<select
    wire:model="{{ $model }}"
    class="form-control {{ $class }}" name="{{ $name }}" @if($multiple) multiple @endif>
    @if($placeholder)
        <option value="">{{ __('message.select',['model'=>__('names.'.$placeholder)] ) }}</option>
    @endif
    @if ($options)
        @foreach ($options as $key => $option)
            <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>
                {{ $option[auth()->user()->lang] }}
            </option>
        @endforeach
    @endif
</select>
