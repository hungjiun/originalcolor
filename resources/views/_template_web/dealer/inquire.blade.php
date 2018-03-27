@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <style>
    table img {
        width: 40px;
        height: auto;
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
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- select -->
                        <br>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px;">
                                車廠選擇：
                                <select class="form-control car-brand" id="car-brand" style="display:inline-block; width: 100px">
                                    <option value="0"></option>
                                    @foreach ($carBrand as $key => $var)
                                    <option value="{{$var->iId}}">{{$var->vCarBrandName}}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;車款：
                                <select class="form-control car-model" id="car-model" style="display:inline-block; width: 100px">
                                    <option value="0"></option>
                                </select>
                                &nbsp;&nbsp;&nbsp;車色名稱：
                                <input class="form-control car-color" type="text" id="car-color-name"
                                    value="" style="display:inline-block; width: 150px">
                                &nbsp;&nbsp;&nbsp;色碼：
                                <input class="form-control car-color" type="text" id="car-color"
                                    value="" style="display:inline-block; width: 150px">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-search">搜尋</a>    
                            </div>
                        </div>
                        <br><br>
                        <table id="dt_basic" class="table table-bordered table-hover">
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
        var ajax_source = "{{ url('web/dealer/inquire/getlist')}}";
        var ajax_Table = "{{ url('web/dealer/inquire/getlist')}}";
        var url_getcarmodels = "{{url('web/dealer/inquire/getcarmodels')}}";
        $(document).ready(function () {
            /* BASIC ;*/
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "searching": false,
                "bServerSide": true,
                "bStateSave": true,
                "scrollX": true,
                "autoWidth": true,
                "columnDefs": [
                    { "width": "50px","targets": i},        //ID
                    { "width": "100px","targets": ++i},     //車廠名稱
                    { "width": "100px","targets": ++i},     //車款名稱
                    { "width": "100px","targets": ++i},     //車色名稱
                    { "width": "100px","targets": ++i},     //車色圖片
                    { "width": "100px","targets": ++i},     //車色編碼
                    { "width": "100px","targets": ++i},     //車色國際編碼
                    { "width": "100px","targets": ++i},     //補漆筆編號
                    { "width": "100px","targets": ++i}
                ],
                "aoColumns": [
                    {"sTitle": "ID", "mData": "iId", "sName": "iId"},
                    {"sTitle": "車廠", "mData": "vCarBrandName", "sName": "vCarBrandName"},
                    {"sTitle": "車款", "mData": "vCarModelName", "sName": "vCarModelName"},
                    {"sTitle": "車色", "mData": "vCarColorName", "sName": "vCarColorName"},
                    {
                        "sTitle":"圖片",
                        "mData":"vCarColorImg",
                        "sName": "vCarColorImg",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender":function(data,type,row){
                            return " <div class=\"lightBoxGallery\"><a href='"+ data +"' data-gallery=\"\"><img src='"+ data +"'></a></div>";
                        }
                    },
                    {
                        "sTitle": "國際色碼", 
                        "mData": "vCarColorCode",
                        "sName": "vCarColorCode",
                        "bSortable": false,
                        "bSearchable": false
                    },
                    {
                        "sTitle": "國際版編號", 
                        "mData": "vCarColorNationalCode",
                        
                        "bSortable": false,
                        "bSearchable": false
                    },
                    {
                        "sTitle": "台灣版編號", 
                        "mData": "vPenNumber",
                        "sName": "vPenNumber",
                        "bSortable": false,
                        "bSearchable": false
                    },
                    {
                        "sTitle": "Action",
                        "mRender": function (data, type, row) {
                            var btn = "";
                            return btn;
                        }
                    },
                ],
                "sAjaxSource": ajax_source,
                fnServerParams: function(aoData){
                    aoData.push( { "name": "iCarBrandId", "value": $("#car-brand").val() } );
                    aoData.push( { "name": "iCarModelId", "value": $("#car-model").val() } );
                    aoData.push( { "name": "vCarColorName", "value": $("#car-color-name").val() } );
                    aoData.push( { "name": "vCarColorCode", "value": $("#car-color").val() } );
                },
                "ajax": ajax_Table,
                "sDom": "<'dt-toolbar'<'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
            });
            /* END BASIC */

            $('.btn-search').on('click', function() {
                table.api().ajax.reload();
            });

            $('.car-brand').on('change', function() {
                var carBrandId = $(this).val();
                var data = {
                    "iCarBrandId": carBrandId
                }; 
                $.ajax({
                    url: url_getcarmodels,
                    data: data,
                    type: "GET",
                    success: function (rtndata) {
                        console.log(rtndata);
                        if (rtndata.status) {
                            var carModels = rtndata.carModels;
                            $('.car-model option').remove();
                            $('.car-model').append($("<option></option>").attr("value", 0).text(""));
                            for ( var key in carModels ) {
                                $('.car-model').append($("<option></option>").attr("value", carModels[key].iId).text(carModels[key].vCarModelName));
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
