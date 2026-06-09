@include('userpanel.includes.header')

<div class="container-fluid full_bg">
    <div class="container">
        <form method="POST" action="{{ route('booking-details') }}" id="rent_step_1_form">
            @csrf
            <div class="row justify-content-center">
                <div class="col-9 white_bg rounded p-4 mb-4 mt-5 shadow">

                    <p class="text-dark fw-bold mb-1" data-aos="fade-up">Reservation Details</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-floating d-flex mb-3">
                                <input type="text" class="datepicker_input form-control shadow-none datepicker-input"
                                    id="check_in" required placeholder="DD/MM/YYYY" autocomplete="off" name="check_in"
                                    value="{{ $data['check_in'] }}">
                                <label for="check_in">Pick-Up Date</label>
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <input type="time" class="form-control shadow-none" id="floatingInput"
                                    placeholder="name@example.com" required name="pickup_time">
                                <label for="floatingInput">Pick-Up Time</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <select class="form-select shadow-none" name="picakup_location" id="picakup_location"
                                    aria-label="Floating label select example" fdprocessedid="i20ioc" required>
                                    <option value="">Pickup Location</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            @if ($city->id == $data['picakup_location']) selected @endif>{{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="picakup_location">City</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating d-flex mb-3">
                                <input type="text" class="datepicker_input form-control shadow-none datepicker-input"
                                    id="check_out" required placeholder="DD/MM/YYYY" autocomplete="off" name="check_out"
                                    value="{{ $data['check_out'] }}">
                                <label for="check_out">Return Date</label>
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <input type="time" class="form-control shadow-none" id="floatingInput"
                                    placeholder="name@example.com" required name="return_time">
                                <label for="floatingInput">Return Time</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <select class="form-select shadow-none" name="return_location" id="return_location"
                                    aria-label="Floating label select example" fdprocessedid="i20ioc" required>
                                    <option value="">Return Location</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            @if ($city->id == $data['return_location']) selected @endif>{{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="return_location">City</label>
                            </div>
                        </div>
                    </div>
                    <p class="fw-bold">Trip Duration : <span class="green_text" id="trip_duration">3 Days</span></p>
                    <input type="hidden" name="trip_duration" id="trip_duration_input" value="3">
                    <input type="hidden" name="vehicle_fee_input" id="vehicle_fee_input" value="">
                    <input type="hidden" name="vehicle_totle_input" id="vehicle_totle_input" value="">

                </div>

                <!-- =================== -->

                <div class="col-9 white_bg rounded p-4 mb-4 shadow">

                    <p class="text-dark fw-bold mb-1" data-aos="fade-up">Vehicle Details</p>

                    <div class="row">
                        @foreach ($vehicles as $key => $vehicle)
                            <label for="radio-card-{{ $key + 1 }}" class="radio-card col-4">
                                <input type="radio" name="vehicle" id="radio-card-{{ $key + 1 }}"
                                    @if ($key == 0) checked @endif value="{{ $vehicle->id }}" />
                                <div class="tuk_card position-relative">
                                    <div class="tuk_img d-flex flex-column align-items-center mb-3">
                                        <img src="{{ asset('storage/app/private/' . $vehicle->thumbnail) }}" alt=""
                                            class="w-100">
                                        <p class="fw-bold">{{ $vehicle->vehicleType->name }}</p>
                                        <div class="price_tag">
                                            <p>Per day ${{ $vehicle->vehicleType->rate_per_day }}</p>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mb-1">
                                        <p>Fee</p>
                                        <p></p>
                                    </div>

                                    <div class="d-flex justify-content-between mb-1">
                                        <p>Deposit</p>
                                        <p>${{ $vehicle->vehicleType->deposit_price }}</p>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between mb-1">
                                        <p class="fw-bold">Total</p>
                                        <p class="fw-bold"></p>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-center">
                                        <div class="line_btn btn ms-1">
                                            CHOOSE
                                        </div>
                                    </div>

                                </div>
                            </label>
                        @endforeach


                    </div>

                </div>

                <!-- =================== -->

                <div class="col-9 white_bg rounded p-4 mb-4 shadow">

                    <p class="text-dark fw-bold mb-1" data-aos="fade-up">Driver / Instructor Preference</p>

                    <table class="table text-center mt-3">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Service</th>
                                <th scope="col">First Language</th>
                                <th scope="col">Secondary language</th>
                                <th scope="col">Requesting</th>
                                <th scope="col">Fee</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            <tr>
                                <th scope="row">Driver</th>
                                <td>
                                    <select class="form-select form-select-sm shadow-none"
                                        aria-label=".form-select-sm example" name="driver_first_lang"
                                        id="driver_first_lang">
                                        <option value="English" selected>English</option>
                                        <option value="German">German</option>
                                        <option value="French">French</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Arabic">Arabic</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Dutch">Dutch</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="Italian">Italian</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm shadow-none"
                                        aria-label=".form-select-sm example" name="driver_second_lang"
                                        id="driver_second_lang">
                                        <option value="German" selected>German</option>
                                        <option value="English">English</option>
                                        <option value="French">French</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Arabic">Arabic</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Dutch">Dutch</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="Italian">Italian</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input shadow-none" type="checkbox" value="yes"
                                            id="flexCheckDefault" name="driver_requesting">
                                    </div>
                                </td>
                                <td>
                                    
                                       ${{ $fees->where('id', 1)->first()?->price ?? 0 }}
                                   
                                    <input type="hidden" name="driver_fee" id="driver_fee" value="{{ $fees->where('id', 1)->first()?->price ?? 0 }}">
                                </td>
                            </tr>

                            <!-- ============= -->

                            <tr>
                                <th scope="row">Driving Instructor </th>
                                <td>
                                    <select class="form-select form-select-sm shadow-none"
                                        aria-label=".form-select-sm example" name="instructor_first_lang"
                                        id="instructor_first_lang">
                                        <option value="English" selected>English</option>
                                        <option value="German">German</option>
                                        <option value="French">French</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Arabic">Arabic</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Dutch">Dutch</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="Italian">Italian</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm shadow-none"
                                        aria-label=".form-select-sm example" name="instructor_second_lang"
                                        id="instructor_second_lang">
                                        <option value="German" selected>German</option>
                                        <option value="English">English</option>
                                        <option value="French">French</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Arabic">Arabic</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Dutch">Dutch</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="Italian">Italian</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input shadow-none" type="checkbox" value="yes"
                                            id="flexCheckDefault" name="instructor_requesting">
                                    </div>
                                </td>
                                <td>
                                    ${{ $fees->where('id', 2)->first()?->price ?? 0 }}
                                    <input type="hidden" name="instructor_fee" id="instructor_fee" value="{{ $fees->where('id', 2)->first()?->price ?? 0 }}">
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Tour Guide</th>
                                <td>
                                    <select class="form-select form-select-sm shadow-none"
                                        aria-label=".form-select-sm example" name="guide_first_lang"
                                        id="guide_first_lang">
                                        <option value="English" selected>English</option>
                                        <option value="German">German</option>
                                        <option value="French">French</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Arabic">Arabic</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Dutch">Dutch</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="Italian">Italian</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm shadow-none"
                                        aria-label=".form-select-sm example" name="guide_second_lang"
                                        id="guide_second_lang">
                                        <option value="German" selected>German</option>
                                        <option value="English">English</option>
                                        <option value="French">French</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Arabic">Arabic</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Dutch">Dutch</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="Italian">Italian</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input shadow-none" type="checkbox" value="yes"
                                            id="flexCheckDefault" name="guide_requesting">
                                    </div>
                                </td>
                                <td>
                                    ${{ $fees->where('id', 3)->first()?->price ?? 0 }}
                                    <input type="hidden" name="guide_fee" id="guide_fee" value="{{ $fees->where('id', 3)->first()?->price ?? 0 }}">
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

                <!-- =================== -->

                <div class="col-9 white_bg rounded p-4 mb-4 shadow">

                    <p class="text-dark fw-bold mb-1" data-aos="fade-up">Extras</p>

                    <table class="table mt-3">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" width="70%">Service</th>
                                <th scope="col">Requesting</th>
                                <th scope="col" class="text-center">Qty</th>
                                <th scope="col">Fee</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th scope="row">We can assist with obtaining your temporary Sri Lankan driving
                                    permit.
                                    (Requires your international
                                    driving permit and typically 1 business day).</th>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input shadow-none" type="checkbox" value="yes"
                                            id="flexCheckLicense" name="local_license">
                                    </div>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm shadow-none ms-0"
                                        aria-label="Quantity for local license" name="local_license_qty">
                                        <option selected value="1">1</option>
                                    </select>
                                </td>
                                <td>
                                    ${{ $fees->where('id', 4)->first()?->price ?? 0 }}
                                    <input type="hidden" name="local_license_fee" id="local_license_fee"
                                        value="{{ $fees->where('id', 4)->first()?->price ?? 0 }}">
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Driving Instructor (Additional Session)</th>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input shadow-none" type="checkbox" value="yes"
                                            id="flexCheckInstructor" name="instructor_additional_session">
                                    </div>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm shadow-none ms-0"
                                        aria-label="Number of driving instructor sessions"
                                        name="instructor_additional_session_qty">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>
                                <td>
                                    ${{ $fees->where('id', 5)->first()?->price ?? 0 }}
                                    <input type="hidden" name="instructor_additional_session_fee"
                                        id="instructor_additional_session_fee" value="{{ $fees->where('id', 5)->first()?->price ?? 0 }}">
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Baby seat ($1.50/day)</th>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input shadow-none" type="checkbox" value="yes"
                                            id="flexCheckBabySeat" name="baby_seat">
                                    </div>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm shadow-none ms-0"
                                        aria-label="Number of baby seats" name="baby_seat_qty">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>
                                <td>
                                    ${{ $fees->where('id', 6)->first()?->price ?? 0 }}
                                    <input type="hidden" name="baby_seat_fee" id="baby_seat_fee" value="{{ $fees->where('id', 6)->first()?->price ?? 0 }}">
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Big Bluetooth Speakers ($1/day)</th>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input shadow-none" type="checkbox" value="yes"
                                            id="flexCheckSpeakers" name="bluetooth_speakers">
                                    </div>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm shadow-none ms-0"
                                        aria-label="Number of Bluetooth speakers" name="bluetooth_speakers_qty">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>
                                <td>
                                    ${{ $fees->where('id', 7)->first()?->price ?? 0 }}
                                    <input type="hidden" name="bluetooth_speakers_fee" id="bluetooth_speakers_fee"
                                        value="{{ $fees->where('id', 7)->first()?->price ?? 0 }}">
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Request a tuk-tuk with factory-fitted seatbelts (if available,
                                    $1/day
                                    extra)</th>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input shadow-none" type="checkbox" value="yes"
                                            id="flexCheckSeatbelts" name="tuktuk_with_seatbelts">
                                    </div>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm shadow-none ms-0"
                                        aria-label="Tuktuk with seatbelts" name="tuktuk_with_seatbelts_qty">
                                        <option selected value="1">1</option>
                                    </select>
                                </td>
                                <td>
                                    ${{ $fees->where('id', 8)->first()?->price ?? 0 }}
                                    <input type="hidden" name="tuktuk_with_seatbelts_fee"
                                        id="tuktuk_with_seatbelts_fee" value="{{ $fees->where('id', 8)->first()?->price ?? 0 }}">
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Cooler / Esky ($0.80/day)</th>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input shadow-none" type="checkbox" value="yes"
                                            id="flexCheckCooler" name="cooler">
                                    </div>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm shadow-none ms-0"
                                        aria-label="Number of coolers" name="cooler_qty">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>
                                <td>

                                    ${{ $fees->where('id', 9)->first()?->price ?? 0 }}
                                    <input type="hidden" name="cooler_fee" id="cooler_fee" value="{{ $fees->where('id', 9)->first()?->price ?? 0 }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>


                <div class="col-9 d-flex justify-content-end p-0 mb-4">
                    <div>
                        <button class="fill_btn btn" type="submit" id="next_btn" data-aos="fade-up">
                            NEXT
                            <i class="fas fa-arrow-right ps-2"></i>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@include('userpanel.includes.footer')
