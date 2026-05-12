
@include('userpanel.includes.header')

<div class="container-fluid full_bg">
    <div class="container">
        <form method="POST" class="needs-validation" novalidate id="login_form">
             @csrf
            <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-6">
                    <h1 class="text-center">Welcome to <span class="green_text">TUKTUK!</span></h1>
                    <h2 class="mb-3 text-center">Please login.</h2>

                    <div class="white_bg rounded px-5 py-4 mb-4 shadow">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control shadow-none"  type="email" required name="email" id="email"
                                placeholder="name@example.com">
                            <label for="email">Please Enter Your Email</label>
                             <div class="invalid-feedback">Email is required.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control shadow-none" id="password" required name="password"
                                placeholder="Password" autocomplete="new-password">
                            <label for="password">Please Enter Your Password</label>
                            <div class="invalid-feedback">Password is required.</div>
                        </div>

                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('reset-password') }}" class="text-end red_link">
                                Reset Your Password
                            </a>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button class="fill_btn btn login_btn" type="submit" id="login_submit">
                                LOGIN
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@include('userpanel.includes.footer')
