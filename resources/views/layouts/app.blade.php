<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="icon" href= {{ asset('images/favico.ico') }}>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstap Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" integrity="sha512-xnP2tOaCJnzp2d2IqKFcxuOiVCbuessxM6wuiolT9eeEJCyy0Vhcwa4zQvdrZNVqlqaxXhHqsSV1Ww7T2jSCUQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('styles')

</head>
<body>
    <div id="app">
        <!-- Preloader -->
        <div id="preloader">

            <div id="status">&nbsp;
                <img width="100%" src="{{asset('images/preloader.gif')}}" />
            </div>
        </div>
        @include('layouts.partials._navbar')
        <a  href="#app"
            title="GO TO TOP"
            class="btn bg-purple text-white mb-5 mr-3 rounded-circle animate__animated  animate__slow "
            id="back-to-top">
        <i class="fa fa-arrow-up"></i>
        </a>
        <main class="">
            <div class="p-4">
                @include('layouts.partials._session-message')
            </div>
            <div class="d-flex justify-content-center flex-wrap">
                @yield('sidebar')
                @yield('content')
            </div>
            @include('layouts.partials._footer')
        </main>
    </div>

    <script src="{{asset('js/app.js')}}"></script>

    <!-- JQUERY VALIDATOR-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{asset('js/MySmoothScroll.js')}}"></script>
    <script>
        $('#back-to-top').hide();
        new MySmoothScroll("#back-to-top");
    </script>
    <script>
        $(window).scroll(function () {
                if ($(this).scrollTop() > 60) {
                    $('#back-to-top').fadeIn('2000');
                    $('.navbar').addClass('shadow-sm');
                    $('#back-to-top').removeClass('animate__backOutUp');
                    $('#back-to-top').addClass('animate__backInDown');
                } else {
                    $('#back-to-top').removeClass('animate__backInDown');
                    $('#back-to-top').addClass('animate__backOutUp');
                    $('.navbar').removeClass('shadow-sm');
                }
            });
    </script>
        <script>
            $(window).on('load', function() {
                $('#status').delay(1000).fadeOut();
                $('#preloader').delay(1000).fadeOut('slow');
                $('body').delay(1000).css({'overflow':'visible'});
            });
        </script>
    @yield('scripts')
</body>
</html>
