@include('userpanel.includes.header')


<!-- main slider start -->



<!-- ============================== -->
<!-- ============================== -->

<div id="carouselExampleCaptions" class="carousel slide main_slider mb-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active slider_img"
            style="background-image: linear-gradient(180deg,rgba(255, 255, 255, 0) 20%, rgba(0, 0, 0, 1) 100%), url({{ asset('public/frontend/images/slider1.jpg') }})">
        </div>

        <!-- ============================== -->

        <div class="carousel-item slider_img"
            style="background-image: linear-gradient(180deg,rgba(255, 255, 255, 0) 20%, rgba(0, 0, 0, 1) 100%), url({{ asset('public/frontend/images/slider1.jpg') }})">
        </div>

        <!-- ============================== -->

        <div class="carousel-item slider_img"
            style="background-image: linear-gradient(180deg,rgba(255, 255, 255, 0) 20%, rgba(0, 0, 0, 1) 100%), url({{ asset('public/frontend/images/slider1.jpg') }})">
        </div>
    </div>

    <div class="carousel-caption container">
        <div class="row">
            <div class="col-6 white_bg rounded p-4">

                <h3 class="text-dark fw-bold" data-aos="fade-up">BOOK NOW</h3>
                <form class="booking_form" action="{{ route('booking') }}" method="post" id="booking_search_form"
                    class="needs-validation" novalidate>
                    @csrf
                    <div class="row justify-content-center">

                        <div class="col-6">
                            <div class="booking_form_slider">
                                <div class="form-floating d-flex mb-3">
                                    <input type="text"
                                        class="datepicker_input form-control shadow-none datepicker-input"
                                        id="check_in" placeholder="DD/MM/YYYY" autocomplete="off" name="check_in"
                                        data-readonly="true" onchange="hideDateField(this)" required>
                                    <label for="check_in">Pick-Up Date</label>
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <div class="invalid-feedback">Pick-Up Date is required.</div>
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="booking_form_slider">
                                <div class="form-floating mb-3">
                                    <select class="form-select shadow-none" name="picakup_location"
                                        id="picakup_location" aria-label="Floating label select example"
                                        fdprocessedid="i20ioc" required>
                                        <option value="">Pickup Location</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="picakup_location">City</label>
                                    <div class="invalid-feedback"> Pickup Location is required.</div>
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="booking_form_slider">
                                <div class="form-floating d-flex mb-3">
                                    <input type="text"
                                        class="datepicker_input form-control shadow-none datepicker-input"
                                        id="check_out" placeholder="DD/MM/YYYY" autocomplete="off" required
                                        name="check_out" data-readonly="true" onchange="hideDateField(this)">
                                    <label for="check_out">Return Date</label>
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <div class="invalid-feedback">Return Date is required.</div>
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="booking_form_slider">
                                <div class="form-floating mb-3">
                                    <select class="form-select shadow-none" name="return_location" id="return_location"
                                        aria-label="Floating label select example" fdprocessedid="i20ioc" required>
                                        <option value="">Return Location</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="return_location">City</label>
                                    <div class="invalid-feedback">Return Location is required.</div>
                                </div>

                            </div>
                        </div>

                        <div class="col-10">
                            <button class="fill_btn btn w-100" type="submit" id="search_btn">
                                SEARCH
                                <i class="fas fa-arrow-right ps-2"></i>
                            </button>
                        </div>

                    </div>
                </form>
            </div>

            <div class="col-6 d-flex justify-content-end flex-column ps-4">
                <h1 class="main_heading mb-2 text-light" data-aos="fade-up">
                    <span>DISCOVER THE HEART OF SRI LANKA</span>
                    RENT A TUK FOR GENUINE LOCAL ENCOUNTERS!
                </h1>
                <p class="text-start text-light">Rent a tuk tuk, explore Sri Lanka authentically, and connect with
                    locals for
                    unforgettable experiences off the beaten path. <i class="fas fa-arrow-right ps-2"></i></p>
            </div>

        </div>
    </div>

</div>

<!-- main slider end -->

<!-- ============================== -->
<!-- ============================== -->

<!-- about us start -->

