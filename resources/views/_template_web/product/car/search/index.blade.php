@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <style>
    .table {
        max-width: 1400px;
    }
    table img {
        width: 40px;
        height: auto;
    }
    .table-bordered > thead > tr > th {
        border: 1px solid #ddd;
    }
    .table-bordered > tbody > tr > td {
        border: 1px solid #ddd;
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
                            <button type="button" class="btn btn-default">匯出</button>
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
                        <table class="table table-bordered" id="model-colors">
                            <thead>
                                <tr>
                                    <th style="width: 100px;">車廠</th>
                                    <th style="width: 100px;">色碼</th>
                                    <th style="width: 100px;">國際色碼</th>
                                    <th style="width: 100px;"></th>
                                    <th style="width: 100px;"></th>
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
        var url_dosave = "{{ url('web/product/car/search/dosave')}}";
        var url_add = "{{ url('web/product/car/colors/add')}}";
        var url_edit = "{{ url('web/product/car/colors/edit')}}";

        function setColor(modelColor) {
            var id = modelColor.attr('data-id');
            var data = {
                "_token": "{{ csrf_token() }}"
            };
            data.id = id;
            data.iStatus = "change";
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
            $('#BrandSelect').change(function() {
                var iCarBrandId = $(this).val();
                var data = {};
                data.iCarBrandId = iCarBrandId;
                $.ajax({
                    url: "{{ url('web/product/car/search/getlist')}}",
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
                                html_str += '<th style="width: 100px">'+carBrand['vCarBrandName']+'</th>';
                                html_str += '<th style="width: 100px">色碼</th>';
                                html_str += '<th style="width: 100px">國際色碼</th>';
                                for (var key in carModels) {
                                   html_str += '<th style="width: 100px">'+carModels[key]['vCarModelName']+'</th>'; 
                                }
                                html_str += '</tr></thead>';

                                html_str += '<tbody>';
                                for (var key1 in carModelColors) {
                                    html_str += '<tr>';
                                    html_str += '<td style="width: 100px">'+carModelColors[key1]['vCarColorName']+'</td>';
                                    html_str += '<td style="width: 100px">'+carModelColors[key1]['vCarColorCode']+'</td>';
                                    html_str += '<td style="width: 100px">'+carModelColors[key1]['vCarColorNationalCode']+'</td>';

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

                                $('.model-colors').click(function(){
                                    setColor($(this));
                                });
                            } else {
                                $('#model-colors').empty();
                                html_str += '<tr>';
                                html_str += '<th style="width: 100px">車廠</th>';
                                html_str += '<th style="width: 100px">色碼</th>';
                                html_str += '<th style="width: 100px">國際色碼</th>';
                                html_str += '<th style="width: 100px"></th>'; 
                                html_str += '<th style="width: 100px"></th>'; 
                                html_str += '</tr>';

                                html_str += '<tr>';
                                html_str += '<td style="width: 100px"></td>';
                                html_str += '<td style="width: 100px"></td>';
                                html_str += '<td style="width: 100px"></td>';
                                html_str += '<td style="width: 100px"></td>';
                                html_str += '<td style="width: 100px"></td>';
                                html_str += '</tr>';

                                $('#model-colors').append(html_str);
                            }
                        } else {
                            swal("{{trans('_web.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });

            //
            $(".btn-add").click(function () {
                location.href = url_add;
            });

            //
            $("#dt_basic").on('click', '.btn-status', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.id = id;
                data.iStatus = "change";
                $.ajax({
                    url: url_dosave,
                    data: data,
                    type: "POST",
                    success: function (rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('web.notice')}}", rtndata.message, "success");
                            setTimeout(function () {
                                table.api().ajax.reload(null, false);
                            }, 100);
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
