@extends('userpanel.auth.dashboard_layout')

@section('content')
    <div class="col-lg-9">
        <h1 class="mb-4">My Profile</h1>

        <section class="bg_light p-4 rounded shadow mb-4">
            <form id="profileForm" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-2 text-center text-md-start mb-4 mb-md-0">
                        <div class="profile-pic-container mx-auto mx-md-0">
                            <img src="@if ($user->profile_image) {{ asset('storage/app/private/' . $user->profile_image) }} @else {{ asset('public/frontend/images/profile.jpg') }} @endif"
                                alt="Sajani Wathsala" id="profileImage" class="rounded-circle profile-pic">
                            <button type="button" class="edit-pic-btn" id="editPicButton" style="display: none;"
                                onclick="document.getElementById('profilePicInput').click();">
                                <i class="fas fa-camera"></i>
                            </button>
                            <input type="file" id="profilePicInput" name="profilePic" accept="image/*"
                                style="display: none;" onchange="previewProfileImage(event)">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control shadow-none" id="firstName" name="firstName"
                                        placeholder="First Name" readonly value="{{ $user->first_name }}">
                                    <label for="firstName">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control shadow-none" id="lastName" name="lastName"
                                        placeholder="Last Name" readonly value="{{ $user->last_name }}">
                                    <label for="lastName">Last Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control shadow-none" id="email-address"
                                        placeholder="Email Address" value="{{ $user->email }}" disabled>
                                    <label for="email-address">Email Address</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control shadow-none" id="mobile" name="mobile"
                                        placeholder="Mobile Number" value="{{ $user->phone_number }}" readonly>
                                    <label for="mobile">Mobile Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control shadow-none datepicker_input" id="birthDate"
                                        name="birthDate" placeholder="DD/MM/YYYY"
                                        @if ($user->date_of_birth) value="{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') }}" @else value="" @endif
                                        autocomplete="off">
                                    <label for="birthDate">Birth Day</label>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">


                                    <select class="form-select shadow-none" name="countryResidence" id="countryResidence"
                                        disabled>
                                        <option value="">Select Country</option>
                                        @foreach ($contries as $country)
                                            <option value="{{ $country->name }}"
                                                @if ($country->name === $user->contry_of_residence) selected @endif>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="countryResidence">Country of Residence</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control shadow-none" id="passportNumber"
                                        name="passportNumber" placeholder="Passport Number"
                                        value="{{ $user->passport_number }}" readonly>
                                    <label for="passportNumber">Passport Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control shadow-none" id="emergencyContact"
                                        name="emergencyContact" placeholder="Emergency Contact"
                                        value="{{ $user->emergency_number }}" readonly>
                                    <label for="emergencyContact">Emergency Contact Number</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3" id="passwordSection" style="display: none;">
                            <input type="password" class="form-control shadow-none" id="password" name="password"
                                placeholder="New Password" autocomplete="new-password">
                            <label for="password">New Password (leave blank to keep current)</label>
                        </div>
                        <div class="form-floating mb-3" id="confirmPasswordSection" style="display: none;">
                            <input type="password" class="form-control shadow-none" id="confirmPassword"
                                name="confirmPassword" placeholder="Confirm New Password">
                            <label for="confirmPassword">Confirm New Password</label>
                        </div>


                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <input type="hidden" name="userId" value="{{ $user->id }}">
                            <button type="button" class="line_btn btn" id="editProfileBtn"
                                onclick="toggleEditProfile(true)">
                                <i class="fas fa-edit me-1"></i> EDIT PROFILE
                            </button>
                            <button type="submit" class="fill_btn btn" id="saveProfileBtn" style="display: none;">
                                <i class="fas fa-save me-1"></i> SAVE CHANGES
                            </button>
                            <button type="button" class="btn btn-secondary" id="cancelEditBtn" style="display: none;"
                                onclick="toggleEditProfile(false)">
                                CANCEL
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
