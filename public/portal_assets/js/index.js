$(document).ready(function() {
    /*
    $('nav#menu ul li a').on('click',function(){
        var str = $(this).data('href');

        if(str != ""){
            window.history.pushState('','uselessTitle','?tab='+str);
            loadPage(str);
        }        
    });
    */

    $("nav#menu").mmenu({
       "extensions": [
          "pagedim-black",
          "theme-dark"
       ],
       "navbars": [
          {
             "position": "bottom",
             "content": [
                /*
                "<a class='la la-envelope' href='#/'></a>",
                "<a class='la la-twitter' href='#/'></a>",
                "<a class='la la-facebook' href='#/'></a>"
                */
             ]
          }
       ]
    });
});


