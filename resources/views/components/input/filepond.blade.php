@props([
    'value' => '',
    'required' => false,
    'preview' => false,
    'class' => '',
])
<div wire:ignore
     x-data="{model: @entangle($attributes->wire('model'))}"
     x-init="
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.create($refs.input) ;
    FilePond.setOptions({
        allowMultiple : {{ isset($attributes['multiple']) ? 'true' : 'false'}},
        server: {
            process : ( fieldName, file, metadata, load, error, progress, abort, transfer, options) =>{
                @this.upload('{{$attributes['wire:model']}}',file,load,error,progress)
            },
            revert : ( fieldName, load) =>{
            @this.removeUpload('{{$attributes['wire:model']}}',fileName,load)
            }
        }
    });
    ">
    <input type="file" wire:model="{{$attributes['wire:model']}}" x-ref="input">
</div>

