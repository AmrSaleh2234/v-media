<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="client" ></x-breadcrumb>
    @endsection
        <div class="names-values-container">
            <div class="item">
                <h6>{{ __('names.client-name') }}</h6>
                <h5 class="">{{ $client->name}}</h5>
            </div>
            <div class="item">
                <h6 class="">{{ __('names.email') }}</h6>
                <h5 class="">{{ $client->email}}</h5>
            </div>
            <div class="item">
                <h6 class="">{{ __('names.phone-number') }}</h6>
                <h5 class="">{{ $client->phone}}</h5>
            </div>
        </div>
        <div class="chart-container">
            <div class="right-side">
                <h4>بيان مالي للعقود</h4>
                <div class="spec-table">
                    <table class="spec-table">
                        <thead>
                        <tr>
                            <th>الاجمالي</th>
                            <th>{{ ($payments) }} SAR</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="color-ok">
                            <td>المدفوع</td>
                            <td>{{ ($payments) }} SAR</td>
                        </tr>
                        <tr class="color-stopped">

                            <td>المتبقى</td>
                            <td>{{ round($payments,2) }} SAR</td>
                        </tr>
                        <tr class="color-late">
                            <td>المطلوب</td>
                            <td>{{ round($payments,2) }} SAR</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="left">
                <canvas
                    id="chartId"
                    aria-label="chart"
                    height="300"
                    width="300"
                ></canvas>
            </div>
        </div>
        <section class="p-4 bg-gary">

            <div class="d-flex flex-row justify-content-between align-items-center">
                <div class="contracts-data">
                    <h4>حالات العقود</h4>
                    <div class="colored-numbers">
                        @forelse($statuses as $status)
                            <span class="colored-number active-number">{{rand(1,9)}}</span>
                            <span class="colored-number late-number">{{rand(1,9)}}</span>
                            <span class="colored-number expired-number">{{rand(1,9)}}</span>
                            <span class="colored-number stopped-number">{{rand(1,9)}}</span>
                            {{--                    <span class="colored-number color-{{$status->color}}">{{$status->total}}</span>--}}
                        @empty
                            <span class="colored-number active-number">{{rand(1,9)}}</span>
                            <span class="colored-number late-number">{{rand(1,9)}}</span>
                            <span class="colored-number expired-number">{{rand(1,9)}}</span>
                            <span class="colored-number stopped-number">{{rand(1,9)}}</span>
                        @endforelse

                    </div>
                </div>
                <form method="GET"  class="search-line-form">
                    <x-text-input  :required="false" name="contract_number" :value="request()->input('contract_number') ?? null"
                                  placeholder="{{ __('names.contract-number') }}"></x-text-input>
                <button type="submit" class="main-button mb-3">بحث</button>
                </form>

                <div class="">
                    <a class="main-button" href="{{ route('admin.clients.edit',$client->id) }}">
                        <i class="icon-add"></i>
                        {{ __('تعديل العميل') }}
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="box">
                        <div class="box-body">
                            <x-table :responsive="true">
                            @include('admin.clients.contracts-table')
                            </x-table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @include('admin.inc._log')
        @push('script')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script>
            <script type="module">
                $("document").ready(function () {
                    var chrt = document.getElementById("chartId").getContext("2d");
                    var chartId = new Chart(chrt, {
                        type: "pie",
                        data: {
                            labels: ["ساري", "متوقف", "منتهي", "متأخر"],
                            datasets: [
                                {
                                    label: "online tutorial subjects",
                                    data: [20, 40, 13, 35],
                                    backgroundColor: [
                                        "#CCEBC5",
                                        "#FBB4AE",
                                        "#D0DCE9",
                                        "#FED9A6",
                                    ],
                                    hoverOffset: 10,
                                    offset: 2,
                                },
                            ],
                        },
                        options: {
                            responsive: false,
                            plugins: {
                                legend: {
                                    labels: {
                                        // This more specific font property overrides the global property
                                        font: {
                                            size: 20,
                                        },
                                    },
                                },
                            },
                        },
                    });
                });
            </script>
        @endpush
</x-admin-app>





