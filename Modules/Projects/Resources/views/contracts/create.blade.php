@extends('projects::layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('breadcrumb')
    <x-breadcrumb :tree="$tree" current="create-contract" ></x-breadcrumb>
@endsection




@section('content')
    @include('projects::partial.sessions')
    <div class="form-container">
        <form action="{{ route('admin.contracts.store') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="input-section">
                <div class="label-container">
                    <label for="contractType">{{ __('projects::names.contract-type') }}</label>
                    <div class="collapse-container"></div>
                </div>
                <input type="text" id="type" value="{{ old('type') }}" required name="type" />
            </div>
            <div class="contract-completion-percentage">
                <h3> {{ __('projects::names.complete-precent') }}</h3>
                <h3 class="percent" id="changeable_precent">0</h3>
            </div>

            <div class="two-inputs-container">
                <div class="input-section">
                    <div class="label-container">
                        <label for="branch">{{ __('projects::names.branch-name') }}</label>
                        <div class="collapse-container"></div>
                    </div>
                    <select class=" " required name="branch_id" name="branch" id="branch">
                        <option></option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-section">
                    <div class="label-container">
                        <label for="adminstration">{{ __('projects::names.management-name') }}</label>
                        <div class="collapse-container"></div>
                    </div>
                    <select class=" " required name="managment_id" id="managements">

                        @if (old('managment_id'))
                            <option value="{{ old('management_id') }}">
                                {{ __('123') }}
                            </option>
                        @endif
                    </select>
                </div>
            </div>
            {{--  --}}
            <div class="input-section can-be-collapsed">
                <div class="label-container">
                    <label for="subject">
                        {{ __('projects::names.contract-title') }}
                    </label>
                    <div class="collapse-container">
                        <div class="increment percent">5</div>
                        <img src="{{ asset('assets/images/arrow-down.png') }}" />
                    </div>
                </div>

                <input type="text" value="{{ old('title') }}" id="project_title" name="title"
                    placeholder="{{ __('projects::names.contract-title') }}" />
            </div>
            <div class="input-section can-be-collapsed">
                <div class="label-container">
                    <label for="date"> {{ __('projects::names.contract-date') }} </label>
                    <div class="collapse-container">
                        <div class="increment percent">5</div>
                        <img src="{{ asset('assets/images/arrow-down.png') }}" />
                    </div>
                </div>

                <input type="date" id="date" value="{{ old('date') }}" name="date"
                    placeholder="{{ __('projects::names.contract-date') }} " />
            </div>
            <div class="input-section can-be-collapsed">
                <div class="label-container">
                    <label for="owner"> {{ __('projects::names.first-party') }} {{ __('projects::names.owner') }}
                    </label>
                    <div class="collapse-container">
                        <div class="increment percent">5</div>
                        <img src="{{ asset('assets/images/arrow-down.png') }}" />
                    </div>
                </div>

                <select class=" " id="client_id" name="owner_id">
                    <option disabled selected>
                        {{ __('projects::names.first-party') }} {{ __('projects::names.owner') }}
                    </option>
                    @foreach ($owners as $owner)
                        <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>
                            {{ $owner->name }}
                        </option>
                    @endforeach
                </select>

            </div>
            <div class="input-section can-be-collapsed">
                <div class="label-container">
                    <label for="sectond-party"> {{ __('projects::names.second-party') }} </label>
                    <div class="collapse-container">
                        <div class="increment percent">5</div>
                        <img src="{{ asset('assets/images/arrow-down.png') }}" />
                    </div>
                </div>

                <input type="text" id="second_party" value="{{ old('second_party') }}" name="second_party"
                    placeholder=" مكتب ابعاد الرؤية للاستشارات الهندسية " />
            </div>
            <div class="input-section can-be-collapsed">
                <div class="label-container">
                    <label for="assigned"> {{ __('projects::names.assign-works') }} </label>
                    <div class="collapse-container">
                        <div class="increment percent">5</div>
                        <img src="{{ asset('assets/images/arrow-down.png') }}" />
                    </div>
                </div>

                <input required type="text" id="assigned_works" value="{{ old('assigned_works') }}"
                    name="assigned_works" placeholder=" {{ __('projects::names.assign-works') }} " />
            </div>
            <div class="input-section can-be-collapsed">
                <div class="label-container">
                    <label for="definitions"> {{ __('projects::names.defenation') }}</label>
                    <div class="collapse-container">
                        <div class="increment percent">5</div>
                        <img src="{{ asset('assets/images/arrow-down.png') }}" />
                    </div>
                </div>

                <input type="text" required id="definitions" value="{{ old('definitions') }}" name="definitions"
                    placeholder="{{ __('projects::names.defenation') }}" />
            </div>

            <div class="input-section can-be-collapsed">
                <div class="label-container">
                    <label for=""> {{ __('projects::names.work-area') }}</label>
                    <div class="collapse-container">
                        <div class="increment percent">30</div>
                        <img src="{{ asset('assets/images/arrow-down.png') }}" />
                    </div>
                </div>

                <div class="content work-domain-container">

                    <div class="def-card">
                        <div class="name">
                            {{ __('projects::names.add-items') }}
                        </div>
                        <button type="button" id="add-new-project-item-popup-button" class="default add-button">
                            <i class="icon-add"></i>
                        </button>
                    </div>
                    @if (Session::has(csrf_token() . '_items'))
                        @foreach (Session::get(csrf_token() . '_items') as $mainItem)
                            @include('projects::contracts.partial.item', [
                                'item' => $mainItem,
                                'i' => rand(99999, 99999999),
                            ])
                        @endforeach
                    @endif
                    <div id="moreItems"></div>
                </div>
            </div>

            <div class="input-section can-be-collapsed">
                <div class="label-container">
                    <label for="">{{ __('projects::names.payments-conditions') }}</label>
                    <div class="collapse-container">
                        <div class="increment percent">5</div>
                        <img src="{{ asset('assets/images/arrow-down.png') }}" />
                    </div>
                </div>

                <div class="content payment-terms-container">
                    <div class="to-be-increased" id="to-be-increased"></div>
                    <button type="button" class="add-new-installment" id="add-new-installment-button">
                        <i class="icon-add"></i>
                        {{ __('projects::names.add-more-payments') }}
                    </button>
                </div>
            </div>
            <div class="input-section can-be-collapsed">
                <div class="label-container">
                    <label for="commitments"> {{ __('projects::names.commitments') }} </label>
                    <div class="collapse-container">
                        <div class="increment percent">5</div>
                        <img src="{{ asset('assets/images/arrow-down.png') }}" />
                    </div>
                </div>

                <input type="text" value="{{ old('commitments') }}" required id="commitments" name="commitments"
                    placeholder="{{ __('projects::names.commitments') }}" />
            </div>

            <div class="input-section can-be-collapsed">
                <div class="label-container">
                    <label for="commitments"> {{ __('projects::names.add-attachment') }} </label>
                    <div class="collapse-container">
                        <div class="increment percent">5</div>
                        <img src="{{ asset('assets/images/arrow-down.png') }}" />
                    </div>
                </div>

                <input type="file" value="{{ old('attachment') }}" required id="attachments" name="attachment" />
            </div>


            <input class="btn-main w-25 mt-2" type="submit" value="{{ __('projects::names.save') }}" />

        </form>

        <div class="contract-review-container"></div>
    </div>
    <script src="{{ asset('modules/projects/js/lib/jquery.js') }}"></script>
    <script src="{{ asset('modules/projects/js/contract_js/create.js') }}"></script>
    @include('projects::contracts.partial.popup')
    @endsection

