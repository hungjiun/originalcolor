<script>
    //delay
    var delay_time = 1000;
    //Email格式檢查
    var reg_Email = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
    //電話格式檢查
    var reg_phoneTel = /^[\+]?[0-9\-\s]+$/;

    var url_doReg = "{{url('web/doRegister')}}";
    var url_doLogin = "{{url('web/doLogin')}}";
    var url_doSendVerification = "{{url('web/doSendVerification')}}";
    var url_doResetPassword = "{{url('web/doResetPassword')}}";
    var url_doLogout = "{{url('web/doLogout')}}";
    var url_doSetLocale = "{{url('web/doSetLocale')}}";

    var months = "一月,二月,三月,四月,五月,六月,七月,八月,九月,十月,十一月,十二月".split(",");
    var weekdays = "星期一,星期二,星期三,星期四,星期五,星期六,星期日".split(",");
    var weekdays2 = "星期日,星期一,星期二,星期三,星期四,星期五,星期六".split(",");
</script>