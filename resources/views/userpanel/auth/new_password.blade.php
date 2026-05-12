@include('userpanel.includes.header')

<div class="container-fluid full_bg" style="padding-top: 50px;">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh; padding-top: 100px;">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="white_bg rounded px-4 py-5 mb-4 shadow text-center">
                    <i class="fas fa-lock fa-3x mb-4 green_text"></i>
                    <h2 class="text_dark mb-3">Set New Password</h2>
                    <p class="p text-muted mb-4">
                        Please create a new password for your account. Make sure it's strong and memorable.
                    </p>

                    <form id="setNewPasswordForm" method="POST" class="needs-validation" novalidate >
                        @csrf
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control shadow-none" id="newPassword" name="newPassword"
                                placeholder="New Password" required minlength="8">
                            <label for="newPassword">New Password</label>
                            <div class="invalid-feedback">Password is required  and must be at least 8 characters long.</div>
                            {{-- <i class="fas fa-eye password-toggle-icon" id="toggleNewPassword"></i> --}}
                        </div>
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control shadow-none" id="confirmNewPassword"
                                name="confirmNewPassword" placeholder="Confirm New Password" required>
                            <label for="confirmNewPassword">Confirm New Password</label>
                            <div class="invalid-feedback">Confirm Password is required.</div>
                            {{-- <i class="fas fa-eye password-toggle-icon" id="toggleConfirmNewPassword"></i> --}}
                        </div>

                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <button type="submit" id="setNewPasswordBtn" class="fill_btn btn w-100 py-2 mt-3">
                            SET NEW PASSWORD
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
