<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="description" content="" />
    <link rel="canonical" href="" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta name="og:image" content="" />
    <meta name="twitter:card" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:title" content="" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('public/frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/mediaquery.css') }}" rel="stylesheet">
    <!-- Custom CSS -->

    <title>TukTuk</title>

    <!--favicon-->
    <link rel="shortcut icon" href="{{ asset('public/frontend/images/favicon.png') }}" />
    <!--favicon-->

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Add icon library -->

    <!-- owl carousel -->
    <link href="{{ asset('public/frontend/owl/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/owl/owl_css.css') }}">
    <!-- owl carousel -->

    <!-- Link Swiper's CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css'>

    <!-- loading effect -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/loading_styles.css') }}">
    <!-- loading effect -->

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend/gallery/fancybox.min.css') }}">
    <!-- Fancybox CSS -->

    <!-- date picker -->
    <link rel='stylesheet' href='{{ asset('public/frontend/date_picker/bootstrap-datepicker.min.css') }}'>
    <link src="{{ asset('public/frontend/date_picker/date_picker.css') }}">
    </link>
    <!-- date picker -->

    <!-- Include Parsley.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <!--scroll bar style-->
    <style>
        ::-webkit-scrollbar {
            background: #000000;
            height: 5px;
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 2px #73A9AD;
        }

        ::-webkit-scrollbar-thumb {
            background: #73A9AD;
            border-radius: 2px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #73A9AD;
        }

        .invalid-feedback {

            font-size: 0.6rem;

        }

        .sidebar-nav .nav-link.active-main {
            font-weight: bold;
            color: #2B2B2B !important;
        }

        .sidebar-nav .nav-link.active-sub {
            font-weight: 500;
        }

        .sidebar-nav .nav-link i.green_text {
            color: #3D9C7F;
        }

        .parsley-errors-list {
            color: #dc3545;
            font-size: 0.6rem;
            margin-top: 0.25rem;
        }

        .job-listing-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #eee;
            padding: 35px;
        }

        .job-listing-card:hover {
            transform: translateY(-5px);
            box-shadow: rgba(33, 35, 38, 0.1) 0px 10px 10px -10px !important;
        }

        .inner_banner {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('public/frontend/images/slider1.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 40vh;
            display: flex;
            align-items: flex-end;
        }

        .career_icon svg {
            width: 100px;
            height: 100px;
            fill: #3D9C7F;
        }
    </style>
    <!--scroll bar style-->


</head>

<body>

    <header class="navbar position-absolute w-100 nav_border">
        <div class="container d-flex justify-content-between nav_con">

            <a href="{{ route('/') }}">
                <img src="{{ asset('public/frontend/images/logo.png') }}" alt="" class="header_logo w-50">
            </a>

            <div class="d-flex align-items-center">



                <div class="pe-3">
                    <div class="top_nav d-flex justify-content-end gap-4">

                        <a href="">
                            <p class="mb-0 contact"><i class="fa-solid fa-phone me-2"></i> +94 77 347 0830</p>
                        </a>
                        <!-- ======================= -->
                        <a href="">
                            <p class="mb-0 contact"><i class="fa-regular fa-envelope me-2"></i> info@tuktuk.com </p>
                        </a>

                    </div>

                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('/') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('career') }}">Carrer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="experiences.html">Experiences</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="gallery.html">Gallery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border-0" href="contact.html">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

                @guest('frontend')
                    <a href="{{ route('login') }}">
                        <button class="fill_btn btn">
                            <i class="far fa-user"></i>
                            LOGIN
                        </button>
                    </a>

                    <a href="{{ route('register') }}">
                        <button class="line_btn btn ms-1">
                            SIGN IN
                        </button>
                    </a>
                @else
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none" id="dropdownUser1"
                            data-bs-toggle="dropdown" aria-expanded="false" style="color: #2B2B2B;">
                            <img src="@if (Auth::guard('frontend')->user()->profile_image) {{ asset('storage/app/private/' . Auth::guard('frontend')->user()->profile_image) }} @else {{ asset('public/frontend/images/profile.jpg') }} @endif"
                                alt="Sajani" width="30" height="30" class="rounded-circle me-2">
                            HELLO, {{ Auth::guard('frontend')->user()->first_name }} <i
                                class="fas fa-chevron-down ms-1 fa-xs"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('passenger-dashboard') }}">My Dashboard</a></li>
                            {{-- <li><a class="dropdown-item" href="#">Settings</a></li> --}}
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <a class="dropdown-item" href="#"
                                        onclick="document.getElementById('logout-form').submit()">Sign out</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest


            </div>
        </div>
    </header>

    <!-- Inquiry Success Toast -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div id="success_toast" class="toast align-items-center text-white bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="success_message"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!-- Inquiry Error Toast -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div id="error_toast" class="toast align-items-center text-white bg-danger border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="error_message"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
