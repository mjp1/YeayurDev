<!DOCTYPE html>
<html lang="en" xmlns="https://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta name="description" content="Yeayur is an online social platform that enables game streamers to market themselves and helps fans find and connect with their favorite streamers.">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('images/Untitled.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('css/editprofile.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forgotpasswordstyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/globalstyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/registerstyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/streamerstyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/mainstyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/supportstyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/searchstyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/oauthstyles.css') }}" /> 
    <link rel="stylesheet" href="{{ asset('css/bootstrap-tour.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/emoji/nanoscroller.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/emoji/emoji.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.ui/1.11.4/themes/flick/jquery-ui.min.css" />
    <link rel="stylesheet" href="{{ asset('css/jquery.tagit.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl/owl.theme.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ngInfiniteScroll/1.2.1/ng-infinite-scroll.min.js"></script>
    <script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
    <script src="https://twemoji.maxcdn.com/2/twemoji.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.ui/1.11.4/jquery-ui.min.js"></script>
    <script src="{{ asset('js/angular-route.js') }}"></script>
    <script src="{{ asset('js/loginscripts.js') }}"></script>
    <script src="{{ asset('js/streamerscripts.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/jquery.infinitescroll.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-tour.min.js') }}"></script>
    <script src="{{ asset('/js/tag-it.js') }}"></script>
    

    <title>Yeayur - Where the Streamer Meets the Viewer</title>
</head>

<body>
    <!-- INCLUDE NAVIGATION BAR TEMPLATE -->
    @include('templates.partials.navigation')

    @if (Route::current()->getName() === 'index')
    <div class="container-fluid">
        @yield('content')
    </div>
    @else
    <div class="container">
        @yield('content')
    </div>
    @endif
    
    <!-- INCLUDE FOOTER SECTION TEMPLATE -->
    @include('templates.partials.footer')

    <!-- INCLUDE THE CREATE FAN PAGE MODAL ON EACH PAGE -->
    @include('templates.partials.fanpagemodal')
    <!-- Algolia Search script -->
    <script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
</body>
</html>
