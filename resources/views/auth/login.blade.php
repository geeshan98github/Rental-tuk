@extends('layouts.guest')

@section('content')
<div class='login_form_div'>
    <div class="brand_logo">
        <img src="{{ asset('public/back/img/logo.png') }}">
    </div>
    <div class='mt-3 mb-4'>
        <h1 class='login_note'>
            <span class='mb-0'>WELCOME TO</span><br>
            TUK TUK
        </h1>
    </div>

    <h2 class='mb-3 text-uppercase'>{{ __('Login') }}</h2>

    <form method='POST' action="{{ route('cms-login') }}" class='login_form'>
        @csrf

        <div class='mb-3'>
            <div class='form-floating mb-3'>
                <input
                    id='email'
                    name='email'
                    type='email'
                    placeholder=''
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    required
                    autocomplete='email'
                    autofocus
                    aria-describedby='emailHelp'
                >
                <label for='email'>{{ __('Email Address') }}</label>

                @error('email')
                <span class='invalid-feedback' role='alert'>{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class='mb-3'>
            <div class='form-floating mb-3'>
                <input
                    id='password'
                    name='password'
                    placeholder=''
                    type='password'
                    class="form-control @error('password') is-invalid @enderror"
                    required
                    autocomplete='current-password'
                >
                <label for='password'>{{ __('Password') }}</label>

                @error('password')
                <span class='invalid-feedback' role='alert'>{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!--<div class='row m-auto'>-->
        <!--    <div class='mb-3 form-check col-md-6'>-->
        <!--        {{-- <input id='remember' name='remember' type='checkbox' class='form-check-input' {{ old('remember') ? 'checked' : '' }}> --}}-->
        <!--        {{-- <label for='remember' class='form-check-label'>{{ __('Remember Me') }}</label> --}}-->
        <!--    </div>-->
        <!--</div>-->

        <button type='submit' class='btn btn-primary org_btn'>{{ __('Login') }}</button>
    </form>
</div>
@endsection
