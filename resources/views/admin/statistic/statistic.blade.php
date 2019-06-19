@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                    <form role="form" action="{{route('statistic.index') }}" method="post" class="form-inline">
                        @csrf
                        <div class="form-group" style="width: 350px">
                            <div class="input-group"style="width: 100%">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text"name="date" value="{{$date}}" class="form-control pull-right" id="reservation">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('label.search')}}</button>
                    </form>
            </div>
        </div>
        <!-- /.box -->
        <div class="row">
            <div class="col-md-7">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('label.order')}}</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <canvas id="pieChart" style="height:250px"></canvas>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-5">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('label.finance')}}</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <canvas id="pieChartFinance" style="height:250px"></canvas>
                        <ul>
                            <li>{{ __('label.finance_in') }} : <span class="price">{{$finance->finance_in}}</span></li>
                            <li>{{ __('label.finance_out') }} : <span class="price">{{$finance->finance_out}}</span></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/daterangepicker/daterangepicker.css">
@endsection

@section('script')
    <script src="{{asset('admin')}}/plugins/chartjs/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{asset('admin')}}/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="{!! asset('public/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script>
        $(function () {
            $('.price').number( true, 0 );

            $('#reservation').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas);
            var PieData = [
                {
                    value: {{$order->waiting}},
                    color: "#f56954",
                    highlight: "#f56954",
                    label: "{{__('label.waiting')}}"
                },
                {
                    value: {{$order->no_delivery}},
                    color: "#00a65a",
                    highlight: "#00a65a",
                    label: "{{__('label.no_delivery')}}"
                },
                {
                    value: {{$order->being_delivery}},
                    color: "#f39c12",
                    highlight: "#f39c12",
                    label: "{{__('label.being_delivery')}}"
                },
                {
                    value: {{$order->done_delivery}},
                    color: "#00c0ef",
                    highlight: "#00c0ef",
                    label: "{{__('label.done_delivery')}}"
                },
                {
                    value: {{$order->customer_cancel}},
                    color: "#3c8dbc",
                    highlight: "#3c8dbc",
                    label: "{{__('label.customer_cancel')}}"
                },
                {
                    value: {{$order->iht_cancel}},
                    color: "#d2d6de",
                    highlight: "#d2d6de",
                    label: "{{__('label.iht_cancel')}}"
                }
            ];
            var pieOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                responsive: true,
                maintainAspectRatio: true,
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions);


            // Finance
            var pieChartCanvasFinance = $("#pieChartFinance").get(0).getContext("2d");
            var pieChartFinance = new Chart(pieChartCanvasFinance);
            var PieDataFinance = [
                {
                    value: {{($finance->finance_in) ? $finance->finance_in : 0}},
                    color: "#f56954",
                    highlight: "#f56954",
                    label: "{{__('label.finance_in')}}"
                },
                {
                    value: {{($finance->finance_out) ? $finance->finance_out : 0}},
                    color: "#00a65a",
                    highlight: "#00a65a",
                    label: "{{__('label.finance_out')}}"
                }
            ];
            var pieOptionsFinance = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                responsive: true,
                maintainAspectRatio: true,
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChartFinance.Doughnut(PieDataFinance, pieOptionsFinance);
        });
    </script>

@endsection