<div class="container p-3 mb-5">
    <div class="row">
        <div class="col-6">
            <div class="cover_img rounded-3"
                style="background-image: url({{ asset('public/frontend/images/about_img.jpg') }});">
            </div>
        </div>

        <div class="col-6 p-5 bg_light rounded-3">
            <h3 style="color: #FED700;" data-aos="fade-up">Let’s travel</h3>
            <h1 class="mb-3" data-aos="fade-down">
                Start Exploring: Your Ultimate Tuk Tuk Adventure Awaits
            </h1>

            <ul class="custom_list mb-3">
                <li>Contrary to popular belief, Lorem Ipsum is not simply random text</li>
                <li>If you are going to use a passage of Lorem Ipsum</li>
                <li>Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words
                    etc.</li>
                <li>It is a long established fact that a reader will be distracted by the readable content of a page
                    when looking at its layout.</li>
                <li>It is a long established fact that a reader will be distracted by the readable content of a page
                    when looking at its layout.</li>
                <li>It is a long established fact that a reader will be distracted by the readable content of a page
                    when looking at its layout.</li>
            </ul>

            <button class="fill_btn btn">
                READ MORE
                <i class="fas fa-arrow-right ps-2"></i>
            </button>

        </div>
    </div>
</div>

<!-- about us end -->

<!-- ================================= -->

<div class="clearfix"></div>

<!-- choose vehicle start -->

<div class="container-fluid pt-5 mb-5"
    style="background-image: url({{ asset('public/frontend/images/bg_dark.jpg') }}); background-position: center; background-size: cover; background-repeat: no-repeat;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 mb-5">
                <h1 class="mb-5 text-center text-light" data-aos="fade-up">Discover Unforgettable Destinations with
                    Our Expert Guidance!</h1>

                <div class="row justify-content-center">

                    <div class="col-4 mb-4" data-aos="fade-up">
                        <div class="align-items-center icon_box">
                            <div class="icon_div yellow_bg">
                                <img src="{{ asset('public/frontend/images/icon.png') }}" alt=""
                                    class="w-100">
                            </div>
                            <div class="text-center gray_bg text_box">
                                <h2>
                                    <b>Customized Map</b>
                                </h2>
                                <p class="mb-0">
                                    Lorem Ipsum is simply dummy text of the printing
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- ================ -->

                    <div class="col-4 mb-4" data-aos="fade-down">
                        <div class="align-items-center icon_box">
                            <div class="icon_div yellow_bg">
                                <img src="{{ asset('public/frontend/images/icon.png') }}" alt=""
                                    class="w-100">
                            </div>
                            <div class="text-center gray_bg text_box">
                                <h2>
                                    <b>Customized Map</b>
                                </h2>
                                <p class="mb-0">
                                    Lorem Ipsum is simply dummy text of the printing
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- ================ -->

                    <div class="col-4 mb-4" data-aos="fade-up">
                        <div class="align-items-center icon_box">
                            <div class="icon_div yellow_bg">
                                <img src="{{ asset('public/frontend/images/icon.png') }}" alt=""
                                    class="w-100">
                            </div>
                            <div class="text-center gray_bg text_box">
                                <h2>
                                    <b>Customized Map</b>
                                </h2>
                                <p class="mb-0">
                                    Lorem Ipsum is simply dummy text of the printing
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- ================ -->

                    <div class="col-4 mb-4" data-aos="fade-down">
                        <div class="align-items-center icon_box">
                            <div class="icon_div yellow_bg">
                                <img src="{{ asset('public/frontend/images/icon.png') }}" alt=""
                                    class="w-100">
                            </div>
                            <div class="text-center gray_bg text_box">
                                <h2>
                                    <b>Customized Map</b>
                                </h2>
                                <p class="mb-0">
                                    Lorem Ipsum is simply dummy text of the printing
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- ================ -->

                    <div class="col-4 mb-4" data-aos="fade-up">
                        <div class="align-items-center icon_box">
                            <div class="icon_div yellow_bg">
                                <img src="{{ asset('public/frontend/images/icon.png') }}" alt=""
                                    class="w-100">
                            </div>
                            <div class="text-center gray_bg text_box">
                                <h2>
                                    <b>Customized Map</b>
                                </h2>
                                <p class="mb-0">
                                    Lorem Ipsum is simply dummy text of the printing
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- ================ -->

                </div>

            </div>
        </div>
    </div>
</div>

