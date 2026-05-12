@include('userpanel.includes.header')

<div class="container-fluid full_bg" style="padding-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="bg_light p-4 p-md-5 rounded shadow mb-5">
                    <div class="job-detail-header p-4 mb-4 text-center text-md-start">
                        <h1 class="mb-4" data-aos="fade-up">TukTuk Driver / Guide</h1>
                        <p class="mb-1" data-aos="fade-up" data-aos-delay="100"><i
                                class="fas fa-map-marker-alt me-2 green_text"></i>Colombo, Kandy, Galle</p>
                        <p class="mb-0" data-aos="fade-up" data-aos-delay="150"><i
                                class="fas fa-briefcase me-2 green_text"></i>Full-time / Part-time</p>
                    </div>

                    <div data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text_dark fw-bold mb-3">Job Overview:</h3>
                        <p class="p">Are you a skilled and friendly TukTuk driver with a passion for showcasing the
                            best of Sri Lanka? Rent A Tuk is looking for reliable and customer-focused individuals to
                            join our network. You will be responsible for providing safe, enjoyable, and memorable
                            transportation and guide services for foreign tourists.</p>

                        <h3 class="text_dark fw-bold mt-4 mb-3">Key Responsibilities:</h3>
                        <ul class="custom_list p">
                            <li>Safely operate a TukTuk, adhering to all traffic laws and company safety guidelines.
                            </li>
                            <li>Provide friendly and professional service, offering local insights and assistance.</li>
                            <li>Act as a knowledgeable guide, sharing information about points of interest.</li>
                            <li>Maintain your TukTuk in a clean, safe, and presentable condition.</li>
                            <li>Manage bookings and schedules received through the Rent A Tuk platform.</li>
                        </ul>

                        <h3 class="text_dark fw-bold mt-4 mb-3">Qualifications:</h3>
                        <ul class="custom_list p">
                            <li>Valid Sri Lankan driver's license with TukTuk endorsement.</li>
                            <li>Valid Tourist Guide License (if applicable).</li>
                            <li>Proven experience as a TukTuk driver and/or tour guide.</li>
                            <li>Good knowledge of local routes, attractions, and history.</li>
                            <li>Excellent English communication skills; proficiency in other languages is a major plus.
                            </li>
                            <li>Customer-oriented mindset with a friendly and approachable personality.</li>
                            <li>Own a well-maintained TukTuk that meets our standards.</li>
                            <li>Clean police record.</li>
                        </ul>
                    </div>
                </div>



                <!-- Application Form Section -->
                <section class="bg_light p-4 p-md-5 rounded shadow mb-4" id="applyForm" data-aos="fade-up">
                    <h1 class="text-center mb-5">Apply for this Position</h1>
                    <form method="POST" id="driver_form" action="{{ route('save-driver') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-5">
                            <h5 class="text_dark fw-bold mb-3">Personal Information</h5>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control shadow-none" id="appFirstName"
                                        name="appFirstName" placeholder="First Name" required>
                                    <label for="appFirstName">First Name*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control shadow-none" id="appLastName"
                                        name="appLastName" placeholder="Last Name" required>
                                    <label for="appLastName">Last Name*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control shadow-none" id="appEmail"
                                        name="appEmail" placeholder="Email Address" required>
                                    <label for="appEmail">Email Address*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control shadow-none" id="appMobile"
                                        name="appMobile" placeholder="Mobile Number" required>
                                    <label for="appMobile">Mobile Number*</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control shadow-none" id="appAddress"
                                        name="appAddress" placeholder="Current Address" required>
                                    <label for="appAddress">Current Address*</label>
                                </div>
                            </div>
                        </div>

                        <!-- ================================= -->

                        <div class="row mb-5">
                            <h5 class="text_dark fw-bold mb-3">Professional Details</h5>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control shadow-none" id="appLicenseNo"
                                        name="appLicenseNo" placeholder="Driver's License No." required>
                                    <label for="appLicenseNo">Driver's License No.*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control shadow-none" id="appExperience"
                                        name="appExperience" placeholder="Years of Experience (Driving/Guiding)"
                                        min="0" required>
                                    <label for="appExperience">Years of Experience*</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control shadow-none" id="appTukTukRegNo"
                                        name="appTukTukRegNo" placeholder="TukTuk Registration No.">
                                    <label for="appTukTukRegNo">TukTuk Registration No. (if owner)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <select class="form-control shadow-none" id="appLanguages" name="appLanguages[]"
                                        multiple="multiple" required
                                        data-parsley-errors-container="#appLanguagesError">

                                        <!-- Add options here, e.g. -->
                                        <option value="English">English</option>
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
                                        <!-- Add more options as needed -->
                                    </select>
                                    {{-- <label for="appLanguages">Languages Spoken*</label> --}}
                                </div>
                                <div id="appLanguagesError"></div>
                            </div>
                        </div>

                        <!-- ================================= -->

                        <div class="row">
                            <h5 class="text_dark fw-bold mb-3">Document Upload</h5>

                            <div class="col-md-6 mb-3">
                                <label for="uploadLicense" class="form-label-file">Upload copy of Driver's
                                    License*</label>
                                <input class="form-control form-control-file shadow-none" type="file"
                                    id="uploadLicense" name="uploadLicense" accept="image/*" required>
                                <p class="form-text text-muted" style="font-size: 11px;">Max file size: 2MB. Accepted
                                    formats: JPG, PNG.</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="uploadPoliceReport" class="form-label-file">Upload Police Clearance
                                    Report*</label>
                                <input class="form-control form-control-file shadow-none" type="file"
                                    id="uploadPoliceReport" name="uploadPoliceReport" accept="image/*" required>
                                <p class="form-text text-muted" style="font-size: 11px;">Must be issued within the
                                    last 6 months.</p>
                            </div>
                        </div>

                        <div class="form-check mb-4 mt-2">
                            <input class="form-check-input shadow-none" type="checkbox" value=""
                                id="agreeApplicationTerms" required>
                            <label class="form-check-label" for="agreeApplicationTerms">
                                I confirm that the information provided is true and accurate.*
                            </label>
                        </div>

                        <div class="text-center">
                            <button type="submit" id="driver_submit" class="fill_btn btn login_btn py-2">
                                <i class="fas fa-paper-plane me-2"></i>SUBMIT APPLICATION
                            </button>
                        </div>

                    </form>
                </section>

            </div>
        </div>
    </div>
</div>
@include('userpanel.includes.footer')
