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
                        <h1 class="mb-4" data-aos="fade-up">Driving Instructor</h1>
                        <p class="mb-1" data-aos="fade-up" data-aos-delay="100"><i
                                class="fas fa-map-marker-alt me-2 green_text"></i>Colombo, Kandy</p>
                        <p class="mb-0" data-aos="fade-up" data-aos-delay="150"><i
                                class="fas fa-briefcase me-2 green_text"></i>Full-time / Part-time</p>
                    </div>

                    <div data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text_dark fw-bold mb-3">Job Overview:</h3>
                        <p class="p">Rent A Tuk is looking for experienced, patient, and certified Driving
                            Instructors to provide high-quality tuk-tuk driving lessons to foreign tourists. The goal is
                            to equip our clients with the necessary skills and confidence to safely navigate Sri Lankan
                            roads and enjoy their self-drive adventure.</p>

                        <h3 class="text_dark fw-bold mt-4 mb-3">Key Responsibilities:</h3>
                        <ul class="custom_list p">
                            <li>Conduct practical, hands-on driving lessons for individuals and small groups.</li>
                            <li>Teach local traffic rules, road etiquette, and specific techniques for handling a
                                tuk-tuk.</li>
                            <li>Provide comprehensive safety briefings and emergency procedure training.</li>
                            <li>Assess the competency of learners and provide constructive feedback.</li>
                            <li>Maintain a calm and encouraging learning environment.</li>
                            <li>Ensure the training vehicle is well-maintained and safe for use.</li>
                            <li>Manage training schedules and appointments effectively.</li>
                        </ul>

                        <h3 class="text_dark fw-bold mt-4 mb-3">Qualifications:</h3>
                        <ul class="custom_list p">
                            <li>Valid Driving Instructor's License issued by the relevant Sri Lankan authority.</li>
                            <li>Extensive experience in driving tuk-tuks and a clean, impeccable driving record.</li>
                            <li>Prior experience as a driving instructor is highly preferred.</li>
                            <li>Excellent communication and interpersonal skills.</li>
                            <li>High level of patience and the ability to teach individuals with varying skill levels.
                            </li>
                            <li>Good command of English is essential; knowledge of other foreign languages is an
                                advantage.</li>
                            <li>Must provide a recent police clearance report.</li>
                        </ul>
                    </div>
                </div>

                <!-- Application Form Section -->
                <section class="bg_light p-4 p-md-5 rounded shadow mb-4" id="applyForm" data-aos="fade-up">
                    <h1 class="text-center mb-5">Apply for this Position</h1>
                    <form id="instructorForm" action="{{ route('save-instructor') }}" method="POST"
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

                        <div class="row mb-5">
                            <h5 class="text_dark fw-bold mb-3">Professional Details</h5>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control shadow-none" id="appInstructorLicense"
                                        name="appInstructorLicense" placeholder="Instructor's License No." required>
                                    <label for="appInstructorLicense">Instructor's License No.*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control shadow-none" id="appExperience"
                                        name="appExperience" placeholder="Years of Teaching Experience" min="0"
                                        required>
                                    <label for="appExperience">Years of Teaching Experience*</label>
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

                        <div class="row">
                            <h5 class="text_dark fw-bold mb-3">Document Upload</h5>
                            <div class="col-md-6 mb-3">
                                <label for="uploadInstructorLicense" class="form-label-file">Upload copy of
                                    Instructor's License*</label>
                                <input class="form-control form-control-file shadow-none" type="file"
                                    id="uploadInstructorLicense" name="uploadInstructorLicense" accept="image/*"
                                    required>
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

                    </form>
                </section>

            </div>
        </div>
    </div>
</div>
@include('userpanel.includes.footer')
