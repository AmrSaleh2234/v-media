@props([
    'name' => '',
    'file' => null,
    'model' => '',
    'path' => null,
    'max_size' => 10,
    'original_name' => '',
    'size' => '--',
    'extension' => '',
])
<div class="" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress">
    <label class="select-image">
        <div class="file-info-card {{ $file == null ? 'd-none' : '' }}">
            <div class="file-extension">{{ $file?->extension() }}
            </div>
            <div class="file-name-and-size">
                <h5>{{ $file?->getClientOriginalName() ?? '' }}</h5>
                <p>{{ round($file?->getSize() / (1024 * 1024), 2) }} MB</p>
            </div>
            <div>
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path
                            d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z">
                        </path>
                    </svg>
                </span>
            </div>
        </div>

        <div class="to-hide {{ $file == null && $path == null ? '' : 'd-none' }}">
            <p>ارفاق صورة</p>
            <span>حجم الصورة لا يزيد عن {{ $max_size }}MB</span>
            <span class="icon icon-add">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                    </path>
                </svg>
            </span>
            <input type="file" wire:model="{{ $model }}" class="image-upload" style="display: none">
        </div>
        <div class="file-info-card-no-action {{ $file == null && $path != null ? '' : 'd-none' }}">
            <div class="file-extension">
                @php $mimes = ['png', 'gif', 'bmp', 'svg', 'wav', 'mp4','mov', 'avi', 'wmv', 'mp3', 'm4a','jpg', 'jpeg', 'mpga', 'webp', 'wma']; @endphp

                @if (!empty($extension))
                    <img src="{{ in_array($extension, $mimes) ? $path : asset('assets/images/upload.png') }}"
                        alt="" />
                @else
                    <img src="{{ $path }}" alt="" />
                @endif
            </div>
            <div class="file-name-and-size">
                <h5>{{ $original_name ?? __('names.upload-file') }}</h5>
                <p>{{ $size }}</p>
            </div>
            <div>
                <a href="{{ $path }}" download class="icon">
                    <i class="bx bx-download bx-sm"></i>
                </a>
            </div>

        </div>

    </label>
    <div class="w-100 " x-show="isUploading">
        <progress class="w-100" x-bind:value="progress"></progress>
    </div>
</div>
