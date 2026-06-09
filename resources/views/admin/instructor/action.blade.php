@extends('layouts.master')

@section('title', 'Instructor Action')

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

        /* ===== Action Page Custom Styles ===== */

        .action-header-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 28px 32px;
            color: #fff;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        }

        .action-header-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            pointer-events: none;
        }

        .action-header-banner::after {
            content: '';
            position: absolute;
            bottom: -40%;
            left: 10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
            pointer-events: none;
        }

        .action-header-banner .action-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .action-header-banner h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 12px 0 4px;
        }

        .action-header-banner .header-meta {
            opacity: 0.85;
            font-size: 0.9rem;
        }

        /* Detail Cards */
        .detail-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            margin-bottom: 25px;
            overflow: hidden;
            background: #fff;
        }

        .detail-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .detail-card .card-header-custom {
            padding: 18px 24px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fff;
        }

        .detail-card .card-header-custom .header-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #fff;
            flex-shrink: 0;
        }

        .detail-card .card-header-custom h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1rem;
            color: #2d3748;
            letter-spacing: 0.3px;
        }

        .detail-card .card-header-custom .header-subtitle {
            margin: 0;
            font-size: 0.78rem;
            color: #a0aec0;
            font-weight: 400;
        }

        .icon-action { background: linear-gradient(135deg, #667eea, #764ba2); }

        /* Form Styles */
        .action-form-body {
            padding: 28px;
        }

        .action-form-body .form-group label {
            font-weight: 600;
            color: #4a5568;
            font-size: 0.85rem;
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .action-form-body .form-control {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 10px 16px;
            font-size: 0.9rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            background: #f8f9ff;
            height: auto;
        }

        .action-form-body .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
            background: #fff;
        }

        /* Option Cards */
        .action-option {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 20px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.25s ease;
            margin-bottom: 12px;
            background: #fff;
        }

        .action-option:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .action-option.selected {
            border-color: #667eea;
            background: linear-gradient(135deg, #f0f0ff, #e8eaff);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.15);
        }

        .action-option .option-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #fff;
            flex-shrink: 0;
        }

        .option-icon-approve { background: linear-gradient(135deg, #43e97b, #38f9d7); }
        .option-icon-reject { background: linear-gradient(135deg, #f093fb, #f5576c); }

        .action-option .option-text h6 {
            margin: 0;
            font-weight: 700;
            font-size: 0.95rem;
            color: #2d3748;
        }

        .action-option .option-text p {
            margin: 2px 0 0;
            font-size: 0.78rem;
            color: #a0aec0;
        }

        /* Submit Button */
        .btn-submit-action {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 40px;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            color: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.35);
        }

        .btn-submit-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(102, 126, 234, 0.45);
            color: #fff;
        }

        .btn-submit-action:active {
            transform: translateY(0);
        }

        /* Animate-in */
        .animate-in {
            animation: fadeSlideUp 0.5s ease forwards;
            opacity: 0;
        }

        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }

        /* Responsive */
        @media (max-width: 768px) {
            .action-header-banner {
                padding: 20px;
            }

            .action-form-body {
                padding: 20px;
            }
        }
    </style>
@stop

@section('content')
    <!-- the #js-page-content id is needed for some plugins to initialize -->
    <main id="js-page-content" role="main" class="page-content">

        {{-- Error Messages --}}
        <div class="row">
            @if ($errors->any())
                <div class="col-12 mb-3">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                        style="border-radius: 10px; border: none; box-shadow: 0 2px 10px rgba(220,53,69,0.15);">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                        <strong><i class="fal fa-exclamation-triangle mr-2"></i>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        {{-- ===== Header Banner ===== --}}
        <div class="action-header-banner animate-in" id="action-banner">
            <div class="d-flex justify-content-between align-items-start flex-wrap" style="gap: 16px;">
                <div>
                    <span class="action-badge">
                        <i class="fal fa-chalkboard-teacher mr-1"></i>Instructor Applicant
                    </span>
                    <h2><i class="fal fa-gavel mr-2"></i>Take Action</h2>
                    <p class="header-meta mb-0">
                        <i class="fal fa-info-circle mr-1"></i>Review and approve or reject this instructor application
                    </p>
                </div>
            </div>
        </div>

        {{-- ===== Action Form Card ===== --}}
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="detail-card animate-in delay-1" id="action-form-card">
                    <div class="card-header-custom">
                        <div class="header-icon icon-action">
                            <i class="fal fa-tasks"></i>
                        </div>
                        <div>
                            <h5>Select Action</h5>
                            <p class="header-subtitle">Choose how to proceed with this application</p>
                        </div>
                    </div>
                    <div class="action-form-body">
                        <form action="{{ route('save-instructor-action') }}" enctype="multipart/form-data" method="post"
                            autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">

                            {{-- Action Options --}}
                            <div class="mb-4">
                                <label class="action-option selected" id="option-approve" onclick="selectAction('Approve')">
                                    <div class="option-icon option-icon-approve">
                                        <i class="fal fa-check"></i>
                                    </div>
                                    <div class="option-text">
                                        <h6>Approve Application</h6>
                                        <p>Accept this applicant and grant instructor access</p>
                                    </div>
                                </label>
                                <label class="action-option" id="option-reject" onclick="selectAction('Reject')">
                                    <div class="option-icon option-icon-reject">
                                        <i class="fal fa-times"></i>
                                    </div>
                                    <div class="option-text">
                                        <h6>Reject Application</h6>
                                        <p>Decline this applicant's request</p>
                                    </div>
                                </label>
                            </div>

                            <select class="form-control" id="action" name="action" style="display: none;">
                                <option value="Approve" selected>Approve</option>
                                <option value="Reject">Reject</option>
                            </select>

                            {{-- Submit --}}
                            <div class="d-flex justify-content-end pt-3" style="border-top: 1px solid #f0f0f5;">
                                <button class="btn btn-submit-action" type="submit">
                                    <i class="fal fa-paper-plane mr-2"></i>Submit Action
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
@stop

@section('footerScript')
    <script>
        function selectAction(action) {
            document.getElementById('action').value = action;

            document.getElementById('option-approve').classList.remove('selected');
            document.getElementById('option-reject').classList.remove('selected');

            if (action === 'Approve') {
                document.getElementById('option-approve').classList.add('selected');
            } else {
                document.getElementById('option-reject').classList.add('selected');
            }
        }
    </script>
@stop
