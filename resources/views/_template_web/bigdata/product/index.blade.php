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
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var url_getdata = "{{ url('web/bigdata/product/getdata')}}";
        
        $(document).ready(function () {
            //BAR CHART
            var bar = new Morris.Bar({
                element: 'bar-chart',
                resize: true,
                data: [
                /*
                    {y: '2006', a: 100, b: 90},
                    {y: '2007', a: 75, b: 65},
                    {y: '2008', a: 50, b: 40},
                    {y: '2009', a: 75, b: 65},
                    {y: '2010', a: 50, b: 40},
                    {y: '2011', a: 75, b: 65},
                    {y: '2012', a: 100, b: 90}
                */
                    0    
                ],
                barColors: ['#00a65a', '#f56954'],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Total'],
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
                    console.log(rtndata)
                    if (rtndata.status) {
                        var carColors = rtndata.carColors;
                        var data = [];
                        for(var key in carColors) {
                            data [ key ] = { y: carColors[key].vCarColorName, a: carColors[key].Total };
                        }
                        console.log(data);
                        bar.setData(data);
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
