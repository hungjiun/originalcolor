@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <style>
        <!--
        -->
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
                        <h3 class="box-title">{{trans("_menu.admin.member.title")}}</h3>
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
                    <h4 class="modal-title" id="myModalLabel">{{trans('web.admin.member.add')}}</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.account')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vAccount" placeholder="{{trans('web.account')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.username')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUserName" placeholder="{{trans('web.username')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.password')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vPassword" placeholder="{{trans('web.password_input')}}" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.repassword')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vRePassword" placeholder="{{trans('web.repassword_input')}}" type="password">
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
                    <h4 class="modal-title" id="myModalLabel">{{trans('web.admin.member.edit')}}</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.username')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUserName" id="vUserName" placeholder="{{trans('web.username')}}" type="text">
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.member.username_en')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUserNameE" id="vUserNameE" placeholder="{{trans('web.admin.member.username_en')}}" type="text">
                            </div>
                        </div>
                        -->
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.member.user_title')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUserTitle" id="vUserTitle" placeholder="{{trans('web.admin.member.user_title')}}" type="text">
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.member.user_id')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUserID" id="vUserID" placeholder="{{trans('web.admin.member.user_id')}}" type="text">
                            </div>
                        </div>
                        -->
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.member.user_birthday')}}</label>
                            <div class="col-md-9">
                                <input class="form-control datepicker iUserBirthday" data-dateformat="yy/mm/dd" id="iUserBirthday"
                                       placeholder="{{trans('web.admin.member.user_birthday')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.member.user_email')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUserEmail" id="vUserEmail" placeholder="{{trans('web.admin.member.user_email')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.member.user_contact')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUserContact" id="vUserContact" placeholder="{{trans('web.admin.member.user_contact')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.member.user_zipcode')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUserZipCode" id="vUserZipCode" placeholder="{{trans('web.admin.member.user_zipcode')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.member.user_city')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUserCity" id="vUserCity" placeholder="{{trans('web.admin.member.user_city')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.member.user_area')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUserArea" id="vUserArea" placeholder="{{trans('web.admin.member.user_area')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('web.admin.member.user_address')}}</label>
                            <div class="col-md-9">
                                <input class="form-control vUserAddress" id="vUserAddress" placeholder="{{trans('web.admin.member.user_address')}}" type="text">
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
    <script type="text/javascript" src="/_assets/CryptoJS/rollups/md5.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/admin/member/customer/getlist')}}";
        var ajax_Table = "{{ url('web/admin/member/customer/getlist')}}";
        var url_dosave = "{{ url('web/admin/member/customer/dosave')}}";
        var url_doadd = "{{ url('web/admin/member/customer/doadd')}}";

        $(document).ready(function () {
            //Date picker
            $('.datepicker').datepicker({
              autoclose: true
            });
            /* BASIC ;*/
            var i = 0;
            var table = $('#dt_basic').dataTable({
                "searching": false,
                "bServerside": true,
                "bStateSave": true,
                "scrollX": true,
                //'lengthChange': false,
                "autoWidth": true,
                "columnDefs": [
                    { "width": "50px","targets": i},        //ID
                    { "width": "100px","targets": ++i},     //會員編號
                    { "width": "100px","targets": ++i},     //權限等級
                    { "width": "200px","targets": ++i},     //帳號
                    { "width": "100px","targets": ++i},     //註冊IP
                    { "width": "200px","targets": ++i},     //註冊時間
                    { "width": "60px","targets": ++i},      //啟用
                    { "width": "60px","targets": ++i},      //狀態
                    { "width": "100px","targets": ++i}
                ],
                "aoColumns": [
                    {"sTitle": "ID", "mData": "iId"},
                    {"sTitle": "會員編號", "mData": "iUserId"},
                    {"sTitle": "權限等級", "mData": "iAcType"},
                    {"sTitle": "帳號", "mData": "vAccount"},
                    {"sTitle": "註冊IP", "mData": "vCreateIP"},
                    {"sTitle": "註冊時間", "mData": "iCreateTime"},
                    {
                        "sTitle": "啟用", "mData": "bActive",
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-success btn-active">已啟用</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-warning btn-active">已停用</button>';
                                    break;
                            }
                            return btn;
                        }
                    },
                    {
                        "sTitle": "狀態", "mData": "iStatus",
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-primary btn-status">正常使用</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-danger btn-status">停權中</button>';
                                    break;
                            }
                            return btn;
                        }
                    },
                    {
                        "sTitle": "Action",
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "無功能";
                            btn = '<button class="btn btn-xs btn-default btn-edit" title="編輯"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
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
            $("#dt_basic").on('click', '.btn-active', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.bActive = "change";
                $.ajax({
                    url: url_dosave,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                            setTimeout(function () {
                                table.api().ajax.reload(null, false);
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
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
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                            setTimeout(function () {
                                table.api().ajax.reload(null, false);
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
                modal.find(".vUserName").val(current_data[id].vUserName);
                //modal.find(".vUserNameE").val(current_data[id].vUserNameE);
                modal.find(".vUserTitle").val(current_data[id].vUserTitle);
                //modal.find(".vUserID").val(current_data[id].vUserID);
                modal.find(".iUserBirthday").val(current_data[id].iUserBirthday);
                modal.find(".vUserEmail").val(current_data[id].vUserEmail);
                modal.find(".vUserContact").val(current_data[id].vUserContact);
                modal.find(".vUserZipCode").val(current_data[id].vUserZipCode);
                modal.find(".vUserCity").val(current_data[id].vUserCity);
                modal.find(".vUserArea").val(current_data[id].vUserArea);
                modal.find(".vUserAddress").val(current_data[id].vUserAddress);
                modal.modal();
            });
            //
            $(".btn-dosave").click(function () {
                var modal = $("#edit-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.iId = modal.data('id');
                data.vUserName = modal.find('.vUserName').val();
                //data.vUserNameE = modal.find('.vUserNameE').val();
                data.vUserTitle = modal.find('.vUserTitle').val();
                //data.vUserID = modal.find('.vUserID').val();
                data.iUserBirthday = modal.find('.iUserBirthday').val();
                data.vUserEmail = modal.find('.vUserEmail').val();
                data.vUserContact = modal.find('.vUserContact').val();
                data.vUserZipCode = modal.find('.vUserZipCode').val();
                data.vUserCity = modal.find('.vUserCity').val();
                data.vUserArea = modal.find('.vUserArea').val();
                data.vUserAddress = modal.find('.vUserAddress').val();
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
                                table.api().ajax.reload(null, false);
                            }, 1000)
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
            //
            $(".btn-add").click(function () {
                var modal = $("#add-modal");
                modal.modal();
            });
            //
            $("#vAccount").blur(function () {
                if ($("#vAccount").val() != "") {
                    toastr.error("{{trans("web.register.account_fail")}}", "{{trans('_web_alert.notice')}}")
                    $("#vAccount").parent().addClass('has-error');
                } else {
                    $("#vAccount").parent().removeClass('has-error');
                }
            });
            //
            $("#vPassword").blur(function () {
                if ($("#vRePassword").val() != $("#vPassword").val()) {
                    $("#vRePassword").parent().addClass('has-error');
                } else {
                    $("#vRePassword").parent().removeClass('has-error');
                }
            });
            //
            $("#vRePassword").blur(function () {
                if ($("#vRePassword").val() != $("#vPassword").val()) {
                    $("#vRePassword").parent().addClass('has-error');
                } else {
                    $("#vRePassword").parent().removeClass('has-error');
                }
            });
            //
            $(".btn-doadd").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};
                data.vUserName = $("#vUserName").val();
                data.vAccount = $("#vAccount").val();
                data.vPassword = CryptoJS.MD5($("#vPassword").val()).toString(CryptoJS.enc.Base64);

                var modal = $("#add-modal");
                var data = {"_token": "{{ csrf_token() }}"};
                data.vUserName = modal.find(".vUserName").val();
                data.vAccount = modal.find(".vAccount").val();
                data.vPassword = CryptoJS.MD5(modal.find(".vPassword").val()).toString(CryptoJS.enc.Base64);
                $.ajax({
                    url: url_doadd,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 1000)
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
