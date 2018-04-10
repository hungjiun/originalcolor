@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link rel="stylesheet" href="/web_assets/AdminLTE/plugins/blueimp/css/blueimp-gallery.css" >
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
                        <h3 class="box-title">{{trans("_menu.product.car.colors.title")}}</h3>
                        <a href="javascript:void(0);" class="btn btn-primary btn-add">新增</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- select -->
                        <br>
                        <!--
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
                        -->
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px;">
                                車廠選擇：
                                <select class="form-control car-brand" id="car-brand" style="display:inline-block; width: 100px">
                                    <option value="0"></option>
                                    @foreach ($carBrand as $key => $var)
                                    <option value="{{$var->iId}}">{{$var->vCarBrandName}}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;色碼：
                                <input class="form-control car-color btn-enter" type="text" id="car-color"
                                    value="" style="display:inline-block; width: 150px">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-search">搜尋</a>    
                            </div>
                        </div>
                        <br><br>
                        <table id="dt_basic" class="table table-bordered table-hover">
                        </table>
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

<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a> <a class="next">›</a> <a class="close">×</a> <a
        class="play-pause"></a>
    <ol class="indicator"></ol>
</div> 
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
<!--  -->
<!-- blueimp gallery -->
<script src="/web_assets/AdminLTE/plugins/blueimp/js/jquery.blueimp-gallery.min.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/product/car/colors/getlist')}}";
        var ajax_Table = "{{ url('web/product/car/colors/getlist')}}";
        var url_dosave = "{{ url('web/product/car/colors/dosave')}}";
        var url_add = "{{ url('web/product/car/colors/add')}}";
        var url_edit = "{{ url('web/product/car/colors/edit')}}";
        var url_lang = "{{ url('web/product/car/colors/lang')}}";
        var url_dodel = "{{ url('web/product/car/colors/dodel')}}";
        var table;
        $(document).ready(function () {
            /* BASIC ;*/
            var i = 0;
            table = $('#dt_basic').dataTable({
                "searching": false,
                "bServerSide": true,
                "bStateSave": true,
                "scrollX": true,
                "autoWidth": true,
                "columnDefs": [
                    { "width": "50px","targets": i},        //ID
                    { "width": "100px","targets": ++i},     //車廠名稱
                    { "width": "100px","targets": ++i},     //車色名稱
                    { "width": "100px","targets": ++i},     //車色圖片
                    { "width": "100px","targets": ++i},     //車色編碼
                    { "width": "100px","targets": ++i},     //車色國際編碼
                    { "width": "100px","targets": ++i},     //補漆筆編號
                    { "width": "60px","targets": ++i},      //排序
                    { "width": "60px","targets": ++i},      //狀態
                    { "width": "100px","targets": ++i}
                ],
                "aoColumns": [
                    {"sTitle": "ID", "mData": "iId", "sName": "iId"},
                    {"sTitle": "車廠名稱", "mData": "vCarBrandName", "sName": "vCarBrandName"},
                    {"sTitle": "車色名稱", "mData": "vCarColorName", "sName": "vCarColorName"},
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
                        "sTitle": "編碼", 
                        "bSortable": false,
                        "bSearchable": false,
                        "mData": "vCarColorCode",
                        "sName": "vCarColorCode",
                    },
                    {
                        "sTitle": "國際編號", 
                        "bSortable": false,
                        "bSearchable": false,
                        "mData": "vCarColorNationalCode",
                        "sName": "vCarColorNationalCode",
                    },
                    {
                        "sTitle": "台灣編號", 
                        "bSortable": false,
                        "bSearchable": false,
                        "mData": "vPenNumber",
                        "sName": "vPenNumber",
                    },
                    {
                        "sTitle":"排序",
                        "mData": "iRank",
                        "mRender": function(data, type, row) {
                            return "<input type=\"number\"  min=\"1\" class=\"form-control set-rank\" value=\""+ data +"\">";
                        }
                    },
                    {
                        "sTitle": "狀態", "mData": "iStatus",
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-danger btn-status">啟用</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-primary btn-status">停用</button>';
                                    break;
                            }
                            return btn;
                        }
                    },
                    {
                        "sTitle": "Action",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "";
                            btn += '<button class="btn btn-xs btn-default btn-edit" title="編輯"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;';
                            btn += '<button class="btn btn-xs btn-default btn-lang" title="車色語言編輯"><i class="fa fa-language" aria-hidden="true"></i></button>&nbsp;';

                            btn += '<button class="pull-right btn btn-xs btn-default btn-del" title="刪除"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                            return btn;
                        }
                    },
                ],
                "sAjaxSource": ajax_source,
                fnServerParams: function(aoData){
                    aoData.push( { "name": "iCarBrandId", "value": $("#car-brand").val() } );
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
            /*
            $('#BrandSelect').change(function() {
                table.api().ajax.reload(null, false);
            });
            */
            $('.btn-search').on('click', function() {
                table.api().ajax.reload();
            });
            //
            $(".btn-add").click(function () {
                location.href = url_add;
            });
            //
            $("#dt_basic").on('click', '.btn-edit', function () {
                var idx = $(this).closest('tr').attr('id');
                location.href = url_edit + "?id="+idx;
            });
            //
            $("#dt_basic").on('click', '.btn-lang', function () {
                var idx = $(this).closest('tr').attr('id');
                location.href = url_lang + "?id="+idx;
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
                            //swal("{{trans('web.notice')}}", rtndata.message, "success");
                            toastr.success(rtndata.message, "{{trans('web.notice')}}");
                            setTimeout(function () {
                                table.api().ajax.reload(null, false);
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });

            $('#dt_basic').on('blur', '.set-rank', function(e) {
                var tr = $(this).closest('tr');
                var idx = tr.attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.id = idx;
                data.iRank = $(this).val();
                $.ajax({
                    url: url_dosave,
                    data: data,
                    type: "POST",
                    success: function(rtndata) {
                        if (rtndata.status) {
                            //swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            toastr.success(rtndata.message, "{{trans('web.notice')}}");
                            setTimeout(function() {
                                table.api().ajax.reload(null, false);
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });

            $('#dt_basic').on('click', '.btn-del', function () {
                var tr = $(this).closest('tr');
                var idx = tr.attr('id');
                swal({
                    title: "{{trans('web.product.color.del.title')}}",
                    text: "{{trans('web.product.color.del.note')}}",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "{{trans('web.cancel')}}",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{trans('web.ok')}}",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        url : url_dodel,
                        data : {"iId":idx, "_token":"{{ csrf_token() }}"},
                        type : "POST",
                        success : function(rtndata) {
                            if (rtndata.status) {
                                swal("{{trans('web.notice')}}", rtndata.message, "success");
                                setTimeout(function(){
                                    table.api().ajax.reload(null, false);
                                }, 500);
                            } else {
                                swal("{{trans('web.notice')}}", rtndata.message, "error");
                            }
                        }
                    })
                });
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
