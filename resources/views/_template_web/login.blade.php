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
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

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
    <link rel="apple-touch-startup-image" href="/web_assets/v3/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="/web_assets/v3/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="/web_assets/v3/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
    <!-- Sweet Alert -->
    <link href="/web_assets/v1/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="/web_assets/v1/css/plugins/toastr/toastr.min.css" rel="stylesheet">
</head>
<!-- <body class="animated fadeInDown"> -->
<body class="">
<header id="header" style="height: 150px;">
    <div id="logo-group">
        <span id="logo"><img src="/portal_assets/images/apple-touch-icon.png" alt="OriginalColor" style="height: 130px;"></span>
    </div>
    <span id="extr-page-header-space">
    {{--<span class="hidden-mobile hiddex-xs">{{trans('web.login.register')}}</span>--}}
    {{--<a href="{{url('web/register')}}" class="btn btn-danger">{{trans('web.login.create_account')}}</a>--}}
    {{--</span>--}}
</header>
<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="well no-padding">
                    <form id="login-form" class="smart-form client-form">
                        <header> {{trans('web.login.login')}} </header>
                        <fieldset>
                            <section>
                                <label class="label">{{trans('web.login.account')}}</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="vAccount" name="vAccount" maxlength="50" value="">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i>{{trans('web.login.account')}}</b>
                                </label>
                            </section>
                            <section>
                                <label class="label">{{trans('web.login.password')}}</label>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" id="vPassword" name="vPassword" maxlength="20" value="">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> {{trans('web.login.password')}}</b>
                                </label>
                                <div class="note">
                                    <a href="{{url('web/forgotpassword')}}">{{trans('web.login.forgot_password')}}</a>
                                </div>
                            </section>
                            <!--
                            <section>
                                <label class="checkbox"> <input type="checkbox" name="remember">
                                    <i></i>{{trans('web.login.stay_signed_in')}}
                                </label>
                            </section>
                            -->
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-primary">{{trans('web.login.login')}}</button>
                        </footer>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================================================== -->
<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script src="/web_assets/v3/js/plugin/pace/pace.min.js"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script> 
	if (!window.jQuery) {
        document.write('<script src="/web_assets/v3/js/libs/jquery-2.1.1.min.js"><\/script>');
    } 
</script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script> 
	if (!window.jQuery.ui) {
        document.write('<script src="/web_assets/v3/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    } 
</script>

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

<h1>Your browser is out of date, please update your browser by going to
    www.microsoft.com/download</h1>

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
    $(function () {
        //
        $('#vAccount').val(localStorage.getItem('account'));
        $('#vPassword').val(localStorage.getItem('password'));
        if (localStorage.getItem('remember') == 'true') {
            $('input[name=remember]').prop("checked", true);
        } else {
            $('input[name=remember]').prop("checked", false);
        }
        // Validation
        $("#login-form").validate({
            // Rules for form validation
            rules: {
                vAccount: {
                    required: true,
                },
                vPassword: {
                    required: true,
                    minlength: 4,
                    maxlength: 20
                }
            },

            // Messages for form validation
            messages: {
                vAccount: {
                    required: "{{trans('web.login.account_empty')}}",
                    email: "{{trans('web.login.account_fail')}}"
                },
                vPassword: {
                    required: "{{trans('web.login.password_empty')}}",
                    minlength: '{{trans("web.login.password_more_4")}}',
                    maxlength: '{{trans("web.login.password_less_20")}}'
                }
            },


            // Ajax form submition
            submitHandler: function (form) {
                $(':input[type="submit"]').prop('disabled', true);
                form = "";
                var data = {"_token": "{{ csrf_token() }}"};
                data.vAccount = $("#vAccount").val();
                data.vPassword = CryptoJS.MD5($("#vPassword").val()).toString(CryptoJS.enc.Base64);
                $.ajax({
                    url: url_doLogin,
                    data: data,
                    type: "POST",
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");

                            if ($('input[name=remember]').prop("checked")) {
                                localStorage.setItem('account', $("#vAccount").val());
                                localStorage.setItem('password', $("#vPassword").val());
                                localStorage.setItem('remember', true);
                            } else {
                                localStorage.setItem('account', '');
                                localStorage.setItem('password', '');
                                localStorage.setItem('remember', false);
                            }
                            setTimeout(function () {
                                location.href = rtndata.rtnurl;
                            }, 1000)
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                            $(':input[type="submit"]').prop('disabled', false);
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