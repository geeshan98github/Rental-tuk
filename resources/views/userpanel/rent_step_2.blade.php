@include('userpanel.includes.header')

<div class="container-fluid full_bg">
    <div class="container">
        <form id="bookingDetailsForm" action="{{ route('payment') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row justify-content-center">
                <!-- Reservation Details Section -->
                <div class="col-lg-10 col-xl-9 white_bg rounded p-4 mb-4 mt-5 shadow">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="text-dark fw-bold main_heading mb-0" data-aos="fade-up">Reservation Summary</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4 col-6">
                            <p class="summary-label mb-0">Pick-Up Date & Time</p>
                            <p class="summary-value"><i class="fa-solid fa-calendar-alt"></i>{{ $data['check_in'] }},
                                {{ $data['pickup_time'] }}</p>
                        </div>
                        <div class="col-md-4 col-6">
                            <p class="summary-label mb-0">Pick-Up Location</p>
                            <p class="summary-value"><i
                                    class="fa-solid fa-map-marker-alt"></i>{{ $pickupLocation->name ?? '' }}</p>
                        </div>
                        <div class="col-md-4 col-12">
                            <p class="summary-label mb-0">Trip Duration</p>
                            <p class="summary-value"><i class="fa-solid fa-clock"></i><span
                                    class="green_text">{{ $data['trip_duration'] }} Days</span></p>
                        </div>

                        <div class="col-md-4 col-6">
                            <p class="summary-label mb-0">Return Date & Time</p>
                            <p class="summary-value"><i class="fa-solid fa-calendar-check"></i>{{ $data['check_out'] }},
                                {{ $data['return_time'] }}</p>
                        </div>
                        <div class="col-md-4 col-6">
                            <p class="summary-label mb-0">Return Location</p>
                            <p class="summary-value"><i
                                    class="fa-solid fa-map-marker-alt"></i>{{ $returnLocation->name ?? '' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Details Section -->
                <div class="col-lg-10 col-xl-9 white_bg rounded p-4 mb-4 ">
                    <p class="text-dark fw-bold mb-1 aos-init aos-animate" data-aos="fade-up">Selected Vehicle</p>
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="tuk_card position-relative h-100">
                                <div class="tuk_img d-flex flex-column align-items-center mb-3">
                                    <img src="{{ asset('storage/app/private/' . $vehicle->thumbnail) }}" alt="Regular Tuk Tuk"
                                        class="w-100" style="max-height: 150px; object-fit: contain;">
                                    <p class="fw-bold mt-2">{{ $vehicle->vehicleType->name }}</p>
                                    <div class="price_tag">
                                        <p class="mb-0">Per day<br>${{ $vehicle->vehicleType->rate_per_day }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <p>Fee</p>
                                    <p>${{ $data['vehicle_fee_input'] }}</p>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <p>Deposit</p>
                                    <p>${{ $vehicle->vehicleType->deposit_price }}</p>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between mb-1">
                                    <p class="fw-bold">Total</p>
                                    <p class="fw-bold">${{ $data['vehicle_totle_input'] }}</p>
                                </div>
                                <hr class="my-2">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Driver / Instructor / Guide Preference Section -->
                @if (
                    $data['driver_requesting'] == 'yes' ||
                        $data['instructor_requesting'] == 'yes' ||
                        $data['guide_requesting'] == 'yes')
                    <div class="col-lg-10 col-xl-9 white_bg rounded p-4 mb-4 shadow">
                        <p class="text-dark fw-bold mb-1 aos-init aos-animate" data-aos="fade-up">Service Preferences
                        </p>
                        <div class="table-responsive">
                            <table class="table text-center mt-3">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-start">Service</th>
                                        <th scope="col">First Language</th>
                                        <th scope="col">Secondary language</th>
                                        <th scope="col">Fee</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @if ($data['driver_requesting'] == 'yes')
                                        <tr>
                                            <th scope="row" class="text-start">Driver</th>
                                            <td>
                                                <p class="p mb-0">{{ $data['driver_first_lang'] }}</p>
                                            </td>
                                            <td>
                                                <p class="p mb-0">{{ $data['driver_second_lang'] }}</p>
                                            </td>
                                            <td>
                                                <p class="p mb-0">${{ $data['driver_fee'] }}</p>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($data['instructor_requesting'] == 'yes')
                                        <tr>
                                            <th scope="row" class="text-start">Driving Instructor</th>
                                            <td>
                                                <p class="p mb-0">{{ $data['instructor_first_lang'] }}</p>
                                            </td>
                                            <td>
                                                <p class="p mb-0">{{ $data['instructor_second_lang'] }}</p>
                                            </td>
                                            <td>
                                                <p class="p mb-0">${{ $data['instructor_fee'] }}</p>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($data['guide_requesting'] == 'yes')
                                        <tr>
                                            <th scope="row" class="text-start">Tour Guide</th>
                                            <td>
                                                <p class="p mb-0">{{ $data['guide_first_lang'] }}</p>
                                            </td>
                                            <td>
                                                <p class="p mb-0">{{ $data['guide_second_lang'] }}</p>
                                            </td>
                                            <td>
                                                <p class="p mb-0">${{ $data['guide_fee'] }}</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- Extras Section -->
                @if (
                    $data['local_license'] == 'yes' ||
                        $data['instructor_additional_session'] == 'yes' ||
                        $data['baby_seat'] == 'yes' ||
                        $data['bluetooth_speakers'] == 'yes' ||
                        $data['tuktuk_with_seatbelts'] == 'yes' ||
                        $data['cooler'] == 'yes')
                    <div class="col-lg-10 col-xl-9 white_bg rounded p-4 mb-4 shadow">
                        <p class="text-dark fw-bold mb-1 aos-init aos-animate" data-aos="fade-up">Selected Extras</p>
                        <div class="table-responsive">
                            <table class="table mt-3">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 70%;">Service</th>
                                        <th scope="col" class="text-center" style="width: 20%;">Qty</th>
                                        <th scope="col">Fee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data['local_license'] == 'yes')
                                        <tr>
                                            <th scope="row" class="text-start">Temporary Sri Lankan driving permit
                                            </th>
                                            <td>
                                                <p class="p mb-0 text-center">1</p>
                                            </td>
                                            <td>

                                                <p class="p mb-0">${{ $data['local_license_fee'] }}</p>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($data['instructor_additional_session'] == 'yes')
                                        <tr>
                                            <th scope="row" class="text-start">Additional session</th>
                                            <td>
                                                <p class="p mb-0 text-center">
                                                    {{ $data['instructor_additional_session_qty'] }}</p>
                                            </td>
                                            <td>
                                                <p class="p mb-0">
                                                    ${{ $data['instructor_additional_session_fee'] * $data['instructor_additional_session_qty'] }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($data['baby_seat'] == 'yes')
                                        <tr>
                                            <th scope="row" class="text-start">Baby seat</th>
                                            <td>
                                                <p class="p mb-0 text-center">{{ $data['baby_seat_qty'] }}</p>
                                            </td>
                                            <td>
                                                <p class="p mb-0">
                                                    ${{ $data['baby_seat_fee'] * $data['baby_seat_qty'] }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($data['bluetooth_speakers'] == 'yes')
                                        <tr>
                                            <th scope="row" class="text-start">Big Bluetooth Speakers</th>
                                            <td>
                                                <p class="p mb-0 text-center">{{ $data['bluetooth_speakers_qty'] }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="p mb-0">
                                                    ${{ $data['bluetooth_speakers_fee'] * $data['bluetooth_speakers_qty'] }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($data['tuktuk_with_seatbelts'] == 'yes')
                                        <tr>
                                            <th scope="row" class="text-start">tuk-tuk with factory-fitted
                                                seatbelts</th>
                                            <td>
                                                <p class="p mb-0 text-center">1</p>
                                            </td>
                                            <td>
                                                <p class="p mb-0">${{ $data['tuktuk_with_seatbelts_fee'] }}</p>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($data['cooler'] == 'yes')
                                        <tr>
                                            <th scope="row" class="text-start">Cooler / Esky</th>
                                            <td>
                                                <p class="p mb-0 text-center">{{ $data['cooler_qty'] }}</p>
                                            </td>
                                            <td>
                                                <p class="p mb-0">${{ $data['cooler_fee'] * $data['cooler_qty'] }}</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                @php
                    $data['local_license_fee'] =
                        $data['local_license'] == 'yes' ? $data['local_license_fee'] * $data['trip_duration'] : 0;
                    $data['instructor_additional_session_fee'] =
                        $data['instructor_additional_session'] == 'yes'
                            ? $data['instructor_additional_session_fee'] *
                                $data['instructor_additional_session_qty'] *
                                $data['trip_duration']
                            : 0;
                    $data['baby_seat_fee'] =
                        $data['baby_seat'] == 'yes'
                            ? $data['baby_seat_fee'] * $data['baby_seat_qty'] * $data['trip_duration']
                            : 0;
                    $data['bluetooth_speakers_fee'] =
                        $data['bluetooth_speakers'] == 'yes'
                            ? $data['bluetooth_speakers_fee'] * $data['bluetooth_speakers_qty'] * $data['trip_duration']
                            : 0;
                    $data['tuktuk_with_seatbelts_fee'] =
                        $data['tuktuk_with_seatbelts'] == 'yes'
                            ? $data['tuktuk_with_seatbelts_fee'] * $data['trip_duration']
                            : 0;
                    $data['cooler_fee'] =
                        $data['cooler'] == 'yes'
                            ? $data['cooler_fee'] * $data['cooler_qty'] * $data['trip_duration']
                            : 0;

                    $extraTotal =
                        $data['local_license_fee'] +
                        $data['instructor_additional_session_fee'] +
                        $data['baby_seat_fee'] +
                        $data['bluetooth_speakers_fee'] +
                        $data['tuktuk_with_seatbelts_fee'] +
                        $data['cooler_fee'];

                    $data['driver_fee'] =
                        $data['driver_requesting'] == 'yes' ? $data['driver_fee'] * $data['trip_duration'] : 0;
                    $data['instructor_fee'] =
                        $data['instructor_requesting'] == 'yes' ? $data['instructor_fee'] * $data['trip_duration'] : 0;
                    $data['guide_fee'] =
                        $data['guide_requesting'] == 'yes' ? $data['guide_fee'] * $data['trip_duration'] : 0;

                    $serviceTotle = $data['driver_fee'] + $data['instructor_fee'] + $data['guide_fee'];

                @endphp
                <!-- Financial Summary Section -->
                <div class="col-lg-10 col-xl-9 white_bg rounded p-4 mb-4 shadow">
                    <p class="text-dark fw-bold mb-3 main_heading" data-aos="fade-up">Cost Summary</p>
                    <div class="table-responsive">
                        <table class="table summary-table">
                            <tbody>
                                <tr>
                                    <td class="p">Vehicle Rental ({{ $vehicle->vehicleType->name }} x
                                        {{ $data['trip_duration'] }} days)</td>
                                    <td class="p text-end">${{ $data['vehicle_totle_input'] }}</td>
                                </tr>
                                @if ($data['driver_requesting'] == 'yes')
                                    <tr>
                                        <td class="p">Driver Service ({{ $data['trip_duration'] }} days)</td>
                                        <td class="p text-end">${{ $data['driver_fee'] }}
                                        </td>

                                    </tr>
                                @endif
                                @if ($data['instructor_requesting'] == 'yes')
                                    <tr>
                                        <td class="p">Driving Instructor ({{ $data['trip_duration'] }} days)</td>
                                        <td class="p text-end">${{ $data['instructor_fee'] }}
                                        </td>

                                    </tr>
                                @endif
                                @if ($data['guide_requesting'] == 'yes')
                                    <tr>
                                        <td class="p">Tour Guide Service ({{ $data['trip_duration'] }} days)</td>
                                        <td class="p text-end">${{ $data['guide_fee'] }}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td class="p">Extras Total ({{ $data['trip_duration'] }} days)</td>
                                    <td class="p text-end">
                                        ${{ $extraTotal }}
                                        <input type="hidden" name="extras_total" id="extras_total" value="{{ $extraTotal }}">
                                    </td>
                                </tr>
                                @php
                                    $subTotle = $data['vehicle_totle_input'] + $extraTotal + $serviceTotle;
                                @endphp
                                <tr class="border-top">
                                    <td class="p fw-bold">Subtotal</td>
                                    <td class="p fw-bold text-end">
                                        ${{ $subTotle }}
                                        <input type="hidden" name="sub_total" id="sub_total" value="{{ $subTotle }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p">Refundable Deposit</td>
                                    <td class="p text-end">${{ $vehicle->vehicleType->deposit_price }}</td>
                                </tr>
                                <tr class="grand-total">
                                    <td class="h5 text_dark">GRAND TOTAL</td>
                                    <td class="h5 text_dark text-end">
                                        ${{ $subTotle + $vehicle->vehicleType->deposit_price  }}
                                        <input type="hidden" name="grand_total" id="grand_total" value="{{ $subTotle + $vehicle->vehicleType->deposit_price  }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Personal Details Section -->

                @if (Auth::guard('frontend')->check())
                    <div class="col-lg-10 col-xl-9 white_bg rounded p-4 mb-4 shadow">
                        <h2 class="text-dark fw-bold mb-3 main_heading" data-aos="fade-up">Your Personal Details</h2>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control shadow-none" name="emailAddress"
                                        placeholder="Email Address" required
                                        value="{{ Auth::guard('frontend')->user()->email }}" readonly>
                                    <label for="emailAddress">Email Address*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control shadow-none" id="firstName"
                                        name="firstName" placeholder="First Name" required
                                        value="{{ Auth::guard('frontend')->user()->first_name }}" readonly>
                                    <label for="firstName">First Name*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control shadow-none" id="lastName"
                                        name="lastName" placeholder="Last Name" required
                                        value="{{ Auth::guard('frontend')->user()->last_name }}" readonly>
                                    <label for="lastName">Last Name*</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control shadow-none" id="mobileNumber"
                                        name="mobileNumber" placeholder="Mobile Number" required
                                        value="{{ Auth::guard('frontend')->user()->phone_number }}" readonly>
                                    <label for="mobileNumber">Mobile Number</label>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control shadow-none datepicker_input"
                                        id="birthDay" name="birthDay" placeholder="DD/MM/YYYY" autocomplete="off"
                                        required>
                                    <label for="birthDay">Birth Day*</label>
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select shadow-none" id="country" name="country" required
                                        readonly>
                                        <option value="" readonly selected>Select Country</option>
                                        @foreach ($contries as $country)
                                            <option value="{{ $country->name }}"
                                                @if ($country->name === Auth::guard('frontend')->user()->contry_of_residence) selected @endif>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="country">Country of Residence*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="uploadId" class="form-label-file">Please Upload Your ID (Passport/National
                                    ID)*</label>
                                <input class="form-control form-control-file shadow-none" type="file"
                                    id="uploadId" name="uploadId" accept="image/*" required>
                                <small class="form-text text-muted p">Max file size: 2MB. Accepted formats: JPG, PNG.
                                </small>
                            </div>
                            <div class="col-md-6">
                                <label for="uploadLicense" class="form-label-file">Please Upload Your Driving
                                    License*</label>
                                <input class="form-control form-control-file shadow-none" type="file"
                                    id="uploadLicense" name="uploadLicense" accept="image/*" required>
                                <small class="form-text text-muted p">Max file size: 2MB. Accepted formats: JPG, PNG.
                                </small>
                            </div>
                        </div>

                    </div>
                @else
                    <div class="col-lg-10 col-xl-9 white_bg rounded p-4 mb-4 shadow">
                        <h2 class="text-dark fw-bold mb-3 main_heading" data-aos="fade-up">Your Personal Details</h2>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control shadow-none" id="email-input"
                                        name="emailAddress" placeholder="Email Address" required>
                                    <label for="email-input">Email Address*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control shadow-none" id="firstName"
                                        name="firstName" placeholder="First Name" required>
                                    <label for="firstName">First Name*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control shadow-none" id="lastName"
                                        name="lastName" placeholder="Last Name" required>
                                    <label for="lastName">Last Name*</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control shadow-none" id="mobileNumber"
                                        name="mobileNumber" placeholder="Mobile Number" required>
                                    <label for="mobileNumber">Mobile Number</label>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control shadow-none datepicker_input"
                                        id="birthDay" name="birthDay" placeholder="DD/MM/YYYY" autocomplete="off"
                                        required>
                                    <label for="birthDay">Birth Day*</label>
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select shadow-none" id="country" name="country" required>
                                        <option value="" readonly selected>Select Country</option>
                                        @foreach ($contries as $country)
                                            <option value="{{ $country->name }}">
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="country">Country of Residence*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="uploadId" class="form-label-file">Please Upload Your ID (Passport/National
                                    ID)*</label>
                                <input class="form-control form-control-file shadow-none" type="file"
                                    id="uploadId" name="uploadId" required>
                                <small class="form-text text-muted p">Max file size: 2MB. Accepted formats: JPG, PNG
                                    .</small>
                            </div>
                            <div class="col-md-6">
                                <label for="uploadLicense" class="form-label-file">Please Upload Your Driving
                                    License*</label>
                                <input class="form-control form-control-file shadow-none" type="file"
                                    id="uploadLicense" name="uploadLicense" required>
                                <small class="form-text text-muted p">Max file size: 2MB. Accepted formats: JPG, PNG
                                    .</small>
                            </div>
                        </div>

                    </div>
                @endif
                <div class="col-lg-10 col-xl-9 d-flex justify-content-end p-0 mb-4 gap-3">

                    <div>
                        <a href="javascript:history.back()" class="line_btn btn btn-sm" data-aos="fade-up">
                            <i class="fas fa-edit me-1"></i> Modify Details
                        </a>
                    </div>
                    <div>
                        <button type="submit" class="fill_btn btn" type="submit" id="payment_proceed_btn">
                            PROCEED TO PAYMENT
                            <i class="fas fa-arrow-right ps-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



@include('userpanel.includes.footer')
