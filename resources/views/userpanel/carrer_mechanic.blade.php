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
                        <h1 class="mb-4" data-aos="fade-up">Skilled TukTuk Mechanic</h1>
                        <p class="mb-1" data-aos="fade-up" data-aos-delay="100"><i
                                class="fas fa-map-marker-alt me-2 green_text"></i>Central Province, Sri Lanka</p>
                        <p class="mb-0" data-aos="fade-up" data-aos-delay="150"><i
                                class="fas fa-briefcase me-2 green_text"></i>Full-time</p>
                    </div>

                    <div data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text_dark fw-bold mb-3">Job Overview:</h3>
                        <p class="p">Rent A Tuk is seeking an experienced and reliable TukTuk Mechanic to join our
                            technical team. The ideal candidate will be responsible for the maintenance, repair, and
                            overall mechanical well-being of our fleet of TukTuks, ensuring they are safe and roadworthy
                            for our tourist clients.</p>

                        <h3 class="text_dark fw-bold mt-4 mb-3">Key Responsibilities:</h3>
                        <ul class="custom_list p">
                            <li>Perform routine maintenance and servicing of TukTuks (e.g., oil changes, brake checks,
                                tire inspections).</li>
                            <li>Diagnose and troubleshoot a wide range of mechanical and electrical faults accurately.
                            </li>
                            <li>Carry out repairs on engines, transmissions, braking systems, and other components.</li>
                            <li>Respond to breakdown calls and provide on-site assistance.</li>
                            <li>Maintain detailed records of all services and repairs performed.</li>
                            <li>Manage an inventory of spare parts and tools.</li>
                        </ul>

                        <h3 class="text_dark fw-bold mt-4 mb-3">Qualifications:</h3>
                        <ul class="custom_list p">
                            <li>Proven experience as a TukTuk mechanic or similar three-wheeler mechanic (minimum 2-3
                                years).</li>
                            <li>Relevant vocational training or certification (e.g., NVQ Level 4 in Automotive
                                Mechanics).</li>
                            <li>Strong knowledge of TukTuk engines (2-stroke/4-stroke), electrical systems, and chassis.
                            </li>
                            <li>Ability to work independently and manage time effectively.</li>
                            <li>Possession of a valid driver's license is a plus.</li>
                            <li>Clean police record.</li>
                        </ul>
                    </div>
                </div>

                <!-- Application Form Section -->
                <section class="bg_light p-4 p-md-5 rounded shadow mb-4" id="applyForm" data-aos="fade-up">
                    <h1 class="text-center mb-5">Apply for this Position</h1>
                    <form id="mechanicForm" action="{{ route('save-mechanic') }}" method="POST"
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
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control shadow-none" id="appAddress"
                                        name="appAddress" placeholder="Current Address" required>
                                    <label for="appAddress">Current Address*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select shadow-none" id="city" name="city" required>
                                        <option selected disabled value="">Nearest City*</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="city">Nearest City*</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <h5 class="text_dark fw-bold mb-3">Professional Details</h5>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control shadow-none" id="appExperience"
                                        name="appExperience" placeholder="Years of Mechanic Experience" min="0"
                                        required>
                                    <label for="appExperience">Years of Mechanic Experience*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control shadow-none" id="appCertification"
                                        name="appCertification" placeholder="e.g., NVQ Level 4">
                                    <label for="appCertification">Vocational Training / Certification</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control shadow-none" id="appSkills" name="appSkills"
                                        placeholder="Briefly describe your skills..." style="height: 100px;"></textarea>
                                    <label for="appSkills">Key Skills & Specializations</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <h5 class="text_dark fw-bold mb-3">Document Upload</h5>
                            <div class="col-md-6 mb-3">
                                <label for="uploadNIC" class="form-label-file">Upload copy of National ID Card
                                    (NIC)*</label>
                                <input class="form-control form-control-file shadow-none" type="file"
                                    id="uploadNIC" name="uploadNIC" accept="image/*" required>
                                <p class="form-text text-muted" style="font-size: 11px;">Max file size: 2MB.</p>
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
                            <button type="submit" class="fill_btn btn login_btn py-2">
                                <i class="fas fa-paper-plane me-2"></i>SUBMIT APPLICATION
                            </button>
                        </div>
                        <div id="applicationFormMessage" class="mt-3 text-center"></div>
                    </form>
                </section>

            </div>
        </div>
    </div>
</div>

@include('userpanel.includes.footer')
