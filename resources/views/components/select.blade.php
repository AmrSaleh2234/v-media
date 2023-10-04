@props([
    'options' => null,
    'selected' => '',
    'name' => '',
    'class' => '',
        'model' => '',
        'placeholder' => ''
])

<select
    wire:model="{{ $model }}"
    class="form-control {{ $class }}" name="{{ $name }}">
    @if($placeholder)
        <option value="">{{ __('message.select',['model'=>__('names.'.$placeholder)] ) }}</option>
    @endif
    @if ($options)
        @foreach ($options as $key => $option)

            <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    @endif
</select>
