@if (isset($emp_vacations))
    <div class="row">
        <div class="col-md-4">
            <p class="data-titel">{{ __('اسم الاجازة') }}</p>
            <p class="data-content">{{ $emp_vacations['name'] }}</p>
        </div>
        <div class="col-md-4">
            <p class="data-titel">{{ __('تاريخ التعيين') }}</p>
            <p class="data-content">{{ $emp_vacations['date_of_hiring'] }}</p>
        </div>
        <div class="col-md-4">
            <p class="data-titel">{{ __('تاريخ استحقاق الاجازات') }}</p>
            <p class="data-content">{{ $emp_vacations['due_date'] }}</p>
        </div>
    </div>
    <h6>{{ __('الية الاجازات قبل المدة') }}</h6>
    <div class="row">
        <div class="col-md-12">
            <p class="data-content">
            </p>
        </div>
        <div class="col-md-2">
            <p class=" mb-2">
                {{ __('رصيد الاجازات') }}
            </p>
            <p>
                <b>
                    {{ $emp_vacations['vacation_credit'] }}
                </b>
            </p>
        </div>
        <div class="col-md-2">
            <p class="mb-2">
                {{ __('مدة العمل') }}
            </p>
            <p class="data-content">
                <b>
                    {{ $emp_vacations['work_duration'] }}
                </b>
            </p>
        </div>
        <div class="col-md-12">
            <h6>{{ __('اذن الاجازات') }}</h6>
        </div>
        <div class="col-md-12 row">
            <div class="col-md-2">
                <p class=" mb-2">
                    {{ __('خصم من الرصيد') }}
                </p>
                <p>
                    <b>
                        {{ $emp_vacations['vacation_deduction'] }}
                    </b>
                </p>
            </div>
            <div class="col-md-2">
                <p class="mb-2">
                    {{ __('بدون انذار') }}
                </p>
                <p class="data-content">
                    <b>
                        {{ $emp_vacations['without_warning'] }}
                    </b>
                </p>
            </div>
        </div>
    </div>
@endif
