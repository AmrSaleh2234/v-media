@props([
    'options' => null,
    'selected' => '',
    'name' => '',
    'class' => '',
])
<div x-data="{
    model: @entangle($attributes->wire('model')),
}" x-init="select2 = $($refs.select)
    .not('.select2-hidden-accessible')
    .select2({
        theme: 'bootstrap',
        width: '100%',
        minimumResultsForSearch: 10,
    });
select2.on('select2:select', (event) => {
    model = Array.from(event.target.options).filter(option => option.selected).map(option => option.value);
});
select2.on('select2:unselect', (event) => {
    model = Array.from(event.target.options).filter(option => option.selected).map(option => option.value);
});
$watch('model', (value) => {
    select2.val(value).trigger('change');
});" wire:ignore>
    <select x-ref="select" class="form-control {{ $class }}">
        {{ $slot }}
    </select>
</div>
