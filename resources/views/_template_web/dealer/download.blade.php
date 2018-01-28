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
                        <h3 class="box-title">{{trans("_menu.product.car.search.title")}}</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-default btn-export">匯出</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- select -->
                        <br>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">車廠選擇</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="BrandSelect">
                                    <option value="0"></option>
                                    @foreach ($carBrand as $key => $var)
                                    <option value="{{$var->iId}}">{{$var->vCarBrandName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="table table-responsive">
                            <table class="table table-bordered scrolltable" id="model-colors">
                                <thead>
                                    <tr>
                                        <th>車廠</th>
                                        <th>色碼</th>
                                        <th>國際色碼</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead> 
                                <tbody>                           
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
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
        $(document).ready(function () {
            /* BASIC ;*/
            $('#BrandSelect').change(function() {
                var iCarBrandId = $(this).val();
                var data = {};
                data.iCarBrandId = iCarBrandId;
                $.ajax({
                    url: "{{ url('web/dealer/download/getlist')}}",
                    data: data,
                    type: "GET",
                    success: function(rtndata) {
                        console.log(rtndata);
                        if (rtndata.status) {
                            var carBrand = rtndata.CarBrand;
                            var carModels = rtndata.CarModels;
                            var carModelColors = rtndata.aaData;
                            var result = 0;

                            var html_str = "";
                            
                            if(carBrand) {
                                $('#model-colors').empty();
                                html_str += '<thead><tr>';
                                html_str += '<th>'+carBrand['vCarBrandName']+'</th>';
                                html_str += '<th>色碼</th>';
                                html_str += '<th>國際色碼</th>';
                                for (var key in carModels) {
                                   html_str += '<th style="width: 100px">'+carModels[key]['vCarModelName']+'</th>'; 
                                }
                                html_str += '</tr></thead>';

                                html_str += '<tbody>';
                                for (var key1 in carModelColors) {
                                    html_str += '<tr>';
                                    html_str += '<td>'+carModelColors[key1]['vCarColorName']+'</td>';
                                    html_str += '<td>'+carModelColors[key1]['vCarColorCode']+'</td>';
                                    html_str += '<td>'+carModelColors[key1]['vCarColorNationalCode']+'</td>';

                                    for (var key2 in carModels) {
                                        result = $.map(carModelColors[key1]['CarModelColors'], function(item, index) {
                                            return item.iCarModelId;
                                        }).indexOf(carModels[key2]['iId']);

                                        if (result >= 0) {
                                            if(carModelColors[key1]['CarModelColors'][result]['iStatus'] == 1) {
                                                html_str += '<td class="model-colors" style="width: 100px" data-id="'+ carModelColors[key1]['CarModelColors'][result]['iId'] +'"><i class="fa fa-circle" aria-hidden="true"><i></td>';
                                            } else {
                                                html_str += '<td class="model-colors" style="width: 100px" data-id="'+ carModelColors[key1]['CarModelColors'][result]['iId'] +'"></td>';
                                            }    
                                        } else {
                                            html_str += '<td class="model-colors" style="width: 100px" data-id="'+ carModelColors[key1]['CarModelColors'][result]['iId'] +'"></td>';
                                        }
                                        
                                    }

                                    html_str += '</tr>';
                                }
                                html_str += '</tbody>';

                                $('#model-colors').append(html_str);
                            } else {
                                $('#model-colors').empty();
                                html_str += '<tr>';
                                html_str += '<th>車廠</th>';
                                html_str += '<th>色碼</th>';
                                html_str += '<th>國際色碼</th>';
                                html_str += '<th></th>'; 
                                html_str += '<th></th>'; 
                                html_str += '</tr>';

                                html_str += '<tr>';
                                html_str += '<td></td>';
                                html_str += '<td></td>';
                                html_str += '<td></td>';
                                html_str += '<td></td>';
                                html_str += '<td></td>';
                                html_str += '</tr>';

                                $('#model-colors').append(html_str);
                            }
                        } else {
                            swal("{{trans('_web.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });

            $('.btn-export').on('click', function() {
                var iCarBrandId = $('#BrandSelect').val();
                console.log(iCarBrandId);
                window.open("{{url('web/product/car/search/doexport')}}?iCarBrandId="+iCarBrandId, "_blank");
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