<div class="container choose_con py-5">
    <div class="row justify-content-end">
        <div class="col-9">

            <h1 class="mb-4 text-center" data-aos="fade-up">Select Your favourites</h1>

            <div class="blog-slider">
                <div class="blog-slider__wrp swiper-wrapper">
                    <div class="blog-slider__item swiper-slide">
                        <div class="blog-slider__img">
                            <img src="{{ asset('public/frontend/images/tuk1.png') }}" alt="">
                        </div>

                        <div class="blog-slider__content">
                            <h3 class="blog-slider__code fw-bold">REGULAR TUK TUK</h3>
                            <p class="blog-slider__title">Experience the freedom of exploring at your own pace with our
                                tuk tuks, available for just $9 per day. Perfect for adventure seekers and budget
                                travelers, our tuk tuks offer flexibility, reliability, and a touch of local charm. Book
                                now and start your hassle-free journey through the heart of Sri Lanka!</p>
                            <h1 class="blog-slider__text" style="color: #3d9c7f;">9$ / Day</h1>

                            <button class="line_btn btn mt-4">
                                BOOK NOW
                                <i class="fas fa-arrow-right ps-2"></i>
                            </button>

                        </div>
                    </div>

                    <div class="blog-slider__item swiper-slide">
                        <div class="blog-slider__img">
                            <img src="{{ asset('public/frontend/images/tuk1.png') }}" alt="">
                        </div>

                        <div class="blog-slider__content">
                            <h3 class="blog-slider__code fw-bold">REGULAR TUK TUK</h3>
                            <p class="blog-slider__title">Experience the freedom of exploring at your own pace with our
                                tuk tuks, available for just $9 per day. Perfect for adventure seekers and budget
                                travelers, our tuk tuks offer flexibility, reliability, and a touch of local charm. Book
                                now and start your hassle-free journey through the heart of Sri Lanka!</p>
                            <h1 class="blog-slider__text" style="color: #3d9c7f;">9$ / Day</h1>
                            <button class="line_btn btn mt-4">
                                BOOK NOW
                                <i class="fas fa-arrow-right ps-2"></i>
                            </button>

                        </div>
                    </div>

                </div>

                <div class="blog-slider__pagination"></div>
            </div>

        </div>
    </div>
</div>

<!-- choose vehicle end -->

<div class="clearfix"></div>

<!-- banner start -->

<div class="container-fluid banner my-4"
    style="background-image: url({{ asset('public/frontend/images/banner.jpg') }});">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-5">
                <h1 class="mb-3" data-aos="fade-up">DISCOVER LOCAL GEMS, <span>SUPPORT COMMUNITIES ON YOUR
                        TRAVELS</span></h1>

                <button class="fill_btn btn">
                    READ MORE
                    <i class="fas fa-arrow-right ps-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- banner end -->

<div class="clearfix"></div>

<!-- ================= -->

<!-- blog start -->

<div class="container-fluid py-5" style="background-color: #FFFDF8;">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-7 text-center mb-4">
                <h1 data-aos="fade-up">Maximize Your Adventure Experience Here!</h1>
                <p data-aos="fade-down">Lorem Ipsum is therefore always free from repetition, injected humour, or
                    non-characteristic words etc.</p>
            </div>

            <div class="col-12">
                <div class="owl-carousel owl-theme blog_slider">
                    <div class="item">
                        <div class="owl_card bg_light ">
                            <img src="{{ asset('public/frontend/images/about_img.jpg') }}" alt=""
                                class="w-100">

                            <div class="owl_text p-3">
                                <p class="fw-bold mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi culpa nemo
                                    excepturi voluptate quidem id itaque quisquam officia nobis sint?</p>
                                <button class="line_btn btn">
                                    READ MORE
                                    <i class="fas fa-arrow-right ps-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- ============= -->
                    <div class="item">
                        <div class="owl_card bg_light ">
                            <img src="{{ asset('public/frontend/images/about_img.jpg') }}" alt=""
                                class="w-100">

                            <div class="owl_text p-3">
                                <p class="fw-bold mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi culpa nemo
                                    excepturi voluptate quidem id itaque quisquam officia nobis sint?</p>
                                <button class="line_btn btn">
                                    READ MORE
                                    <i class="fas fa-arrow-right ps-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- ============= -->
                    <div class="item">
                        <div class="owl_card bg_light ">
                            <img src="{{ asset('public/frontend/images/about_img.jpg') }}" alt=""
                                class="w-100">

                            <div class="owl_text p-3">
                                <p class="fw-bold mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi culpa nemo
                                    excepturi voluptate quidem id itaque quisquam officia nobis sint?</p>
                                <button class="line_btn btn">
                                    READ MORE
                                    <i class="fas fa-arrow-right ps-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- ============= -->
                    <div class="item">
                        <div class="owl_card bg_light ">
                            <img src="{{ asset('public/frontend/images/about_img.jpg') }}" alt=""
                                class="w-100">

                            <div class="owl_text p-3">
                                <p class="fw-bold mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi culpa nemo
                                    excepturi voluptate quidem id itaque quisquam officia nobis sint?</p>
                                <button class="line_btn btn">
                                    READ MORE
                                    <i class="fas fa-arrow-right ps-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- ============= -->
                    <div class="item">
                        <div class="owl_card bg_light ">
                            <img src="{{ asset('public/frontend/images/about_img.jpg') }}" alt=""
                                class="w-100">

                            <div class="owl_text p-3">
                                <p class="fw-bold mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi culpa nemo
                                    excepturi voluptate quidem id itaque quisquam officia nobis sint?</p>
                                <button class="line_btn btn">
                                    READ MORE
                                    <i class="fas fa-arrow-right ps-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- ============= -->
                    <div class="item">
                        <div class="owl_card bg_light ">
                            <img src="{{ asset('public/frontend/images/about_img.jpg') }}" alt=""
                                class="w-100">

                            <div class="owl_text p-3">
                                <p class="fw-bold mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi culpa nemo
                                    excepturi voluptate quidem id itaque quisquam officia nobis sint?</p>
                                <button class="line_btn btn">
                                    READ MORE
                                    <i class="fas fa-arrow-right ps-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- ============= -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- blog end -->

