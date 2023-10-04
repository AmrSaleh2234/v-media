<div class="contracts-types-navigations">
    <a class="{{ $active == 'newest' ? 'active' : '' }}"
        href="{{ route('admin.contract.type', 'newest') }}">{{ __('projects::names.new-contracts') }}</a>
    <a class="{{ $active == 'transfered' ? 'active' : '' }}"
        href="{{ route('admin.contract.type', 'transfered') }}">{{ __('projects::names.transfered-contracts') }}</a>
</div>
