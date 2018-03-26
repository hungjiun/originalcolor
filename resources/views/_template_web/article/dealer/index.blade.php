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
                        <h3 class="box-title">{{trans("_menu.article.dealer.title")}}</h3>
                        <a href="javascript:void(0);" class="btn btn-primary btn-add">新增</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- select -->
                        <br>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">經銷商選擇</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="DealerSelect">
                                    <option value="0"></option>
                                    @foreach ($dealer as $key => $var)
                                    <option value="{{$var->iId}}">{{$var->vDealerName}}</option>
                                    @endforeach
                                </select>
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
        var ajax_source = "{{ url('web/article/dealer/getlist')}}";
        var ajax_Table = "{{ url('web/article/dealer/getlist')}}";
        var url_dosave = "{{ url('web/article/dealer/dosave')}}";
        var url_dodel = "{{ url('web/article/dealer/dodel')}}";
        var url_add = "{{ url('web/article/dealer/add')}}";
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
                    { "width": "100px","targets": ++i},     //經銷商
                    { "width": "100px","targets": ++i},     //文章主題
                    { "width": "60px","targets": ++i},      //排序
                    { "width": "60px","targets": ++i},      //狀態
                    { "width": "100px","targets": ++i},     //創建日期
                    { "width": "100px","targets": ++i},     //修改日期
                    { "width": "100px","targets": ++i}
                ],
                "aoColumns": [
                    {"sTitle": "ID", "mData": "iId", "sName": "iId"},
                    {"sTitle": "經銷商", "mData": "vDealerName", "sName": "vDealerName"},
                    {"sTitle": "文章主題", "mData": "vTitle", "sName": "vDealerTitle"},
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
                            btn += '<button class="pull-right btn btn-xs btn-default btn-del" title="刪除"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                            return btn;
                        }
                    },
                ],
                "sAjaxSource": ajax_source,
                fnServerParams: function(aoData){
                    aoData.push( { "name": "iDealerId", "value": $("#DealerSelect").val() } );
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

            //
            $("#DealerSelect").change(function () {
                table.api().ajax.reload(null, false);
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
                    title: "{{trans('web.article.dealer.del.title')}}",
                    text: "{{trans('web.article.dealer.del.note')}}",
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