<div class="clearfix"></div>

<!-- ================= -->

<!-- testimonials start -->

<div class="container testi_con py-5">
    <div class="row justify-content-end py-5">
        <div class="col-7 position-relative">

            <h1 class="mb-5 text-center" data-aos="fade-up">What Our Clients Say About Us</h1>

            <div class="testi_slider owl-carousel owl-theme">
                <div class="item">
                    <div class="testi_card bg_light">

                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset('public/frontend/images/avatar1.jpg') }}" alt=""
                                    class="w-100 testi_img">
                            </div>

                            <div class="col-10">
                                <h2>Hannah Schmitt</h2>
                                <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh
                                    mauris, nec turpis orci lectus maecenas. Suspendisse sed magna eget nibh in turpis.
                                    Consequat duis diam lacus arcu. Faucibus venenatis felis id augue sit cursus
                                    pellentesque enim Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                                <div class="d-flex rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>

                                <p class="date">May 8, 2020</p>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============= -->
                <div class="item">
                    <div class="testi_card bg_light">

                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset('public/frontend/images/avatar1.jpg') }}" alt=""
                                    class="w-100 testi_img">
                            </div>

                            <div class="col-10">
                                <h2>Hannah Schmitt</h2>
                                <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh
                                    mauris, nec turpis orci lectus maecenas. Suspendisse sed magna eget nibh in turpis.
                                    Consequat duis diam lacus arcu. Faucibus venenatis felis id augue sit cursus
                                    pellentesque enim Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                                <div class="d-flex rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>

                                <p class="date">May 8, 2020</p>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============= -->
                <div class="item">
                    <div class="testi_card bg_light">

                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset('public/frontend/images/avatar1.jpg') }}" alt=""
                                    class="w-100 testi_img">
                            </div>

                            <div class="col-10">
                                <h2>Hannah Schmitt</h2>
                                <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh
                                    mauris, nec turpis orci lectus maecenas. Suspendisse sed magna eget nibh in turpis.
                                    Consequat duis diam lacus arcu. Faucibus venenatis felis id augue sit cursus
                                    pellentesque enim Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                                <div class="d-flex rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>

                                <p class="date">May 8, 2020</p>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============= -->
                <div class="item">
                    <div class="testi_card bg_light">

                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset('public/frontend/images/avatar1.jpg') }}" alt=""
                                    class="w-100 testi_img">
                            </div>

                            <div class="col-10">
                                <h2>Hannah Schmitt</h2>
                                <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh
                                    mauris, nec turpis orci lectus maecenas. Suspendisse sed magna eget nibh in turpis.
                                    Consequat duis diam lacus arcu. Faucibus venenatis felis id augue sit cursus
                                    pellentesque enim Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                                <div class="d-flex rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>

                                <p class="date">May 8, 2020</p>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============= -->


            </div>

            <div class="testi_icon">
                <img src="{{ asset('public/frontend/images/testi_icon.png') }}" alt="" class="w-100">
            </div>

        </div>
    </div>
</div>

<!-- testimonials end -->

<div class="clearfix"></div>

<!-- Features start -->

