@props([
    'options' => null,
    'selected' => '',
    'name' => 'tags',
    'class' => 'select2 js-example-tags',
])

<select class="form-control  {{ $class }}" multiple name="{{ $name }}">
    @if ($options)
        @foreach ($options as $key => $option)
            <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    @endif
</select>
