@extends('layouts.master')

@section('title', 'Create Users')

@section('headerStyle')
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('public/back/css/miscellaneous/reactions/reactions.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('public/back/css/miscellaneous/fullcalendar/fullcalendar.bundle.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('public/back/css/miscellaneous/jqvmap/jqvmap.bundle.css') }}">

@stop

@section('content')
    <!-- the #js-page-content id is needed for some plugins to initialize -->
    <main id="js-page-content" role="main" class="page-content">

        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-chart-area'></i> {{ __('Users') }}<span class='fw-300'></span>
            </h1>

            <div class="row" style="margin-left:auto; margin-right:auto; gap: 12px"">
                @can('user-create')
                    <a href=" {{ route('user-create') }}">
                        <button type="button" class="btn btn-lg btn-primary">
                            <span class="mr-1 fal fa-plus"></span>
                            Add New
                        </button>
                    </a>
                @endcan
                <a href=" {{ route('user-list') }}">
                    <button type="button" class="btn btn-lg btn-primary">
                        <span class="mr-1 fal fa-list"></span>
                        View All
                    </button>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Create User
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
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                @endif
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
                            <form action="{{ route('save-user') }}" enctype="multipart/form-data" method="post"
                                id="user-form" class="smart-form row" autocomplete="off" data-parsley-validate>
                                @csrf
                                <div class="mb-3 col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            data-parsley-required="true" required>
                                    </div>
                                </div>

                                <div class="mb-3 col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            data-parsley-type="email" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="mb-3 col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" id="password" class="form-control password" name="password"
                                            data-parsley-strong-password data-parsley-errors-container="#password-error"
                                            required>
                                        <div id="password-error"></div>
                                    </div>
                                </div>

                                <div class="mb-3 col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="confirm_password">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" id="confirm_password" class="form-control confirmpassword"
                                            name="confirm_password" data-parsley-equalto="#password"
                                            data-parsley-errors-container="#confirm-password-error" required>
                                        <div id="confirm-password-error"></div>
                                    </div>
                                </div>

                                <div class="mb-3 col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="roles">Role <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="roles" name="roles" required>
                                            @foreach ($roles as $x => $val)
                                                <option value="{{ $val }}">{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 col-6" id="branch_div" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label" for="branch_id">Branch <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="branch_id" name="branch_id" >
                                             <option value="">Select Branch</option>
                                            @foreach ($branches as $x => $val)
                                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div
                                        class="flex-row panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex">
                                        <button class="ml-auto btn btn-primary" type="submit">Submit form</button>
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
        });

        $('#roles').on('change', function() {
            var selectedRole = $(this).val();
            if (selectedRole === 'Branch Manager') {
                $('#branch_div').show();
                $('#branch_id').attr('required', true);
            } else {
                $('#branch_div').hide();
                $('#branch_id').attr('required', false);
            }
        });
    </script>
@stop
