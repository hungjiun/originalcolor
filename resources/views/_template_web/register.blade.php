<!DOCTYPE html>
<html lang="en-us" id="extr-page">
<head>
    <meta charset="utf-8">
    <title>{{trans('web.title')}}</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- #CSS Links -->
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/font-awesome.min.css">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/smartadmin-production-plugins.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/smartadmin-production.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/smartadmin-skins.min.css">

    <!-- SmartAdmin RTL Support -->
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/smartadmin-rtl.min.css">

    <!-- We recommend you use "your_style.css" to override SmartAdmin
                 specific styles this will also ensure you retrain your customization with each SmartAdmin update.
            <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/your_style.css"> -->

    <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/demo.min.css">

    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <!-- #APP SCREEN / ICONS -->
    <!-- Specifying a Webpage Icon for Web Clip
                 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
    <link rel="apple-touch-icon" href="/web_assets/v3/img/splash/sptouch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/web_assets/v3/img/splash/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/web_assets/v3/img/splash/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/web_assets/v3/img/splash/touch-icon-ipad-retina.png">

    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="/web_assets/v3/img/splash/ipad-landscape.png"
          media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="/web_assets/v3/img/splash/ipad-portrait.png"
          media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="/web_assets/v3/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
    <!-- Sweet Alert -->
    <link href="/web_assets/v1/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="/web_assets/v1/css/plugins/toastr/toastr.min.css" rel="stylesheet">
</head>

<body id="login">
<header id="header">
    <!--<span id="logo"></span>-->
    <div id="logo-group">
        <span id="logo"> <img src="/images/logo.png" alt="SmartAdmin"></span>
        <!-- END AJAX-DROPDOWN -->
    </div>
    <span id="extr-page-header-space">
        <span class="hidden-mobile hiddex-xs">{{trans('web.register.already_register')}}</span>
        <a href="{{url('web/login')}}" class="btn btn-danger">{{trans('web.register.login')}}</a>
    </span>
</header>
<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="well no-padding">
                    <form id="smart-form-register" class="smart-form client-form">
                        <header> {{trans('web.register.register')}} </header>
                        <fieldset>
                            <section>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="vUserName" name="vUserName" maxlength="20" placeholder="{{trans('web.register.username')}}" value="Elvis">
                                    <b class="tooltip tooltip-bottom-right">{{trans('web.register.username')}}</b>
                                </label>
                            </section>
                            <section>
                                <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                    <input type="email" id="vAccount" name="vAccount" maxlength="50" placeholder="{{trans('web.register.account')}}" value="elvis@pin2wall.com">
                                    <b class="tooltip tooltip-bottom-right">{{trans('web.register.account')}}</b>
                                </label>
                            </section>
                            <section>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" id="vPassword" name="vPassword" maxlength="20" placeholder="{{trans('web.register.password')}}" value="123456">
                                    <b class="tooltip tooltip-bottom-right">{{trans('web.register.password')}}</b>
                                </label>
                            </section>
                            <section>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" name="passwordConfirm" maxlength="20" placeholder="{{trans('web.register.repassword')}}" value="123456">
                                    <b class="tooltip tooltip-bottom-right">{{trans('web.register.password')}}</b>
                                </label>
                            </section>
                        </fieldset>
                        <fieldset>
                            <section>
                                <label class="checkbox"> <input type="checkbox" name="iagree" id="iagree"> <i></i>{!!trans('web.register.agree')!!}</label>
                            </section>
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-primary">{{trans('web.register.register')}}</button>
                        </footer>
                        <div class="message">
                            <i class="fa fa-check"></i>
                            <p>{{trans('web.register.register_success')}}</p>
                        </div>
                    </form>
                </div>
                <p class="note text-center">{{trans('web.register.footer')}}</p>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myAgree" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">{{trans('web.register.agree_title')}}</h4>
            </div>
            <div class="modal-body custom-scroll terms-body">
                <div id="left">
                    <h1>{{trans('web.register.agree_content_h1')}}</h1>
                    <h2>{{trans('web.register.agree_content_h2')}}</h2>
                    <p>{{trans('web.register.agree_content')}}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('web.cancel')}}</button>
                <button type="button" class="btn btn-primary" id="i-agree">
                    <i class="fa fa-check"></i> {{trans('web.agree')}}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script src="/web_assets/v3/js/plugin/pace/pace.min.js"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script> if (!window.jQuery) {
        document.write('<script src="/web_assets/v3/js/libs/jquery-2.1.1.min.js"><\/script>');
    } </script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script> if (!window.jQuery.ui) {
        document.write('<script src="/web_assets/v3/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    } </script>
<script src="//malsup.github.com/jquery.form.js"></script>

<!-- IMPORTANT: APP CONFIG -->
<script src="/web_assets/v3/js/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
    <script src="/web_assets/v3/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

<!-- BOOTSTRAP JS -->
<script src="/web_assets/v3/js/bootstrap/bootstrap.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="/web_assets/v3/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="/web_assets/v3/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="/web_assets/v3/js/app.min.js"></script>
<!-- Sweet alert -->
<script src="/web_assets/v1/js/plugins/sweetalert/sweetalert.min.js"></script>
<!-- Toastr script -->
<script src="/web_assets/v1/js/plugins/toastr/toastr.min.js"></script>
<!-- Plugin Customer-->
<script type="text/javascript" src="/_assets/CryptoJS/rollups/md5.js"></script>
@include('_template_web._js.var')
<script type="text/javascript">
    runAllForms();
    // Model i agree button
    $("#i-agree").click(function () {
        $this = $("#iagree");
        if ($this.checked) {
            $('#myAgree').modal('toggle');
        } else {
            $this.prop('checked', true);
            $('#myAgree').modal('toggle');
        }
    });

    // Validation
    $(function () {
        // Validation
        $("#smart-form-register").validate({

            // Rules for form validation
            rules: {
                vUserName: {
                    required: true
                },
                vAccount: {
                    required: true,
                    email: true
                },
                vPassword: {
                    required: true,
                    minlength: 4,
                    maxlength: 20
                },
                passwordConfirm: {
                    required: true,
                    minlength: 4,
                    maxlength: 20,
                    equalTo: '#vPassword'
                },
                iagree: {
                    required: true
                }
            },

            // Messages for form validation
            messages: {
                vUserName: {
                    required: '{{trans("web.register.username")}}'
                },
                vAccount: {
                    required: '{{trans("web.register.account")}}',
                    email: '{{trans("web.register.account_fail")}}'
                },
                vPassword: {
                    required: '{{trans("web.register.password")}}',
                    minlength: '{{trans("web.register.password_more_4")}}',
                    maxlength: '{{trans("web.register.password_less_20")}}'
                },
                passwordConfirm: {
                    required: '{{trans("web.register.repassword")}}',
                    minlength: '{{trans("web.register.password_more_4")}}',
                    maxlength: '{{trans("web.register.password_less_20")}}',
                    equalTo: '{{trans("web.register.repassword_check")}}'
                },
                iagree: {
                    required: '{{trans("web.register.agree_check")}}'
                }
            },

            // Ajax form submition
            submitHandler: function (form) {
                form = "";
                var data = {"_token": "{{ csrf_token() }}"};
                data.vUserName = $("#vUserName").val();
                data.vAccount = $("#vAccount").val();
                data.vPassword = CryptoJS.MD5($("#vPassword").val()).toString(CryptoJS.enc.Base64);
                if (!$("#iagree").prop('checked')) {
                    return;
                }
                $.ajax({
                    url: url_doReg,
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
            },

            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });
    });
</script>
</body>
</html>