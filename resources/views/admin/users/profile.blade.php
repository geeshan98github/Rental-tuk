@extends('layouts.master')

@section('title', 'Edit Profile')

@section('headerStyle')
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('public/back/css/miscellaneous/reactions/reactions.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('public/back/css/miscellaneous/fullcalendar/fullcalendar.bundle.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('public/back/css/miscellaneous/jqvmap/jqvmap.bundle.css') }}">

    <style>
        #changepassword {
            display: none;
        }

        .parsley-errors-list {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
@stop

@section('content')
    <!-- the #js-page-content id is needed for some plugins to initialize -->
    <main id="js-page-content" role="main" class="page-content">

        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-chart-area'></i> <span class='fw-300'>Edit Profile</span>
            </h1>


        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Edit Profile
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                            {{-- <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> --}}
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            {{-- <div class="panel-tag">
                            Be sure to use an appropriate type attribute on all inputs (e.g., code <code>email</code> for email address or <code>number</code> for numerical information) to take advantage of newer input controls like email verification, number selection, and more.
                        </div> --}}
                            <div class="row">
                                {{-- @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                @endif --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                        </button>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <form action="{{ route('update-profile') }}" enctype="multipart/form-data" method="post"
                                id="user-form" class="smart-form row" autocomplete="off" data-parsley-validate>
                                @csrf
                                @method('PUT')


                                @if ($data != '')
                                    <div class="mb-3 col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="first_name">First Name <span
                                                    style=" color: red;">*</span></label>
                                            <input type="text" id="first_name" name="first_name" class="form-control"
                                                value="{{ $data->first_name }}" data-parsley-maxlength="100"
                                                data-parsley-required="true" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="last_name">Last Name <span
                                                    style=" color: red;">*</span></label>
                                            <input type="text" id="last_name" name="last_name" class="form-control"
                                                value="{{ $data->last_name }}" data-parsley-maxlength="100"
                                                data-parsley-required="true" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone_number">Phone Number <span
                                                    style=" color: red;">*</span></label>
                                            <input type="text" id="phone_number" name="phone_number" class="form-control"
                                                value="{{ $data->phone_number }}" data-parsley-maxlength="100"
                                                data-parsley-required="true" required>
                                        </div>
                                    </div>
                                     <div class="mb-3 col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="address">Address<span
                                                    style=" color: red;">*</span></label>
                                            <input type="text" id="address" name="address" class="form-control"
                                                value="{{ $data->address }}" data-parsley-maxlength="100"
                                                data-parsley-required="true" required>
                                        </div>
                                    </div>
                                     <div class="mb-3 col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="year_of_experience">Year of Experience<span
                                                    style=" color: red;">*</span></label>
                                            <input type="number" id="year_of_experience" name="year_of_experience" class="form-control"
                                                value="{{ $data->year_of_experience }}" data-parsley-maxlength="100"
                                                data-parsley-required="true" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email <span
                                                    style=" color: red;">*</span></label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                value="{{ $data->email }}" data-parsley-type="email" autocomplete="off"
                                                required readonly>
                                        </div>
                                    </div>
                                @else
                                    <div class="mb-3 col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Name <span
                                                    style=" color: red;">*</span></label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                value="{{ $user->name }}" data-parsley-maxlength="100"
                                                data-parsley-required="true" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email <span
                                                    style=" color: red;">*</span></label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                value="{{ $user->email }}" data-parsley-type="email" autocomplete="off"
                                                required readonly>
                                        </div>
                                    </div>
                                @endif



                                <div class="mb-3 col-12">
                                    <div class="label">Change Password
                                        <button id="changepwyes" type="button" class="ml-2 btn btn-sm btn-outline-primary">
                                            Yes </button>
                                        <button id="changepwno" type="button" class="ml-2 btn btn-sm btn-outline-primary">
                                            No </button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div id="changepassword">
                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="password">Password<span
                                                            style=" color: red;">*</span></label>
                                                    <input type="password" id="password" class="form-control password"
                                                        name="password" data-parsley-strong-password
                                                        data-parsley-errors-container="#password-error" disabled>
                                                    <div id="password-error"></div>
                                                </div>
                                            </div>

                                            <div class="mb-3 col-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="confirm_password">Confirm Password
                                                        <span style=" color: red;">*</span></label>
                                                    <input type="password" id="confirm_password"
                                                        class="form-control confirmpassword" name="confirm_password"
                                                        data-parsley-equalto="#password"
                                                        data-parsley-errors-container="#confirm-password-error" disabled>
                                                    <div id="confirm-password-error"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="id" value="{{ $user->id }}">

                                <div class="col-12">
                                    <div
                                        class="flex-row panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex">
                                        <button class="ml-auto btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop

@section('footerScript')

    <script>
        $(document).ready(function() {
            // Initialize Parsley
            $('#user-form').parsley();

            // Strong password validation
            window.Parsley.addValidator('strongPassword', {
                requirementType: 'string',
                validateString: function(value) {
                    // Strong password regex: At least one uppercase, one lowercase, one number, and one special character
                    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(
                        value);
                },
                messages: {
                    en: 'Your password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
                },
            });

            // Show/hide password fields on button clicks
            $('#changepwyes').click(function() {
                $('#changepassword').show();
                $('.password, .confirmpassword').attr('disabled', false).attr('required', true).attr(
                    'data-parsley-required', true);
            });

            $('#changepwno').click(function() {
                $('#changepassword').hide();
                $('.password, .confirmpassword').attr('disabled', true).removeAttr('required').removeAttr(
                    'data-parsley-required');
                $('.password, .confirmpassword').val('');
            });
        });
    </script>
@stop
