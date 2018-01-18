<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <meta name="title" content="原色車漆 ORIGINALCOLOR CO.,LTD." />
        <meta name="keywords" content="原色車漆,ORIGINAL COLOR,scratch free,補漆筆,刮傷">
        <meta name="description" content="原色車漆 OriginalColor 原廠原色補漆筆、展示架介紹，刮傷不用花大錢烤漆，讓原色車漆恢復您愛車原色">
        <meta name="author" content="原色車漆 ORIGINALCOLOR CO.,LTD."/>
        <meta name="copyright" content="原色車漆 © ORIGINALCOLOR CO.,LTD. 2015 All Rights Reserved">
        
        <meta property="og:title" content="原色車漆 - ORIGINAL COLOR CO.,LTD." />
        <meta property="og:description" content="原色車漆 OriginalColor 原廠原色補漆筆、展示架介紹，刮傷不用花大錢烤漆，讓原色車漆恢復您愛車原色"/>
        <meta property="og:site_name" content="原色車漆 OriginalColor" />

        <title>@yield('title')</title>
        <link rel="shortcut icon" href="/portal_assets/images/favicon.ico">
        <link rel="apple-touch-icon" href="/portal_assets/images/apple-touch-icon.png">
        <link rel="apple-touch-icon" size="120x120" href="/portal_assets/images/apple-touch-icon.png">

        <link type="text/css" rel="stylesheet" href="/portal_assets/css/reset.css" />
        <link type="text/css" rel="stylesheet" href="/portal_assets/dist/bootstrap/css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="/portal_assets/dist/mmenu/css/jquery.mmenu.all.css" />
        <link type="text/css" rel="stylesheet" type="/portal_assets/text/css" rel="stylesheet" href="/portal_assets/dist/lineawesome/css/line-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="/portal_assets/css/main.css" />
        <!-- ================== page-css ================== -->
        @yield('page-css')
        <!-- ================== /page-css ================== -->
    </head>

    <body>
        <div class="wrap">
            <!-- header start -->
            @include('_template_portal._layouts.header')
            <!--header end  -->
            <!-- MAIN CONTENT -->
            @yield('content')
            <!-- END MAIN CONTENT -->
                      
            <!-- footer start -->
            @include('_template_portal._layouts.footer')
            <!-- footer end -->
        </div>
        <nav id="menu">
            <ul>
                <li><a href="http://www.pchome.com.tw" target="_blank" data-href="">公司連結</a></li>
                <li><a href="{{url('index')}}" data-href="3dlogos">回主頁</a></li>
                <li><a href="{{url('search')}}" data-href="search">條件搜尋</a></li>
                <li><a href="{{url('description')}}" data-href="description">使用步驟說明</a></li>
                <li><a href="{{url('qa')}}" data-href="qa">故障問題排除</a></li>
                <li><a href="{{url('color_card')}}" data-href="color_card">色卡比對資料</a></li>
                @foreach($articleDealer as $key => $var)
                <li><a href="{{url('article')}}?iArticleId={{$var->iId}}">{{$var->vTitle}}</a></li>
                @endforeach
            </ul>
        </nav>

        <script type="text/javascript" src="/portal_assets/js/libs/jquery.min.js"></script>
        <script type="text/javascript" src="/portal_assets/dist/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/portal_assets/dist/mmenu/js/jquery.mmenu.min.all.js"></script>
        <script type="text/javascript">
            /*  =============  Google GA  =================  */
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-81433617-1', 'auto');
            ga('send', 'pageview');
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
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
        </script>
        <!-- ================== page-js ================== -->
        @yield('page-js')
        <!-- ================== /page-js ================== -->

        <!-- ================== inline-js ================== -->
        @yield('inline-js')
        <!-- ================== /inline-js================== -->
    </body>
</html>