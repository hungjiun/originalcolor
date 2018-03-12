@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link rel="stylesheet" href="/web_assets/AdminLTE/plugins/bootstrap-colorpickersliders/dist/bootstrap.colorpickersliders.css" >
    <style>
        
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
                        <h3 class="box-title">{{trans("_menu.admin.dealer.title")}}</h3>
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

    <!-- Modal -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{trans('web.admin.dealer.add')}}</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.name')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerName" placeholder="{{trans('web.admin.dealer.name')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.name_en')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerNameE" placeholder="{{trans('web.admin.dealer.name_en')}}" type="text">
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('web.admin.dealer.logo')}}</label>
                            <div class="col-sm-10">
                                <a class="btn-image-modal" data-modal="image-form">
                                    <img id="Image" data-id="" src="/img/empty-type.jpg" style="width: 15%">
                                </a>
                            </div>
                        </div>
                        -->
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.url_name')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUrlName" placeholder="{{trans('web.admin.dealer.url_name')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.tel')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerTel" placeholder="{{trans('web.admin.dealer.tel')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.fax')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerFax" placeholder="{{trans('web.admin.dealer.fax')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.email')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerEmail" placeholder="{{trans('web.admin.dealer.email')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.address')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerAddr" placeholder="{{trans('web.admin.dealer.address')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.link')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerLink" placeholder="{{trans('web.admin.dealer.link')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.company_url')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerCompanyUrl" placeholder="{{trans('web.admin.dealer.company_url')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.color')}}</label>
                            <div class="col-md-9">
                                <input class="form-control input-color vDealerColor" placeholder="{{trans('web.admin.dealer.color')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.fontcolor')}}</label>
                            <div class="col-md-9">
                                <input class="form-control input-color vDealerFontColor" placeholder="{{trans('web.admin.dealer.fontcolor')}}" type="text">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('web.cancel')}}</button>
                    <button type="button" class="btn btn-primary btn-doadd">{{trans('web.doadd')}}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{trans('web.admin.dealer.edit')}}</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.name')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerName" placeholder="{{trans('web.admin.dealer.name')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.name_en')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerNameE" placeholder="{{trans('web.admin.dealer.name_en')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{trans('web.admin.dealer.logo')}}</label>
                            <div class="col-sm-9">
                                <a class="btn-image-modal" data-modal="image-form">
                                    <img id="Image" data-id="" src="/img/empty-type.jpg" style="width: 15%">
                                </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.url_name')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUrlName" placeholder="{{trans('web.admin.dealer.url_name')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.tel')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerTel" placeholder="{{trans('web.admin.dealer.tel')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.fax')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerFax" placeholder="{{trans('web.admin.dealer.fax')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.email')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerEmail" placeholder="{{trans('web.admin.dealer.email')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.address')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerAddr" placeholder="{{trans('web.admin.dealer.address')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.link')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerLink" placeholder="{{trans('web.admin.dealer.link')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.company_url')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vDealerCompanyUrl" placeholder="{{trans('web.admin.dealer.company_url')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.color')}}</label>
                            <div class="col-md-9">
                                <input class="form-control input-color vDealerColor" placeholder="{{trans('web.admin.dealer.color')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.dealer.fontcolor')}}</label>
                            <div class="col-md-9">
                                <input class="form-control input-color vDealerFontColor" placeholder="{{trans('web.admin.dealer.fontcolor')}}" type="text">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('web.cancel')}}</button>
                    <button type="button" class="btn btn-primary btn-dosave">{{trans('web.dosave')}}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script src="/web_assets/AdminLTE/plugins/tinycolor-1.0.0/tinycolor.js"></script>
    <script src="/web_assets/AdminLTE/plugins/bootstrap-colorpickersliders/dist/bootstrap.colorpickersliders.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    @include('_template_web._js.image_upload')
    <!--  -->
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/admin/dealer/getlist')}}";
        var ajax_Table = "{{ url('web/admin/dealer/getlist')}}";
        var url_dosave = "{{ url('web/admin/dealer/dosave')}}";
        var url_doadd = "{{ url('web/admin/dealer/doadd')}}";
        var url_dodel = "{{ url('web/admin/dealer/dodel')}}";
        $(document).ready(function () {
            $(".input-color").ColorPickerSliders({
                placement: 'bottom',
                color: "rgba(255, 255, 255, 0)",
                order: {
                  hsl: 1,
                  opacity: 2
                }
            });

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
                    { "width": "100px","targets": ++i},     //經銷商名稱
                    { "width": "100px","targets": ++i},     //經銷商電話
                    { "width": "100px","targets": ++i},     //經銷商傳真
                    { "width": "200px","targets": ++i},     //經銷商Emai
                    { "width": "200px","targets": ++i},     //經銷商地址
                    { "width": "60px","targets": ++i},      //狀態
                    { "width": "100px","targets": ++i},      //建立時間
                    { "width": "100px","targets": ++i}
                ],
                "aoColumns": [
                    {"sTitle": "ID", "mData": "iId"},
                    {"sTitle": "經銷商名稱", "mData": "vDealerName"},
                    {"sTitle": "經銷商電話", "mData": "vDealerTel"},
                    {"sTitle": "經銷商傳真", "mData": "vDealerFax"},
                    {"sTitle": "經銷商Emai", "mData": "vDealerEmail"},
                    {"sTitle": "經銷商地址", "mData": "vDealerAddr"},
                    {
                        "sTitle": "狀態", "mData": "iStatus",
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-danger btn-status">正常使用</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-primary btn-status">停權中</button>';
                                    break;
                            }
                            return btn;
                        }
                    },
                    {"sTitle": "建立時間", "mData": "iCreateTime"},
                    {
                        "sTitle": "Action",
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "無功能";
                            btn = '<button class="btn btn-xs btn-default btn-edit" title="編輯"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;';
                            btn += '<button class="btn btn-xs btn-default btn-copylink" data-type="'+ row.iType +'" data-url="'+ row.vUrlName +'" title="複製連結"><i class="fa fa-link" aria-hidden="true"></i></button>&nbsp;';
                            btn += '<button class="btn btn-xs btn-default btn-downloadqr" data-type="'+ row.iType +'" data-url="'+ row.vUrlName +'" title="QrCode下載"><i class="fa fa-qrcode" aria-hidden="true"></i></button>';
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

            $('#dt_basic').on('click', '.btn-copylink', function () {
                var type = $(this).attr('data-type');
                var url = $(this).attr('data-url');
                if(type == 1) {
                    var link = "{{url('')}}/"+ url;
                } else {
                    var link = "{{url('')}}/dealer/web"+ url;
                }

                //console.log(link);
                 
                copyTextToClipboard(link);
            });
        
            $('#dt_basic').on('click', '.btn-downloadqr', function () {
                var type = $(this).attr('data-type');
                var url = $(this).attr('data-url');
                location.href="{{ url('web/admin/dealer/dodownloadqrcode')}}?type="+ type +"&url="+ url;
            });

            //
            $("#dt_basic").on('click', '.btn-status', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.iStatus = "change";
                $.ajax({
                    url: url_dosave,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            setTimeout(function () {
                                table.api().ajax.reload();
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
            //
            $("#dt_basic").on('click', '.btn-edit', function () {
                var id = $(this).closest('tr').attr('id');
                var modal = $("#edit-modal");
                modal.data('id', id);
                modal.find(".vDealerName").val(current_data[id].vDealerName);
                modal.find(".vDealerNameE").val(current_data[id].vDealerNameE);
                modal.find("#Image").attr('src', current_data[id].vImage);
                modal.find("#Image").attr('data-id', current_data[id].vDealerImg);
                modal.find(".vUrlName").val(current_data[id].vUrlName);
                if(current_data[id].iType == 1) {
                    modal.find(".vUrlName").attr('disabled', true);
                } else {
                    modal.find(".vUrlName").removeAttr('disabled');
                }
                modal.find(".vDealerTel").val(current_data[id].vDealerTel);
                modal.find(".vDealerEmail").val(current_data[id].vDealerEmail);
                modal.find(".vDealerAddr").val(current_data[id].vDealerAddr);
                modal.find(".bLink").val(current_data[id].bLink);
                modal.find(".vDealerLink").val(current_data[id].vDealerLink);
                modal.find(".vDealerColor").val(current_data[id].vDealerColor);
                modal.find(".vDealerFontColor").val(current_data[id].vDealerFontColor);
                modal.find(".vDealerFax").val(current_data[id].vDealerFax);
                modal.find(".vDealerCompanyUrl").val(current_data[id].vDealerCompanyUrl);
                modal.modal();
            });
            //
            $(".btn-dosave").click(function () {
                var modal = $("#edit-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = modal.data('id');
                data.vDealerName = modal.find('.vDealerName').val();
                data.vDealerNameE = modal.find('.vDealerNameE').val();
                data.vDealerImg = modal.find('#Image').attr('data-id');
                data.vUrlName = modal.find('.vUrlName').val();
                data.vDealerTel = modal.find('.vDealerTel').val();
                data.vDealerEmail = modal.find('.vDealerEmail').val();
                data.vDealerAddr = modal.find('.vDealerAddr').val();
                data.bLink = modal.find('.bLink').val();
                data.vDealerLink = modal.find('.vDealerLink').val();
                data.vDealerColor = modal.find('.vDealerColor').val();
                data.vDealerFax = modal.find('.vDealerFax').val();
                data.vDealerLink = modal.find('.vDealerLink').val();
                data.vDealerColor = modal.find('.vDealerColor').val();
                data.vDealerFontColor = modal.find('.vDealerFontColor').val();
                data.vDealerCompanyUrl = modal.find('.vDealerCompanyUrl').val();
                $.ajax({
                    url: url_dosave,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            modal.modal('toggle');
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            setTimeout(function () {
                                table.api().ajax.reload();
                            }, 1000)
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
            //
            $(".btn-add").click(function () {
                //location.href = url_add;
                var modal = $("#add-modal");
                modal.modal();
            });

            $(".btn-doadd").click(function () {
                var modal = $("#add-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.vDealerName = modal.find('.vDealerName').val();
                data.vDealerNameE = modal.find('.vDealerNameE').val();
                //data.vDealerImg = modal.find('#Image').val();
                data.vDealerTel = modal.find('.vDealerTel').val();
                data.vDealerEmail = modal.find('.vDealerEmail').val();
                data.vDealerAddr = modal.find('.vDealerAddr').val();
                data.vDealerFax = modal.find('.vDealerFax').val();
                data.bLink = modal.find('.bLink').val();
                data.vDealerLink = modal.find('.vDealerLink').val();
                data.vDealerColor = modal.find('.vDealerColor').val();
                data.vDealerFontColor = modal.find('.vDealerFontColor').val();

                //console.log(data);

                $.ajax({
                    url: url_doadd,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        //console.log(rtndata);
                        if (rtndata.status) {
                            modal.modal('toggle');
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            setTimeout(function () {
                                table.api().ajax.reload();
                            }, 1000)
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
                    title: "{{trans('web.admin.dealer.del.title')}}",
                    text: "{{trans('web.admin.dealer.del.note')}}",
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
