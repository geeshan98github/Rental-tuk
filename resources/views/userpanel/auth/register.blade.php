@include('userpanel.includes.header')

<div class="container-fluid full_bg">
    <div class="container">
        <form method="POST" class="needs-validation" novalidate id="register_form">
            @csrf
            
            <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-8">
                    <h1 class="text-center">Welcome to <span class="green_text">TUKTUK!</span></h1>
                    <h2 class="mb-3 text-center">Create Your Account</h2>
                    <div class="white_bg rounded px-5 py-4 mb-5 shadow row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control shadow-none" id="first_name" name="first_name"
                                    placeholder="First Name" required>
                                <label for="first_name">First Name</label>
                                <div class="invalid-feedback">First Name is required.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control shadow-none" id="last_name" name="last_name"
                                    placeholder="Last Name" required>
                                <label for="last_name">Last Name</label>
                                <div class="invalid-feedback">Last Name is required.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control shadow-none" id="email" name="email"
                                    placeholder="name@example.com" required>
                                <label for="email">Email</label>
                                <div class="invalid-feedback">A valid email is required.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control shadow-none" id="phone_number"
                                    name="phone_number" placeholder="Phone Number"  pattern="[0-9+\-\s]{8,15}">
                                <label for="phone_number">Phone Number</label>
                               
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-2">
                                <input type="password" class="form-control shadow-none" id="password" name="password"
                                    placeholder="Password" minlength="8" required autocomplete="new-password">
                                <label for="password">Password</label>
                                <div class="invalid-feedback">Password is required.</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-floating mb-2">
                                <input type="password" class="form-control shadow-none" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm Password" required>
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="invalid-feedback">Confirm Password is required.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <select class="form-select shadow-none" name="contry_of_residence"
                                    id="contry_of_residence" required>
                                    <option value="">Select Country</option>
                                    @foreach ($contries as $country)
                                        <option value="{{ $country->printable_name }}">{{ $country->printable_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="contry_of_residence">Country of Residence</label>
                                <div class="invalid-feedback">Country of Residence is required.</div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_agree_terms"
                                    name="is_agree_terms" required>
                                <label class="form-check-label d-flex" for="is_agree_terms">
                                    I agree to TUK TUK <a href="">Terms</a> of use and <a
                                        href="">privacy policy</a>
                                </label>
                               
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="fill_btn btn login_btn" type="submit" id="register_submit">
                                REGISTER
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@include('userpanel.includes.footer')
