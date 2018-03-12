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
                        <h3 class="box-title">{{trans("_menu.article.content.title")}}</h3>
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
        var current_data = [];
        var ajax_source = "{{ url('web/article/content/getlist')}}";
        var ajax_Table = "{{ url('web/article/content/getlist')}}";
        var url_dosave = "{{ url('web/article/content/dosave')}}";
        var url_dodel = "{{ url('web/article/content/dodel')}}";
        var url_add = "{{ url('web/article/content/add')}}";
        var url_edit = "{{ url('web/article/content/edit')}}";
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
                    { "width": "100px","targets": ++i},     //文章主題
                    //{ "width": "100px","targets": ++i},     //圖片
                    { "width": "200px","targets": ++i},     //文章簡介
                    { "width": "100px","targets": ++i},     //備註
                    { "width": "60px","targets": ++i},      //排序
                    { "width": "60px","targets": ++i},      //狀態
                    { "width": "100px","targets": ++i},     //創建日期
                    { "width": "100px","targets": ++i},     //修改日期
                    { "width": "100px","targets": ++i}
                ],
                "aoColumns": [
                    {"sTitle": "ID", "mData": "iId", "sName": "iId"},
                    {"sTitle": "主題", "mData": "vTitle", "sName": "vTitle"},
                    /*
                    {
                        "sTitle":"圖片",
                        "mData":"vImage",
                        "sName": "vImage",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender":function(data,type,row){
                            return " <div class=\"lightBoxGallery\"><a href='"+ data +"' data-gallery=\"\"><img src='"+ data +"'></a></div>";
                        }
                    },
                    */
                    {
                        "sTitle": "簡介", 
                        "bSortable": false,
                        "bSearchable": false,
                        "mData": "vSummary",
                        "sName": "vSummary",
                    },
                    {
                        "sTitle": "備註", 
                        "bSortable": false,
                        "bSearchable": false,
                        "mData": "vMeta",
                        "sName": "vMeta",
                    },
                    {
                        "sTitle":"排序",
                        "mData": "iRank",
                        "sName": "iRank",
                        "mRender": function(data, type, row) {
                            return "<input type=\"number\"  min=\"1\" class=\"form-control set-rank\" value=\""+ data +"\">";
                        }
                    },
                    {
                        "sTitle": "狀態", 
                        "mData": "iStatus",
                        "sName": "iStatus",
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
                    {"sTitle": "創建日期", "mData": "iCreateTime", "sName": "iCreateTime"},
                    {"sTitle": "修改日期", "mData": "iUpdateTime", "sName": "iUpdateTime"},
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
                    title: "{{trans('web.article.del.title')}}",
                    text: "{{trans('web.article.del.note')}}",
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
