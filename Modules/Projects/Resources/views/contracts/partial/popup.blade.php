<div class="main-popup-container create-new-contract-popup" id="add-new-project-item-popup">
    <div class="popup">
        <div class="close-btn close-all-popups">
            <button>
                <i class="icon-close-square"></i>
            </button>
        </div>
        <div class="content">
            <h3 class="name">{{ __('projects::names.add-item') }}</h3>
            <h4>{{ __('projects::names.choose-item-type') }}</h4>
            <div class="check-boxes-container">
                <div class="item-container">
                    <input type="checkbox" checked name="main_item" />
                    <label for="main-item">{{ __('projects::names.main-item') }}</label>
                </div>
                <div class="item-container">
                    <input type="checkbox" name="sub_item" />
                    <label for="sub-item">{{ __('projects::names.sub-item') }}</label>
                </div>
            </div>
            <form action="{{ route('admin.contract.saveItems') }}" method="post" id="add_items_form">
                @csrf
                <div class="section" id="add-project-item-container">
                    <div class="inputs-container">
                        <label for="mian-item-title">{{ __('projects::names.item-title') }}</label>
                        <input required type="text" name="main_item_title" class="main-input"
                            placeholder="{{ __('projects::names.item-title') }}" />
                    </div>
                    <div class="inputs-container">
                        <label for="mian-item-title">{{ __('projects::names.amount') }}</label>
                        <input required type="text" name="main_item_amount" class="main-input"
                            placeholder="{{ __('projects::names.amount') }}" />
                    </div>
                    <div class="inputs-container">
                        <label for="mian-item-title">{{ __('projects::names.duration') }}</label>
                        <input required type="text" name="main_item_period" class="main-input"
                            placeholder="{{ __('projects::names.duration') }}" />
                    </div>


                </div>
                <button type="button" class="add-new-sub-item" id="add_new_sub_item" data-count="1">
                    <span> {{ __('projects::names.add-sub-item') }} </span>
                    <i class="icon-close-square"></i>
                </button>
                <div class="submit-container">
                    <button type="submit" class="btn-main">
                        {{ __('projects::names.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
