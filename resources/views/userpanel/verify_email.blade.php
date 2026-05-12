@include('userpanel.includes.header')

<div class="container-fluid full_bg">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="white_bg rounded px-4 py-5 mb-4 shadow text-center">
                    <i class="fas fa-shield-alt fa-3x mb-4 green_text"></i>
                    <h2 class="mb-2">Check Your Email</h2>
                    <p class="p text-muted">
                        Before proceeding to payment , we need to verify your email address.
                    </p>
                    <p class="p text-muted">
                        We've sent a 6-digit verification code to:
                    </p>
                    <p class="p fw-bold mb-4">{{ $user->email }}</p>


                    <form id="emailVerifyForm" class="needs-validation" novalidate class="mb-5">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control shadow-none text-center" id="verificationCode"
                                name="verificationCode" placeholder="Enter 6-digit code" maxlength="6" pattern="\d{6}"
                                inputmode="numeric" required style="letter-spacing: 0.5em;">
                            <label for="verificationCode">Enter 6-Digit Code</label>
                            <div class="invalid-feedback">Verification code is required.</div>
                        </div>
                        <input type="hidden" id="userId" name ="userId" value="{{ $user->id }}">

                        <button type="submit" id="verifyEmailBtn" class="fill_btn btn w-100 py-2">
                            VERIFY ACCOUNT
                        </button>
                    </form>
                    <form id="resendCodeForm" class="needs-validation" novalidate>
                        @csrf
                        <p class="p text-muted mb-2">Didn't receive the code?</p>
                        <button class="line_btn btn btn-sm" id="resendCodeBtn" type="submit">
                            <i class="fas fa-paper-plane me-1"></i> Resend Code
                        </button>
                        <input type="hidden" id="userId" name ="userId" value="{{ $user->id }}">
                    </form>

                    {{-- <div class="mt-4">
                        <a href="{{ route('login') }}" class="red_link">Back to Login</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@include('userpanel.includes.footer')
