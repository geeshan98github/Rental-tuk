@include('userpanel.includes.header')

<div class="container-fluid full_bg" style="padding-top: 80px;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3">
                <aside class="bg_light p-4 rounded shadow mb-4">
                    <div class="d-flex align-items-center mb-4">
                        <img src="@if (Auth::guard('frontend')->user()->profile_image) {{ asset('storage/app/private/' . Auth::guard('frontend')->user()->profile_image) }} @else {{ asset('public/frontend/images/profile.jpg') }} @endif"
                            alt="Sajani" width="50" height="50" class="rounded-circle me-3">
                        <div>
                            <h5 class="fw-bold mb-0" style="font-size: 15px;">HELLO,
                                {{ Auth::guard('frontend')->user()->first_name }}!</h5>
                        </div>
                    </div>
                    <nav class="nav flex-column sidebar-nav">
                        <a class="nav-link ps-0 fw-bold main_link" href="#"><i
                                class="fas fa-user me-2 green_text"></i>My Account</a>
                        <a class="nav-link ps-3" href="{{ route('my-profile') }}"><i
                                class="fas fa-angle-right me-2 fa-xs text-muted"></i>My Profile</a>
                        <a class="nav-link ps-3" href="#"><i
                                class="fas fa-angle-right me-2 fa-xs text-muted"></i>My Payment Options</a>

                        <a class="nav-link fw-bold main_link mt-2 ps-0" href="#"><i
                                class="fas fa-route me-2 green_text"></i>My Trips</a>
                        <a class="nav-link ps-3" href="#"><i
                                class="fas fa-angle-right me-2 fa-xs text-muted"></i>Ongoing Trips</a>
                        <a class="nav-link ps-3" href="#"><i
                                class="fas fa-angle-right me-2 fa-xs text-muted"></i>Cancellations</a>
                        <a class="nav-link ps-3" href="#"><i
                                class="fas fa-angle-right me-2 fa-xs text-muted"></i>Completed Trips</a>

                        <a class="nav-link fw-bold main_link mt-2 ps-0" href="#"><i
                                class="fas fa-star me-2 green_text"></i>My Reviews</a>
                        <a class="nav-link fw-bold main_link mt-2 ps-0" href="#"><i
                                class="fas fa-map-marker-alt me-2 green_text"></i>My Map</a>

                        <a class="nav-link fw-bold main_link mt-2 ps-0" href="#"><i
                                class="fas fa-plus-circle me-2 green_text"></i>Join With Tuk Tuk</a>
                    </nav>
                </aside>
            </div>


            @yield('content')
        </div>
    </div>
</div>



@include('userpanel.includes.footer')
