@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
<!--  -->
<!-- Morris charts -->
<link rel="stylesheet" href="/web_assets/AdminLTE/bower_components/morris.js/morris.css">
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
<section class="content">
    <div class="row flex-center">
        <div class="col-xs-12">
            <!-- BAR CHART -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Bar Chart</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">車廠選擇</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="BrandSelect">
                                <option value="0"></option>
                                @foreach ($carBrand as $key => $var)
                                <option value="{{$var->iId}}">{{$var->vCarBrandName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="chart col-sm-12" id="bar-chart" style="height: 300px;"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
<!--  -->
<!-- Morris.js charts -->
<script src="/web_assets/AdminLTE/bower_components/raphael/raphael.min.js"></script>
<script src="/web_assets/AdminLTE/bower_components/morris.js/morris.min.js"></script>  

<!-- FLOT CHARTS -->
<script src="/web_assets/AdminLTE/bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="/web_assets/AdminLTE/bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="/web_assets/AdminLTE/bower_components/Flot/jquery.flot.pie.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="/web_assets/AdminLTE/bower_components/Flot/jquery.flot.categories.js"></script>  
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var url_getdata = "{{ url('web/bigdata/product/getdata')}}";

        function flot_init() {
            /*
            var data = [[0, 0]];
            var dataset = [{ label: "", data: data, color: "#5482FF" }];
            var ticks = [[0, ""]];
            */

            var data = [[0, 11],[1, 15],[2, 25],[3, 24],[4, 13],[5, 18]];
            var dataset = [{ label: "", data: data, color: "#5482FF" }];
            var ticks = [[0, "London"], [1, "New York"], [2, "New Delhi"], [3, "Taipei"],[4, "Beijing"], [5, "Sydney"]];
     
            var options = {
                series: {
                    bars: {
                        show: true
                    }
                },
                bars: {
                    align: "center",
                    barWidth: 0.3
                },
                xaxis: {
                    axisLabel: "Color",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Verdana, Arial',
                    axisLabelPadding: 10,
                    ticks: ticks
                },
                yaxis: {
                    axisLabel: "Number",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Verdana, Arial',
                    axisLabelPadding: 3,
                },
                legend: {
                    noColumns: 0,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: true,
                    borderWidth: 2,
                    backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
                }
            };

             $.plot($("#bar-chart"), dataset, options);
        }
        
        $(document).ready(function () {
            //BAR CHART
            //flot_init();
            var bar = new Morris.Bar({
                element: 'bar-chart',
                resize: true,
                data: [
                    {y: '', a: 0}    
                ],
                barColors: ['#00a65a', '#f56954'],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Total'],
                barSizeRatio: 0.4,
                xLabelAngle: 35,
                hideHover: 'auto'
            });

            $('#BrandSelect').on('change', function() {
                var iCarBrandId = $(this).val();
                var data = {
                    "iCarBrandId": iCarBrandId
                };

                $.ajax({
                url: url_getdata,
                data: data,
                type: "GET",
                success: function (rtndata) {
                    //console.log(rtndata)
                    if (rtndata.status) {
                        var carColors = rtndata.carColors;
                        var data = [];
                        for(var key in carColors) {
                            data [ key ] = { y: carColors[key].vCarColorName, a: carColors[key].Total };
                        }
                        //console.log(data);
                        if(data.length > 0) {
                            bar.setData(data);
                        } else {
                            data[0] = {y: '', a: 0};
                            bar.setData(data);
                        }
                    } else {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                    }
                }
            });
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
