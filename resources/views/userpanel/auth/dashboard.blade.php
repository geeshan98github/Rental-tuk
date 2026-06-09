

@extends('userpanel.auth.dashboard_layout')

@section('content')
    <div class="col-lg-9">
        <h1 class="mb-4">My Account</h1>

        <div class="row">
            <div class="col-6">
                <div class="bg_light p-4 rounded shadow mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">My Profile</h5>
                        {{-- <a href="#" class="red_link fw-bold text-uppercase">EDIT</a> --}}
                    </div>
                    <div class="d-flex align-items-center">
                        <img src="@if (Auth::guard('frontend')->user()->profile_image) {{ asset('storage/app/private/' . Auth::guard('frontend')->user()->profile_image) }} @else {{ asset('public/frontend/images/profile.jpg') }} @endif" alt="Sajani Wathsala"
                            class="rounded-circle me-4" width="80" height="80">
                        <div>
                            <p class="mb-1"><strong>Name : </strong>{{ Auth::guard('frontend')->user()->first_name }}
                                {{ Auth::guard('frontend')->user()->last_name }}</p>
                            <p class="mb-1"><strong>Email :</strong> {{ Auth::guard('frontend')->user()->email }}</p>
                            <p class="mb-0"><strong>Mobile :</strong> {{ Auth::guard('frontend')->user()->phone_number }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="bg_light p-4 rounded shadow mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">My Payment Options</h5>
                        {{-- <a href="#" class="red_link fw-bold text-uppercase">EDIT</a> --}}
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-12 mb-2">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/100px-PayPal.svg.png"
                                alt="PayPal" height="25" class="me-2 mb-2">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Mastercard_2019_logo.svg/80px-Mastercard_2019_logo.svg.png"
                                alt="MasterCard" height="25" class="me-2 mb-2">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/80px-Visa_Inc._logo.svg.png"
                                alt="Visa" height="25" class="mb-2">
                        </div>
                        <div class="col-md-12">
                            <p class="mb-0"><strong>Email :</strong> Sa**********Com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="bg_light p-4 rounded shadow">
                    <h5 class="fw-bold mb-3">My Trips</h5>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Trip ID</th>
                                    <th scope="col">Pick-Up Date / Location</th>
                                    <th scope="col">Return Date / Location</th>
                                    <th scope="col">Vehicle Details</th>
                                    {{-- <th scope="col" class="text-center">Edit</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($bookings) > 0)
                                @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->trip_id }}</td>
                                    <td>{{ $booking->check_in }} <br> {{$cities->where('id', $booking->pickup_location)->first()?->name ?? ''}}</td>
                                    <td>{{ $booking->check_out }}<br> {{ $cities->where('id', $booking->return_location)->first()?->name ?? '' }}</td>
                                    <td>{{ $booking->vehicle_number }} <br> {{ $booking->vehicle_type_name }}</td>
                                    {{-- <td class="text-center align-middle"><a href="#"
                                            class="red_link fw-bold text-uppercase w-100">EDIT</a></td> --}}
                                </tr>
                                
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">No Trips Found</td>
                                </tr>
                                @endif
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