<div class="container-fluid pt-5" style="background-color: #FFFDF8;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 mb-5">
                <h1 class="mb-5 text-center" data-aos="fade-up">Our Features</h1>

                <div class="row justify-content-center">

                    <div class="col-3 mb-4 mt-4" data-aos="fade-up">
                        <div class="align-items-center icon_box">
                            <div class="icon_div yellow_bg">
                                <img src="{{ asset('public/frontend/images/icon.png') }}" alt=""
                                    class="w-100">
                            </div>
                            <div class="text-center bg_light text_box feature_card">
                                <h2>
                                    <b>Best Guide</b>
                                </h2>
                                <p class="mb-0">
                                    Suspendisse ultrices nibh non cursus sagittis. Morbi dictum consequat ex, quis
                                    finibus magna.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- ================ -->

                    <div class="col-3 mb-4" data-aos="fade-down">
                        <div class="align-items-center icon_box">
                            <div class="icon_div yellow_bg">
                                <img src="{{ asset('public/frontend/images/icon.png') }}" alt=""
                                    class="w-100">
                            </div>
                            <div class="text-center bg_light text_box feature_card">
                                <h2>
                                    <b>Best Guide</b>
                                </h2>
                                <p class="mb-0">
                                    Suspendisse ultrices nibh non cursus sagittis. Morbi dictum consequat ex, quis
                                    finibus magna.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- ================ -->

                    <div class="col-3 mb-4 mt-4" data-aos="fade-up">
                        <div class="align-items-center icon_box">
                            <div class="icon_div yellow_bg">
                                <img src="{{ asset('public/frontend/images/icon.png') }}" alt=""
                                    class="w-100">
                            </div>
                            <div class="text-center bg_light text_box feature_card">
                                <h2>
                                    <b>Best Guide</b>
                                </h2>
                                <p class="mb-0">
                                    Suspendisse ultrices nibh non cursus sagittis. Morbi dictum consequat ex, quis
                                    finibus magna.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- ================ -->

                    <div class="col-3 mb-4" data-aos="fade-down">
                        <div class="align-items-center icon_box">
                            <div class="icon_div yellow_bg">
                                <img src="{{ asset('public/frontend/images/icon.png') }}" alt=""
                                    class="w-100">
                            </div>
                            <div class="text-center bg_light text_box feature_card">
                                <h2>
                                    <b>Best Guide</b>
                                </h2>
                                <p class="mb-0">
                                    Suspendisse ultrices nibh non cursus sagittis. Morbi dictum consequat ex, quis
                                    finibus magna.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- ================ -->

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Features end -->

<div class="clearfix"></div>

<!-- faq start -->

<div class="container-fluid py-5"
    style="background-image: url({{ asset('public/frontend/images/faq_bg.png') }}); background-position: center; background-size: cover; background-repeat: no-repeat;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h1 class="text-center mb-4" data-aos="fade-up">FAQ's</h1>

                <div class="accordion" id="accordionExample">
                    <div class="accordion-item faq_acc">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <p>Accordion Item #1</p>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi numquam, beatae unde
                                    harum asperiores vel mollitia, incidunt facilis dolorum quae itaque sequi? Sapiente,
                                    natus molestias!</p>
                            </div>
                        </div>
                    </div>

                    <!-- ================================= -->

                    <div class="accordion-item faq_acc">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <p>Accordion Item #2</p>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi numquam, beatae unde
                                    harum asperiores vel mollitia, incidunt facilis dolorum quae itaque sequi? Sapiente,
                                    natus molestias!</p>
                            </div>
                        </div>
                    </div>

                    <!-- ================================= -->

                    <div class="accordion-item faq_acc">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <p>Accordion Item #3</p>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi numquam, beatae unde
                                    harum asperiores vel mollitia, incidunt facilis dolorum quae itaque sequi? Sapiente,
                                    natus molestias!</p>
                            </div>
                        </div>
                    </div>

                    <!-- ================================= -->

                    <div class="accordion-item faq_acc">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <p>Accordion Item #3</p>
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi numquam, beatae unde
                                    harum asperiores vel mollitia, incidunt facilis dolorum quae itaque sequi? Sapiente,
                                    natus molestias!</p>
                            </div>
                        </div>
                    </div>

                    <!-- ================================= -->

                    <div class="accordion-item faq_acc">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <p>Accordion Item #3</p>
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi numquam, beatae unde
                                    harum asperiores vel mollitia, incidunt facilis dolorum quae itaque sequi? Sapiente,
                                    natus molestias!</p>
                            </div>
                        </div>
                    </div>

                    <!-- ================================= -->

                </div>

            </div>
        </div>
    </div>
</div>

<!-- faq end -->

@include('userpanel.includes.footer')
