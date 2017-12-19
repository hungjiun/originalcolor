<script>
    //
    $(".btn-locale").click(function () {
        var locale = $(this).data('locale');
        $.ajax({
            url: url_doSetLocale + "/" + locale,
            data: {"_token": "{{ csrf_token() }}"},
            type: "POST",
            async: false,
            success: function (rtndata) {
                if (rtndata.status) {
                    location.reload();
                } else {
                    swal("{{trans('_web_alert.logout.success')}}", rtndata.message, "error");
                }
            }
        });

    });
    //
    $(".logout").click(function () {
        swal({
            title: "{{trans('_web_alert.logout.title')}}",
            text: "{{trans('_web_alert.logout.note')}}",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "{{trans('_web_alert.logout.cancel')}}",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "{{trans('_web_alert.logout.ok')}}",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: url_doLogout,
                data: {"_token": "{{ csrf_token() }}"},
                type: "POST",
                async: false,
                success: function (rtndata) {
                    if (rtndata.status) {
                        swal("{{trans('_web_alert.logout.success')}}", rtndata.message, "success");
                        setTimeout(function () {
                            location.href = "{{ url('web/login')}}";
                        }, 1000);
                    } else {
                        swal("{{trans('_web_alert.logout.success')}}", rtndata.message, "error");
                    }
                }
            });
        });
    });

    function copyTextToClipboard(text) {
        var textArea = document.createElement("textarea");
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            swal("提示", "網址已複製", "success");
        } catch (err) {
            swal("提示", "複製失敗", "error");
        }
        document.body.removeChild(textArea);
    }

    //**************************************
    // 台灣身份證檢查簡短版 for Javascript
    //**************************************
    function checkTwID(id) {
        //建立字母分數陣列(A~Z)
        var city = new Array(
            1, 10, 19, 28, 37, 46, 55, 64, 39, 73, 82, 2, 11,
            20, 48, 29, 38, 47, 56, 65, 74, 83, 21, 3, 12, 30
        )
        id = id.toUpperCase();
        // 使用「正規表達式」檢驗格式
        if (id.search(/^[A-Z](1|2)\d{8}$/i) == -1) {
            //alert('基本格式錯誤');
            return false;
        } else {
            //將字串分割為陣列(IE必需這麼做才不會出錯)
            id = id.split('');
            //計算總分
            var total = city[id[0].charCodeAt(0) - 65];
            for (var i = 1; i <= 8; i++) {
                total += eval(id[i]) * (9 - i);
            }
            //補上檢查碼(最後一碼)
            total += eval(id[9]);
            //檢查比對碼(餘數應為0);
            return ((total % 10 == 0 ));
        }
    }
</script>

