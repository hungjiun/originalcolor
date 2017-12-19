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
    <div id="content">
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="widget-body">
                    <form class="form-horizontal">
                        <fieldset>
                            <legend>{{trans("_menu.admin.member.customer.add.title")}}</legend>
                            <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('web.admin.group.type')}}</label>
                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                    <select class="form-control" id="iGroupId">
                                        <option value="0">--請選擇部門--</option>
                                        @foreach($group as $key => $var)
                                            <option value="{{$var->iId}}">{{$var->vGroupName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('web.account')}}</label>
                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                    <input class="form-control" id="vAccount" placeholder="員工編號" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('web.username')}}</label>
                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                    <input class="form-control" id="vUserName" placeholder="{{trans('web.username_input')}}" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('web.password')}}</label>
                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                    <input class="form-control" id="vPassword" placeholder="{{trans('web.password_input')}}" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">{{trans('web.repassword')}}</label>
                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                    <input class="form-control" id="vRePassword" placeholder="{{trans('web.repassword_input')}}" type="password">
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-default btn-cancel" type="button">{{trans('web.cancel')}}</button>
                                    <button class="btn btn-primary btn-doadd" type="button">
                                        <i class="fa fa-save"></i> {{trans('web.add')}}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </article>
            <!-- WIDGET END -->
        </div>
        <!-- end row -->
    </div>
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
        var url_index = "{{ url('web/admin/member/employee')}}";
        var url_doadd = "{{ url('web/admin/member/employee/doadd')}}";
        $(document).ready(function () {
            pageSetUp();
            //
            $(".btn-cancel").click(function () {
                location.href = url_index;
            })
            //
            $("#vAccount").blur(function () {
                if ($("#vAccount").val() == "") {
                    toastr.error("{{trans("web.register.account")}}", "{{trans('_web_alert.notice')}}")
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
                data.iGroupId = $("#iGroupId").val();
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
