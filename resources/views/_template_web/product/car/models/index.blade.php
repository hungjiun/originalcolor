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
                    <h3 class="box-title">{{trans("_menu.product.car.models.title")}}</h3>
                    <a href="javascript:void(0);" class="btn btn-primary btn-add">新增</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- select -->
                    <br>
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
    <!-- Modal -->
    <div class="modal fade" id="color-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{trans('web.product.model.color_image.edit')}}</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('web.cancel')}}</button>
                    <button type="button" class="btn btn-primary btn-docolorsave">{{trans('web.dosave')}}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
        var ajax_source = "{{ url('web/product/car/models/getlist')}}";
        var ajax_Table = "{{ url('web/product/car/models/getlist')}}";
        var url_dosave = "{{ url('web/product/car/models/dosave')}}";
        var url_add = "{{ url('web/product/car/models/add')}}";
        var url_edit = "{{ url('web/product/car/models/edit')}}";
        var url_image = "{{ url('web/product/car/models/image')}}";
        var url_getmodelcolorlist = "{{ url('web/product/car/models/getmodelcolorlist')}}";
        var table;
        $(document).ready(function () {
            /* BASIC ;*/
            var i = 0;
            table = $('#dt_basic').dataTable({
                "searching": false,
                "bServerside": true,
                "bStateSave": true,
                "scrollX": true,
                "autoWidth": true,
                "columnDefs": [
                    { "width": "50px","targets": i},        //ID
                    { "width": "100px","targets": ++i},     //車廠
                    { "width": "100px","targets": ++i},     //車型名稱
                    { "width": "100px","targets": ++i},     //車型圖片
                    { "width": "100px","targets": ++i},     //車型
                    { "width": "100px","targets": ++i},     //車型年份
                    { "width": "200px","targets": ++i},     //車型簡介
                    { "width": "200px","targets": ++i},     //車型官網URL
                    { "width": "60px","targets": ++i},      //排序
                    { "width": "60px","targets": ++i},      //狀態
                    { "width": "100px","targets": ++i}
                ],
                "aoColumns": [
                    {"sTitle": "ID", "mData": "iId"},
                    {"sTitle": "車廠", "mData": "vCarBrandName"},
                    {"sTitle": "名稱", "mData": "vCarModelName"},
                    {
                        "sTitle":"圖片",
                        "mData":"vCarModelImg",
                        "sName": "vCarModelImg",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender":function(data,type,row){
                            return " <div class=\"lightBoxGallery\"><a href='"+ data +"' data-gallery=\"\"><img src='"+ data +"'></a></div>";
                        }
                    },
                    {"sTitle": "車型", "mData": "iCarModelType"},
                    {"sTitle": "年份", "mData": "vCarModelAge"},
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
                        "mData": "vCarModelUrl"
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
                            btn += '<button class="btn btn-xs btn-default btn-image" title="圖片"><i class="fa fa-picture-o" aria-hidden="true"></i></button>&nbsp;';
                            return btn;
                        }
                    },
                ],
                "sAjaxSource": ajax_source,
                fnServerParams: function(aoData){
                    aoData.push( { "name": "iCarBrandId", "value": $("#BrandSelect").val() } );
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

            $('#BrandSelect').change(function() {
                table.api().ajax.reload(null, false);
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
            //
            $("#dt_basic").on('click', '.btn-image', function () {
                var idx = $(this).closest('tr').attr('id');
                location.href = url_image + "?iCarModelId="+idx;
            });
            /*
            $("#dt_basic").on('click', '.btn-image', function () {
                var id = $(this).closest('tr').attr('id');
                var modal = $("#color-modal");
                modal.data('id', id);
                modal.modal();
            });
            $("#color-modal").on('show.bs.modal', function(e) {
                //console.log($(this).data('id'));
                var modal = $(this);
                var iCarModelId = modal.data('id');
                var data = {"iCarModelId": iCarModelId};
                $.ajax({
                    url: url_getmodelcolorlist,
                    type: "GET",
                    data: data,
                    success: function (rtndata) {
                        console.log(rtndata);
                        if (rtndata.status) {
                            var carModelColors = rtndata.carModelColors;
                            var str = '';
                            modal.find(".form-horizontal").empty();
                            for (var key in carModelColors) {
                                str += '<div class="form-group">';
                                str += '<label class="col-sm-2 col-md-2 col-lg-2 control-label">' + carModelColors[key].vCarColorName + '</label>';

                                str += '<div class="col-sm-10">';
                                str += '<a class="btn-model-image" id="' + carModelColors[key].iId + '">';
                                str += '<img id="Image-' + carModelColors[key].iId + '" data-id="' + carModelColors[key].iId + '" src="' + carModelColors[key].vCarModelImage + '" style="width: 15%">';
                                str += '</a>';
                                str += '</div>';

                                str += '</div>';
                            } 
                            modal.find(".form-horizontal").append(str);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
            */
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
