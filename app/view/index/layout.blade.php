<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=11,IE=10,IE=9,IE=8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <title>{{ $system['website'] }}-收录最全面的福利导航</title>
    <meta name="keywords" content="{{ $system['keyword'] }}">
    <meta name="description" content="{{ $system['descr'] }}">
    <link rel="stylesheet" id="da-main-css" href="/public/style.css?v0.12" type="text/css" media="all">
</head>
<body class="page page-id-5013 page-template page-template-pagesnav-php">
<div class="pageheader">
    <div class="container">
        <h1><a href="/" title="{{ $system['website'] }}-{{ $system['descr'] }}">{{ $system['website'] }}</a></h1>
        <div class="note">
            {!! $system['notice'] !!}
        </div>
    </div>
</div>
<section class="container" id="navs">
    <nav>
        <li id="nvabar-item-index"><a href="/#top" target="_self">首页</a></li>
        @foreach($sort as $key=>$value)
            <li id="navbar-category-{{ $key + 1 }}"><a href="/#{{ $value->code }}" target="_self">{{ $value->title }}</a></li>
        @endforeach
    </nav>
    <div class="items">
        <div style="text-align: center;color: red;background-color: #fff;">
            <p>每次来访+1IP，来路越多首页排名越靠前（每日凌晨所有当日来路清零）</p>
            <p style="font-weight: bold;">
                <span style="color:#FFBBFF !important;">30次紫色、</span>
                <span style="color:#B8860B !important;">50次棕色、</span>
                <span style="color:#EE7600 !important;">100次橘黄、</span>
                <span style="color:#D02090 !important;">200次粉色、</span>
                <span style="color:#0000FF !important;">300次蓝色、</span>
                <span style="color:red !important;">500次红色、</span>
            </p>
        </div>

    </div>
    <div class="items">
        @if(!empty($system['banner_img']))
        <div class="adbannersss">
            <a href="{{ $system['banner_url'] }}" target="_blank">
                <img src="{{ $system['banner_img'] }}" data-bd-imgshare-binded="1">
            </a>
        </div>
        @endif
        @yield('content')
    </div>
</section>
<div id="footer">
    <div class="container">
        <p>&copy; Copyright {{ $system['weblink'] }} All rights reserved. Power By <a target="_blank" href="/" title="{{ $system['website'] }}">{{ $system['website'] }}</a>
        </p>
        <p>{{ $system['website'] }}（{{ $system['weblink'] }}）秉承创建完全绿色无广告福利导航的宗旨，努力打造福利导航第一品牌！</p>
        <div style="display: none">
            {!! $system['count'] !!}
        </div>
    </div>
</div>
<div style="position:absolute; top:50%;left:50%; width:300px; height:auto; margin-top:-150px; margin-left:-150px;background-color: #fff;display: none" id="alertWindow">
    <div class="header-title">提示信息</div>
    <div class="content-body"></div>
    <div class="footer-button">
        <button id="closeWindow">关闭</button>
    </div>
</div>
<script type="application/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
@yield('script')
<script type="application/javascript">
    $(document).on('click','#closeWindow',function(data){$("#alertWindow").fadeOut(100)});function alertWind(text){$(".content-body").text(text);$("#alertWindow").fadeIn(100)}
</script>
</body>
</html>