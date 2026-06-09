@extends('layouts.master')

@section('title', 'view Applicant')

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

        /* ===== Applicant Detail Page Custom Styles ===== */

        .applicant-header-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 28px 32px;
            color: #fff;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        }

        .applicant-header-banner::before {
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

        .applicant-header-banner::after {
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

        .applicant-header-banner .applicant-name-badge {
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

        .applicant-header-banner h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 12px 0 4px;
        }

        .applicant-header-banner .header-meta {
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

        .icon-personal { background: linear-gradient(135deg, #667eea, #764ba2); }
        .icon-contact { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .icon-experience { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .icon-documents { background: linear-gradient(135deg, #43e97b, #38f9d7); }
        .icon-action { background: linear-gradient(135deg, #fa709a, #fee140); }

        /* Detail Rows */
        .detail-row {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            border-bottom: 1px solid #f7f8fa;
            transition: background 0.15s ease;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-row:hover {
            background: #f8f9ff;
        }

        .detail-row .detail-label {
            flex: 0 0 200px;
            font-weight: 600;
            color: #64748b;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-row .detail-label i {
            color: #a0aec0;
            font-size: 0.8rem;
            width: 18px;
            text-align: center;
        }

        .detail-row .detail-value {
            flex: 1;
            font-weight: 500;
            color: #2d3748;
            font-size: 0.9rem;
        }

        /* Experience Badge */
        .experience-badge {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            padding: 10px 22px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            text-align: center;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .experience-badge .exp-number {
            font-size: 1.8rem;
            display: block;
            line-height: 1;
            margin-bottom: 2px;
        }

        .experience-badge .exp-text {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: 0.85;
        }

        /* Document Thumbnails */
        .doc-thumbnail-wrap {
            display: inline-block;
            border-radius: 12px;
            overflow: hidden;
            border: 3px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
        }

        .doc-thumbnail-wrap:hover {
            border-color: #667eea;
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.25);
        }

        .doc-thumbnail-wrap img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            display: block;
        }

        .doc-thumbnail-wrap .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(102, 126, 234, 0.0);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .doc-thumbnail-wrap:hover .overlay {
            background: rgba(102, 126, 234, 0.35);
        }

        .doc-thumbnail-wrap .overlay i {
            color: #fff;
            font-size: 1.4rem;
            opacity: 0;
            transform: scale(0.5);
            transition: all 0.3s ease;
        }

        .doc-thumbnail-wrap:hover .overlay i {
            opacity: 1;
            transform: scale(1);
        }

        /* Action Buttons */
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

        .btn-back-all {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-back-all:hover {
            background: rgba(255, 255, 255, 0.35);
            color: #fff;
            text-decoration: none;
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
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .detail-row .detail-label {
                flex: none;
            }

            .applicant-header-banner {
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
        <div class="applicant-header-banner animate-in" id="applicant-banner">
            <div class="d-flex justify-content-between align-items-start flex-wrap" style="gap: 16px;">
                <div>
                    <span class="applicant-name-badge">
                        <i class="fal fa-wrench mr-1"></i>Mechanic Applicant #{{ $data->id }}
                    </span>
                    <h2><i class="fal fa-tools mr-2"></i>{{ $data->first_name }} {{ $data->last_name }}</h2>
                    <p class="header-meta mb-0">
                        <i class="fal fa-envelope mr-1"></i>{{ $data->email }}
                        &nbsp;&bull;&nbsp;
                        <i class="fal fa-phone mr-1"></i>{{ $data->phone_number }}
                    </p>
                </div>
                <div class="d-flex align-items-center" style="gap: 10px;">
                    @can('mechanic-applicant-list')
                        <a href="{{ route('mechanic-applicant-list') }}" class="btn-back-all">
                            <i class="fal fa-arrow-left mr-1"></i> View All Applicants
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="row">

            {{-- ===== LEFT COLUMN ===== --}}
            <div class="col-lg-8">

                {{-- Personal Information Card --}}
                <div class="detail-card animate-in delay-1" id="personal-info-card">
                    <div class="card-header-custom">
                        <div class="header-icon icon-personal">
                            <i class="fal fa-user"></i>
                        </div>
                        <div>
                            <h5>Personal Information</h5>
                            <p class="header-subtitle">Basic details of the applicant</p>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="detail-row">
                            <div class="detail-label"><i class="fal fa-user"></i> First Name</div>
                            <div class="detail-value">{{ $data->first_name }}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label"><i class="fal fa-user"></i> Last Name</div>
                            <div class="detail-value">{{ $data->last_name }}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label"><i class="fal fa-map-marker-alt"></i> Address</div>
                            <div class="detail-value">{{ $data->address }}</div>
                        </div>
                    </div>
                </div>

                {{-- Contact Information Card --}}
                <div class="detail-card animate-in delay-2" id="contact-info-card">
                    <div class="card-header-custom">
                        <div class="header-icon icon-contact">
                            <i class="fal fa-address-book"></i>
                        </div>
                        <div>
                            <h5>Contact Information</h5>
                            <p class="header-subtitle">Email & phone details</p>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="detail-row">
                            <div class="detail-label"><i class="fal fa-envelope"></i> Email</div>
                            <div class="detail-value">{{ $data->email }}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label"><i class="fal fa-phone"></i> Phone No</div>
                            <div class="detail-value">{{ $data->phone_number }}</div>
                        </div>
                    </div>
                </div>

                {{-- Experience Card --}}
                <div class="detail-card animate-in delay-3" id="experience-card">
                    <div class="card-header-custom">
                        <div class="header-icon icon-experience">
                            <i class="fal fa-briefcase"></i>
                        </div>
                        <div>
                            <h5>Experience</h5>
                            <p class="header-subtitle">Professional background</p>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row m-0">
                            <div class="col-md-7 p-0">
                                <div class="detail-row">
                                    <div class="detail-label"><i class="fal fa-clock"></i> Years of Experience</div>
                                    <div class="detail-value" style="font-weight: 700;">{{ $data->year_of_experience }} Years</div>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex align-items-center justify-content-center py-4 px-4">
                                <div class="experience-badge">
                                    <span class="exp-number">{{ $data->year_of_experience }}</span>
                                    <span class="exp-text">Years Experience</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ===== RIGHT COLUMN ===== --}}
            <div class="col-lg-4">

                {{-- Documents Card --}}
                <div class="detail-card animate-in delay-4" id="documents-card">
                    <div class="card-header-custom">
                        <div class="header-icon icon-documents">
                            <i class="fal fa-file-alt"></i>
                        </div>
                        <div>
                            <h5>Documents</h5>
                            <p class="header-subtitle">Uploaded verification files</p>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 20px 24px;">
                        {{-- NIC --}}
                        <div class="mb-4">
                            <p style="font-weight: 600; color: #64748b; font-size: 0.85rem; margin-bottom: 10px;">
                                <i class="fal fa-id-card mr-1" style="color: #a0aec0;"></i> NIC
                            </p>
                            <a href="{{ asset('storage/app/private/' . $data->nic_image) }}" target="_blank" class="doc-thumbnail-wrap">
                                <img src="{{ asset('storage/app/private/' . $data->nic_image) }}" alt="NIC">
                                <div class="overlay"><i class="fal fa-search-plus"></i></div>
                            </a>
                        </div>
                        {{-- Police Clearance --}}
                        <div>
                            <p style="font-weight: 600; color: #64748b; font-size: 0.85rem; margin-bottom: 10px;">
                                <i class="fal fa-shield-alt mr-1" style="color: #a0aec0;"></i> Police Clearance
                            </p>
                            <a href="{{ asset('storage/app/private/' . $data->police_report) }}" target="_blank" class="doc-thumbnail-wrap">
                                <img src="{{ asset('storage/app/private/' . $data->police_report) }}" alt="Police Clearance">
                                <div class="overlay"><i class="fal fa-search-plus"></i></div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Action Card --}}
                <div class="detail-card animate-in delay-5" id="action-card">
                    <div class="card-header-custom">
                        <div class="header-icon icon-action">
                            <i class="fal fa-bolt"></i>
                        </div>
                        <div>
                            <h5>Actions</h5>
                            <p class="header-subtitle">Approval & management</p>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 20px 24px;">
                        @can('send-approvel-mechanic-applicant')
                            <form action="{{ route('send-mechanic-approvel') }}" method="POST" class="mb-3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <button class="btn btn-submit-action btn-block" type="submit">
                                    <i class="fal fa-paper-plane mr-2"></i>Send to Approval
                                </button>
                            </form>
                        @endcan
                        @can('action-mechanic-applicant')
                            <form action="{{ route('action-mechanic-approvel') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <button class="btn btn-submit-action btn-block" type="submit" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); box-shadow: 0 4px 15px rgba(67, 233, 123, 0.35);">
                                    <i class="fal fa-check-circle mr-2"></i>Action
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>

            </div>
        </div>

    </main>
@stop

@section('footerScript')


@stop
