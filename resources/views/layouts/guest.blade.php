<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- CSRF Token -->
    <meta name='csrf-token' content='{{ csrf_token() }}'>

    <title>TukTuk</title>

    <link rel='icon' type='image/png' href="{{ asset('public/back/img/favicons/favicon-96x96.png') }}" sizes='96x96' />
    <link rel='icon' type='image/svg+xml' href="{{ asset('public/back/img/favicons/favicon.svg') }}" />
    <link rel='shortcut icon' href="{{ asset('public/back/img/favicons/favicon.ico') }}" />
    <link rel='apple-touch-icon' sizes='180x180' href="{{ asset('public/back/img/favicons/apple-touch-icon.png') }}" />
    <link rel='manifest' href="{{ asset('public/back/img/favicons/site.webmanifest') }}" />

    <!-- bootstrap -->
    <link
        rel='stylesheet'
        type='text/css'
        href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
        integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH'
        crossorigin='anonymous'
        onerror="this.onerror=null;this.href='{{ asset('public/back/css/bootstrap.min.css') }}';"
    >
    <link
        rel='stylesheet'
        type='text/css'
        href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css'
        crossorigin='anonymous'
        onerror="this.onerror=null;this.href='{{ asset('public/back/css/font-awesome.min.css') }}';"
    >

    <link rel='stylesheet' href="{{ asset('public/back/css/guest-stylesheet.css') }}">
</head>

<body style="background-image: url('{{ asset('public/back/img/login_bg.jpg') }}')">
    <div class='container-fluid'>
        <div class='container'>
            <div class='row justify-content-center align-items-center' style='min-height: 100vh'>
                <div class='col-lg-6 d-lg-block d-none login_left_div'>
                    <div class='login_img'>
                        <img class='' src="{{ asset('public/back/img/login_img.png') }}">
                    </div>
                </div>

                <div class='col-lg-6'>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script
        src='https://code.jquery.com/jquery-3.7.1.min.js'
        integrity='sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo='
        crossorigin='anonymous'
    ></script>
    <script type='text/javascript'>
        if (typeof jQuery === 'undefined') {
            console.warn('The jQuery CDN is Not Functioning!');
            document.write("<script src='{{ asset('public/back/js/jquery.min.js'); }}'>\x3C/script>");
        }
    </script>

    <script
        src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'
        integrity='sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz'
        crossorigin='anonymous'
    ></script>
    <script type='text/javascript'>
        if (typeof bootstrap === 'undefined') {
            console.warn('The Bootstrap CDN is Not Functioning!');
            document.write("<script src='{{ asset('public/back/js/bootstrap.bundle.min.js'); }}'>\x3C/script>");
        }
    </script>

    @yield('footer')
</body>

</html>
