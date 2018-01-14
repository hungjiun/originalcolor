$(document).ready(function() {
    $('.thumbnail').on('click',function(){
        var str = $(this).data('target');
        console.log(str);
    })
});


