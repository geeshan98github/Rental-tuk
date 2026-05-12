@include('userpanel.includes.header')

<div class="container-fluid full_bg" style="padding-top: 50px;">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh; padding-top: 100px;">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="white_bg rounded px-4 py-5 mb-4 shadow text-center">
                    <i class="fas fa-key fa-3x mb-4 green_text"></i>
                    <h2 class="text_dark mb-3">Reset Your Password</h2>
                    <p class="p text-muted mb-4">
                        Enter the email address associated with your account, and we'll send you a link to reset your
                        password.
                    </p>

                    <form id="passwordResetRequestForm" method="POST" class="needs-validation" novalidate id="register_form">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control shadow-none" id="resetEmail" name="resetEmail"
                                placeholder="name@example.com" required>
                            <label for="resetEmail">Email Address</label>
                            <div class="invalid-feedback">A valid email is required.</div>
                        </div>

                        <button  id="resetPasswordBtn" type="submit" class="fill_btn btn w-100 py-2 mt-3">
                            SEND RESET LINK
                        </button>
                    </form>

                    

                    <div class="mt-3">
                        <a href="{{ route('login') }}" class="red_link"><i class="fas fa-arrow-left me-1"></i> Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('userpanel.includes.footer')
