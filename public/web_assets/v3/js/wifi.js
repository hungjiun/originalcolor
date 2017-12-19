$(function(){
    function wifiinit(){
        $('select[name=borrow]').on('change',showData1);
        $('select[name=return]').on('change',showData2);

        for(var i=1;i<=3;i++){$('.borrow'+i).hide()}
        for(var i=1;i<=3;i++){$('.return'+i).hide()}    

        number();
    }

    //產生數字
    function number(){
        for(var i=0;i<=23;i++){
            $('<option></option>').html(i).val(i).appendTo($('select[name=hour]'));
        }
        for(var p=0;p<=59;p++){
            $('<option></option>').html(p).val(p).appendTo($('select[name=minute]'));
        }
    }

    //顯示資料1
    function showData1(){
        switch(this.options.selectedIndex){
            case 0:
                for(var i=1;i<=3;i++){$('.borrow'+i).hide()}
                break;
            case 1:
                for(var i=1;i<=3;i++){$('.borrow'+i).hide()}
                $('.borrow1').show();
                break;
            case 2:
                for(var i=1;i<=3;i++){$('.borrow'+i).hide()}
                $('.borrow2').show();
                break;
            case 3:
                for(var i=1;i<=3;i++){$('.borrow'+i).hide()}
                $('.borrow3').show();
                break;
        }       
    }

    //顯示資料2
    function showData2(){
        switch(this.options.selectedIndex){
            case 0:
                for(var i=1;i<=3;i++){$('.return'+i).hide()}
                break;
            case 1:
                for(var i=1;i<=3;i++){$('.return'+i).hide()}
                $('.return1').show();
                break;
            case 2:
                for(var i=1;i<=3;i++){$('.return'+i).hide()}
                $('.return2').show();
                break;
            case 3:
                for(var i=1;i<=3;i++){$('.return'+i).hide()}
                $('.return3').show();
                break;
        }       
    }

    wifiinit();

});