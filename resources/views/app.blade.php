<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ,user-scalable=no, maximum-scale=1">
    <title>{{config("app.name")}}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="/manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/images/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- 네이버 검색등록 -->
    <meta name="naver-site-verification" content="176d82cebc7be401aba447419c9fa471a2c20700" />
<!--    <meta name="naver-site-verification" content="6b8a07b01f8c06fc2496354eec41e10d18c29376" />-->
    <meta name="description" content="1:1 프리미엄 소개팅 서비스, 오프라인 파티 서비스, 철저한 신원인증, 전담매니저 관리, 가입부터 만남까지 올인원관리">
    <meta property="og:type" content="website">
    <meta property="og:title" content="만날사람들">
    <meta property="og:image" content="{{asset("images/insa-kakao-img.jpg")}}">
    <meta property="og:description" content="1:1 프리미엄 소개팅 서비스, 오프라인 파티 서비스, 철저한 신원인증, 전담매니저 관리, 가입부터 만남까지 올인원관리">
    <meta property="og:url" content="https://insacompany.com">
    <meta name="twitter:card" content="1:1 프리미엄 소개팅 서비스, 오프라인 파티 서비스, 철저한 신원인증, 전담매니저 관리, 가입부터 만남까지 올인원관리">
    <meta name="twitter:title" content="만날사람들">
    <meta name="twitter:description" content="1:1 프리미엄 소개팅 서비스, 오프라인 파티 서비스, 철저한 신원인증, 전담매니저 관리, 가입부터 만남까지 올인원관리">
    <meta name="twitter:domain" content="만날사람들">

    <!-- 구글검색등록 -->
    <meta name="google-site-verification" content="MpGSFJzfvoMQB4LaRNSrK419lLPHMFPmLd1MmZgZwGw" />

    <link rel="stylesheet" type="text/css" href="{{asset("css/common.css?v=".\Carbon\Carbon::now()->format("YmdHi"))}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/main.css?v=".\Carbon\Carbon::now()->format("YmdHi"))}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/mypage.css?v=".\Carbon\Carbon::now()->format("YmdHi"))}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/login.css?v=".\Carbon\Carbon::now()->format("YmdHi"))}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/chat.css?v=".\Carbon\Carbon::now()->format("YmdHi"))}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/developer.css?v=".\Carbon\Carbon::now()->format("YmdHi"))}}">
    <!-- 스와이퍼 -->
    <!-- <link rel="stylesheet" type="text/css" href="/css/swiper.min.css"> -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <!-- aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- 폰트 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700;800&family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- 아이콘 -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
    <script defer src="/js/jquery.js"></script>

    <!-- 아임포트 -->
    <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.8.js"></script>
    <script type="text/javascript" src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=a156616c5072df75c708e08fb1b93de4&libraries=services"></script>

    <script src="{{ mix('/js/app.js') }}" defer></script>

    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '529437559215104');
        fbq('track', 'PageView');
    </script>
    <script>
        (function(){var w=window;if(w.ChannelIO){return w.console.error("ChannelIO script included twice.");}var ch=function(){ch.c(arguments);};ch.q=[];ch.c=function(args){ch.q.push(args);};w.ChannelIO=ch;function l(){if(w.ChannelIOInitialized){return;}w.ChannelIOInitialized=true;var s=document.createElement("script");s.type="text/javascript";s.async=true;s.src="https://cdn.channel.io/plugin/ch-plugin-web.js";var x=document.getElementsByTagName("script")[0];if(x.parentNode){x.parentNode.insertBefore(s,x);}}if(document.readyState==="complete"){l();}else{w.addEventListener("DOMContentLoaded",l);w.addEventListener("load",l);}})();

        ChannelIO('boot', {
            "pluginKey": "672209d0-d86b-4832-895c-f0ffeca895c0"
        });
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=529437559215104&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->
</head>
<body>
@inertia
</body>
</html>
