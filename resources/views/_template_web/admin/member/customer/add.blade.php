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
    <!--  -->
    <section class="content">
        <div class="row flex-center">
            <div class="col-md-8">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{trans("_menu.admin.member.customer.add.title")}}</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{trans('web.account')}}</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="vAccount" placeholder="{{trans('web.account_input')}}" type="text">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{trans('web.username')}}</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="vUserName" placeholder="{{trans('web.username_input')}}" type="text">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{trans('web.password')}}</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="vPassword" placeholder="{{trans('web.password_input')}}" type="password">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{trans('web.repassword')}}</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="vRePassword" placeholder="{{trans('web.repassword_input')}}" type="password">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="box-footer">
                            <!--
                            <button class="pull-right btn btn-primary btn-doadd" type="button">
                                <i class="fa fa-save"></i> {{trans('web.add')}}
                            </button>
                            <button class="pull-right btn btn-default btn-cancel" type="button">{{trans('web.cancel')}}</button>
                            -->
                            <button type="button" class="btn btn-default btn-cancel">{{trans('web.cancel')}}</button>
                            <button type="button" class="btn btn-primary btn-doadd">
                                <i class="fa fa-save"></i> {{trans('web.doadd')}}
                            </button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
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
    <!-- PAGE RELATED PLUGIN(S) -->
    <script type="text/javascript" src="/_assets/CryptoJS/rollups/md5.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <!-- Public Crop_Image -->
    @include('_template_web._js.crop_image_single')
    <!-- end -->
    <script>
        var url_index = "{{ url('web/admin/member/customer')}}";
        var url_doadd = "{{ url('web/admin/member/customer/doadd')}}";
        $(document).ready(function () {
            //
            $(".btn-cancel").click(function () {
                location.href = url_index;
            })
            //
            $("#vAccount").blur(function () {
                if ($("#vAccount").val() != "" && !reg_Email.test($("#vAccount").val())) {
                    toastr.error("{{trans("web.register.account_fail")}}", "{{trans('_web_alert.notice')}}")
                    $("#vAccount").parent().addClass('has-error');
                } else {
                    $("#vAccount").parent().removeClass('has-error');
                }
            })
            //
            $("#vPassword").blur(function () {
                if ($("#vRePassword").val() != $("#vPassword").val()) {
                    $("#vRePassword").parent().addClass('has-error');
                } else {
                    $("#vRePassword").parent().removeClass('has-error');
                }
            })
            //
            $("#vRePassword").blur(function () {
                if ($("#vRePassword").val() != $("#vPassword").val()) {
                    $("#vRePassword").parent().addClass('has-error');
                } else {
                    $("#vRePassword").parent().removeClass('has-error');
                }
            })
            //
            $(".btn-doadd").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};
                data.vUserName = $("#vUserName").val();
                data.vAccount = $("#vAccount").val();
                data.vPassword = CryptoJS.MD5($("#vPassword").val()).toString(CryptoJS.enc.Base64);
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
            })
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
