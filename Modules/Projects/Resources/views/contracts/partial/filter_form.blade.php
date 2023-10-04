<form class="contracts-search-component" action="{{ route('admin.contracts.index') }}" method="get">

    <div class="inputs-container search-inputs-container">
        <input type="text" value="{{ request()->get('contract_number') }}" name="contract_number"
            placeholder="{{ __('projects::names.contract-number') }}" for="contract-number" />
        <input type="text" name="client_phone" value="{{ request()->get('client_phone') }}"
            placeholder="{{ __('projects::names.client-phone') }}" for="customer-number" />
        <input type="text" value="{{ request()->get('client_nationality') }}" name="client_nationality"
            placeholder="{{ __('projects::names.client-nationality') }}" for="customer-id" />
    </div>
    <div class="buttons-container">
        <button class="default" type="submit">
            {{ __('projects::names.search') }}
        </button>
        <a href="{{ route('admin.contracts.create') }}">
            <i class="icon-add"></i>
            {{ __('projects::names.add-contract') }}
        </a>
    </div>

</form>
