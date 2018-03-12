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
                        <h3 class="box-title">{{trans("_menu.product.car.brand.title")}}</h3>
                        <a href="javascript:void(0);" class="btn btn-primary btn-add">新增</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
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
<!-- blueimp gallery -->
<script src="/web_assets/AdminLTE/plugins/blueimp/js/jquery.blueimp-gallery.min.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/product/car/brand/getlist')}}";
        var ajax_Table = "{{ url('web/product/car/brand/getlist')}}";
        var url_dosave = "{{ url('web/product/car/brand/dosave')}}";
        var url_add = "{{ url('web/product/car/brand/add')}}";
        var url_edit = "{{ url('web/product/car/brand/edit')}}";
        var url_dodel = "{{ url('web/product/car/brand/dodel')}}";
        $(document).ready(function () {
            /* BASIC ;*/
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "searching": false,
                "bServerside": true,
                "bStateSave": true,
                "scrollX": true,
                "autoWidth": true,
                "columnDefs": [
                    { "width": "50px","targets": i},        //ID
                    { "width": "100px","targets": ++i},     //車廠名稱
                    { "width": "100px","targets": ++i},     //車廠圖片
                    { "width": "200px","targets": ++i},     //車廠國家
                    { "width": "100px","targets": ++i},     //車廠簡介
                    { "width": "200px","targets": ++i},     //車廠官網URL
                    { "width": "60px","targets": ++i},      //排序
                    { "width": "60px","targets": ++i},      //狀態
                    { "width": "100px","targets": ++i}
                ],
                "aoColumns": [
                    {"sTitle": "ID", "mData": "iId"},
                    {"sTitle": "名稱", "mData": "vCarBrandName"},
                    {
                        "sTitle":"圖片",
                        "mData":"vCarBrandImg",
                        "sName": "vCarBrandImg",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender":function(data,type,row){
                            return " <div class=\"lightBoxGallery\"><a href='"+ data +"' data-gallery=\"\"><img src='"+ data +"'></a></div>";
                        }
                    },
                    {"sTitle": "國家", "mData": "vCarBrandCountry"},
                    {
                        "sTitle": "簡介", 
                        "bSortable": false,
                        "bSearchable": false,
                        "mData": "vSummary"
                    },
                    {
                        "sTitle": "官網URL", 
                        "bSortable": false,
                        "bSearchable": false,
                        "mData": "vCarBrandUrl"

                    },
                    {
                        "sTitle":"排序","mData":"iRank",
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
                            btn = '<button class="btn btn-xs btn-default btn-edit" title="編輯"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;';
                            btn += '<button class="pull-right btn btn-xs btn-default btn-del" title="刪除"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                            return btn;
                        }
                    },
                ],
                "sAjaxSource": ajax_source,
                "ajax": ajax_Table,
                "sDom": "<'dt-toolbar'<'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
            });
            /* END BASIC */

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
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
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
                    title: "{{trans('web.product.brand.del.title')}}",
                    text: "{{trans('web.product.brand.del.note')}}",
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
