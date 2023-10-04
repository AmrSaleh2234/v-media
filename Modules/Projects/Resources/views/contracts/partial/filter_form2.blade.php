<form class="contracts-search-component" action="{{ route('admin.contract.index') }}" method="get">
    <div class="inputs-container search-inputs-container">
      <input type="text" value="{{ request()->get('contract_number') }}" name="contract_number" placeholder="{{ __('projects::names.contract-number') }}" for="contract-number" />
      <input type="text" name="contract_type" value="{{ request()->get('contract_type') }}" placeholder="{{ __('projects::names.contract-type') }}" for="customer-number" />
      <input type="text" value="{{ request()->get('management_name') }}" name="management_name" placeholder="{{ __('projects::names.management-name') }}" for="customer-id" />
    </div>
    <div class="buttons-container">
        <button class="default" type="submit">
            {{ __('projects::names.search') }}
          </button>
          <a href="{{ route('admin.contract.create') }}">
            <i class="icon-add"></i>
            {{ __('projects::names.add-contract') }}
          </a>
    </div>
  </form>
