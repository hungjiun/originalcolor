@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <style>
    table img {
        width: 40px;
        height: auto;
    }
    .table-bordered > tbody {
        max-height: 350px;
        overflow-y: scroll;
        display: block;
    }
    .table-bordered thead, tbody tr {
        width: 100%;
        display: table;
        table-layout: fixed;
    }
    .table-bordered thead {
        width: calc(100% - 17px);
    }
    .table-bordered > thead > tr > th {
        border: 1px solid #ddd;
        width: 100px;
    }
    .table-bordered > tbody > tr > td {
        border: 1px solid #ddd;
        width: 100px;
    }
    .model-colors {
        cursor: pointer;
    }
    
    </style>
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{trans("_menu.product.car.dealer.manage.config.title")}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- select -->
                        <div class="table table-responsive">
                            <table class="table table-bordered scrolltable" id="model-colors">
                                <thead>
                                    <tr>
                                        <th>{{$carBrand->vCarBrandName}}</th>
                                        <th>色碼</th>
                                        <th>國際色碼</th>
                                        @foreach($carModels as $key => $var)
                                        <th>{{$var->vCarModelName}}</th>
                                        @endforeach
                                    </tr>
                                </thead> 
                                <tbody>
                                    @foreach($carColors as $key => $var)
                                    <tr>
                                        <td>{{$var->vCarColorName}}</td>
                                        <td>{{$var->vCarColorCode}}</td>
                                        <td>{{$var->vCarColorNationalCode}}</td>
                                        @foreach($var->carModels as $key1 => $var1) 
                                        @if($var1['iColorStatus'] == 0)
                                        <td data-colorid="{{$var->iCarColorsId}}" 
                                            data-modelid="{{$var1['iId']}}" 
                                            data-status="{{$var1['iColorStatus']}}">
                                        @else
                                        <td class="model-colors" 
                                            data-colorid="{{$var->iCarColorsId}}" 
                                            data-modelid="{{$var1['iId']}}" 
                                            data-status="{{$var1['iColorStatus']}}">
                                        @endif
                                            @if($var1['iColorStatus'] == 2)
                                            <i class="fa fa-circle" aria-hidden="true">
                                            @elseif($var1['iColorStatus'] == 1)
                                            <i class="fa fa-circle-o" aria-hidden="true">
                                            @else
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var url_dosave = "{{ url('web/product/car/dealer/manage/dosave')}}";
        
        function setColor(modelColor) {
            var iDealerId = "{{$iDealerId}}";
            var iCarBrandId = "{{$iCarBrandId}}";
            var iCarModelId = modelColor.attr('data-modelid');
            var iCarColorId = modelColor.attr('data-colorid');
            var iColorStatus = modelColor.attr('data-status');
            var data = {
                "_token": "{{ csrf_token() }}"
            };
            data.iDealerId = iDealerId;
            data.iCarBrandId = iCarBrandId;
            data.iCarModelId = iCarModelId;
            data.iCarColorId = iCarColorId;
            data.iStatus = "change";

            console.log(data);

            $.ajax({
                url: url_dosave,
                data: data,
                type: "POST",
                success: function (rtndata) {
                    if (rtndata.status) {
                        var colorStatus = rtndata.colorStatus;
                        swal("{{trans('web.notice')}}", rtndata.message, "success");
                        if(colorStatus) {
                            modelColor.html('<i class="fa fa-circle" aria-hidden="true"><i>');
                        } else {
                            modelColor.html('');
                        }
                    } else {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                    }
                }
            });
        }

        $(document).ready(function () {
            /* BASIC ;*/
            $('.model-colors').click(function(){
                setColor($(this));
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
