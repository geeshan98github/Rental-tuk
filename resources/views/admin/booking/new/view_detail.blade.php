@extends('layouts.master')

@section('title', 'Booking Details')

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

        /* ===== Booking Detail Page Custom Styles ===== */

        .booking-header-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 28px 32px;
            color: #fff;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        }

        .booking-header-banner::before {
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

        .booking-header-banner::after {
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

        .booking-header-banner .trip-id-badge {
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

        .booking-header-banner h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 12px 0 4px;
        }

        .booking-header-banner .header-meta {
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

        .icon-trip { background: linear-gradient(135deg, #667eea, #764ba2); }
        .icon-passenger { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .icon-vehicle { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .icon-services { background: linear-gradient(135deg, #43e97b, #38f9d7); }
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

        /* Status Badges */
        .badge-yes {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .badge-no {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .badge-count {
            background: linear-gradient(135deg, #e8eaf6, #c5cae9);
            color: #283593;
            padding: 3px 12px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            margin-left: 8px;
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

        /* Service Items Grid */
        .service-item {
            padding: 16px 20px;
            border-radius: 10px;
            background: #f8f9ff;
            border: 1px solid #edf0f7;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
        }

        .service-item:hover {
            background: #eef1ff;
            border-color: #d0d5f0;
        }

        .service-item .service-name {
            font-weight: 600;
            color: #4a5568;
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .service-item .service-name i {
            color: #667eea;
            font-size: 0.9rem;
        }

        .service-item .service-status {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Action Section */
        .action-section {
            border-radius: 14px;
            padding: 0;
            overflow: hidden;
        }

        .action-section .card-body-custom {
            padding: 24px;
        }

        .action-section .form-group label {
            font-weight: 600;
            color: #4a5568;
            font-size: 0.85rem;
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .action-section .form-control {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 10px 16px;
            font-size: 0.9rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            background: #f8f9ff;
        }

        .action-section .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
            background: #fff;
        }

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

        /* Timeline Dots for Trip */
        .trip-timeline {
            position: relative;
            padding-left: 30px;
        }

        .trip-timeline::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 6px;
            bottom: 6px;
            width: 2px;
            background: linear-gradient(180deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        .trip-timeline .timeline-point {
            position: relative;
            padding: 10px 0;
        }

        .trip-timeline .timeline-point::before {
            content: '';
            position: absolute;
            left: -26px;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            background: #667eea;
            border-radius: 50%;
            border: 3px solid #e8eaf6;
            z-index: 1;
        }

        .trip-timeline .timeline-point.endpoint::before {
            background: #764ba2;
        }

        .trip-timeline .timeline-label {
            font-size: 0.75rem;
            color: #a0aec0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .trip-timeline .timeline-value {
            font-size: 0.95rem;
            color: #2d3748;
            font-weight: 600;
            margin-top: 2px;
        }

        .trip-timeline .timeline-sub {
            font-size: 0.82rem;
            color: #718096;
            margin-top: 1px;
        }

        /* Duration Badge */
        .duration-badge {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            padding: 10px 22px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            text-align: center;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .duration-badge .duration-number {
            font-size: 1.8rem;
            display: block;
            line-height: 1;
            margin-bottom: 2px;
        }

        .duration-badge .duration-text {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: 0.85;
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

            .booking-header-banner {
                padding: 20px;
            }

            .trip-timeline {
                padding-left: 24px;
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
        <div class="booking-header-banner animate-in" id="booking-banner">
            <div class="d-flex justify-content-between align-items-start flex-wrap" style="gap: 16px;">
                <div>
                    <span class="trip-id-badge">
                        <i class="fal fa-hashtag mr-1"></i>Trip ID: {{ $booking->trip_id }}
                    </span>
                    <h2><i class="fal fa-clipboard-list mr-2"></i>Booking Details</h2>
                    <p class="header-meta mb-0">
                        <i class="fal fa-calendar-alt mr-1"></i>{{ $booking->check_in }} &mdash; {{ $booking->check_out }}
                        &nbsp;&bull;&nbsp;
                        <i class="fal fa-clock mr-1"></i>{{ $booking->trip_duration }} Days Duration
                    </p>
                </div>
                <div class="d-flex align-items-center" style="gap: 10px;">
                    @can('new-booking-list')
                        <a href="{{ route('new-booking-list') }}" class="btn-back-all">
                            <i class="fal fa-arrow-left mr-1"></i> View All Bookings
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <form action="{{ route('booking-action') }}" method="POST" enctype="multipart/form-data" id="booking_action_form" data-parsley-validate>
            @csrf
            <input type="hidden" name="bookingId" value="{{ $booking->id }}">

            <div class="row">

                {{-- ===== LEFT COLUMN ===== --}}
                <div class="col-lg-8">

                    {{-- Trip Details Card --}}
                    <div class="detail-card animate-in delay-1" id="trip-details-card">
                        <div class="card-header-custom">
                            <div class="header-icon icon-trip">
                                <i class="fal fa-route"></i>
                            </div>
                            <div>
                                <h5>Trip Details</h5>
                                <p class="header-subtitle">Pickup & return schedule</p>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="row m-0">
                                {{-- Timeline --}}
                                <div class="col-md-7 py-4 px-4">
                                    <div class="trip-timeline">
                                        <div class="timeline-point">
                                            <div class="timeline-label">Pickup</div>
                                            <div class="timeline-value">{{ $pickupLocation }}</div>
                                            <div class="timeline-sub">
                                                <i class="fal fa-calendar-day mr-1"></i>{{ $booking->check_in }}
                                                &nbsp;&bull;&nbsp;
                                                <i class="fal fa-clock mr-1"></i>{{ $booking->pickup_time }}
                                            </div>
                                        </div>
                                        <div class="timeline-point endpoint" style="margin-top: 24px;">
                                            <div class="timeline-label">Return</div>
                                            <div class="timeline-value">{{ $returnLocation }}</div>
                                            <div class="timeline-sub">
                                                <i class="fal fa-calendar-day mr-1"></i>{{ $booking->check_out }}
                                                &nbsp;&bull;&nbsp;
                                                <i class="fal fa-clock mr-1"></i>{{ $booking->return_time }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Duration --}}
                                <div class="col-md-5 d-flex align-items-center justify-content-center py-4 px-4">
                                    <div class="duration-badge">
                                        <span class="duration-number">{{ $booking->trip_duration }}</span>
                                        <span class="duration-text">Days</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Passenger Details Card --}}
                    <div class="detail-card animate-in delay-2" id="passenger-details-card">
                        <div class="card-header-custom">
                            <div class="header-icon icon-passenger">
                                <i class="fal fa-user"></i>
                            </div>
                            <div>
                                <h5>Passenger Details</h5>
                                <p class="header-subtitle">Personal information & documents</p>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="detail-row">
                                <div class="detail-label"><i class="fal fa-user"></i> Full Name</div>
                                <div class="detail-value">{{ $passenger->first_name }} {{ $passenger->last_name }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label"><i class="fal fa-phone"></i> Phone</div>
                                <div class="detail-value">{{ $passenger->phone_number }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label"><i class="fal fa-envelope"></i> Email</div>
                                <div class="detail-value">{{ $passenger->email }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label"><i class="fal fa-birthday-cake"></i> Age</div>
                                <div class="detail-value">{{ $passenger->age }} Years</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label"><i class="fal fa-globe"></i> Country</div>
                                <div class="detail-value">{{ $passenger->contry_of_residence }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label"><i class="fal fa-id-card"></i> Passport / NIC</div>
                                <div class="detail-value">
                                    <a href="{{ asset('storage/app/private/' . $passenger->passport_image) }}" target="_blank" class="doc-thumbnail-wrap">
                                        <img src="{{ asset('storage/app/private/' . $passenger->passport_image) }}" alt="Passport/NIC">
                                        <div class="overlay"><i class="fal fa-search-plus"></i></div>
                                    </a>
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label"><i class="fal fa-car"></i> Driving License</div>
                                <div class="detail-value">
                                    <a href="{{ asset('storage/app/private/' . $passenger->license_image) }}" target="_blank" class="doc-thumbnail-wrap">
                                        <img src="{{ asset('storage/app/private/' . $passenger->license_image) }}" alt="Driving License">
                                        <div class="overlay"><i class="fal fa-search-plus"></i></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Vehicle Details Card --}}
                    <div class="detail-card animate-in delay-3" id="vehicle-details-card">
                        <div class="card-header-custom">
                            <div class="header-icon icon-vehicle">
                                <i class="fal fa-shuttle-van"></i>
                            </div>
                            <div>
                                <h5>Requested Vehicle</h5>
                                <p class="header-subtitle">Vehicle assignment info</p>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="detail-row">
                                <div class="detail-label"><i class="fal fa-car-side"></i> Vehicle Type</div>
                                <div class="detail-value">
                                    <span style="background: #e8eaf6; color: #3949ab; padding: 4px 14px; border-radius: 50px; font-weight: 600; font-size: 0.85rem;">
                                        {{ $vehicle->vehicleType->name }}
                                    </span>
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label"><i class="fal fa-hashtag"></i> Vehicle Number</div>
                                <div class="detail-value" style="font-weight: 700; letter-spacing: 1px;">{{ $vehicle->vehicle_number }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label"><i class="fal fa-image"></i> Vehicle Image</div>
                                <div class="detail-value">
                                    <a href="{{ asset('storage/app/private/' . $vehicle->thumbnail) }}" target="_blank" class="doc-thumbnail-wrap">
                                        <img src="{{ asset('storage/app/private/' . $vehicle->thumbnail) }}" alt="Vehicle Image">
                                        <div class="overlay"><i class="fal fa-search-plus"></i></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Additional Services Card --}}
                    <div class="detail-card animate-in delay-4" id="services-card">
                        <div class="card-header-custom">
                            <div class="header-icon icon-services">
                                <i class="fal fa-concierge-bell"></i>
                            </div>
                            <div>
                                <h5>Requested Additional Services</h5>
                                <p class="header-subtitle">Extra services & add-ons</p>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                {{-- Driver --}}
                                <div class="col-md-6">
                                    <div class="service-item">
                                        <div class="service-name">
                                            <i class="fal fa-steering-wheel"></i> Driver
                                        </div>
                                        <div class="service-status">
                                            <span class="{{ $booking->driver_requesting == 'yes' ? 'badge-yes' : 'badge-no' }}">
                                                {{ $booking->driver_requesting == 'yes' ? 'Yes' : 'No' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                {{-- Driver Language --}}
                                <div class="col-md-6">
                                    <div class="service-item">
                                        <div class="service-name">
                                            <i class="fal fa-language"></i> Driver Language
                                        </div>
                                        <div class="service-status">
                                            <span style="color: #4a5568; font-weight: 600; font-size: 0.85rem;">
                                                {{ $booking->driver_first_lang }}{{ $booking->driver_second_lang != '' ? ' & ' . $booking->driver_second_lang : '' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                {{-- Instructor --}}
                                <div class="col-md-6">
                                    <div class="service-item">
                                        <div class="service-name">
                                            <i class="fal fa-chalkboard-teacher"></i> Instructor
                                        </div>
                                        <div class="service-status">
                                            <span class="{{ $booking->instructor_requesting == 'yes' ? 'badge-yes' : 'badge-no' }}">
                                                {{ $booking->instructor_requesting == 'yes' ? 'Yes' : 'No' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                {{-- Instructor Language --}}
                                <div class="col-md-6">
                                    <div class="service-item">
                                        <div class="service-name">
                                            <i class="fal fa-language"></i> Instructor Language
                                        </div>
                                        <div class="service-status">
                                            <span style="color: #4a5568; font-weight: 600; font-size: 0.85rem;">
                                                {{ $booking->instructor_first_lang }}{{ $booking->instructor_second_lang != '' ? ' & ' . $booking->instructor_second_lang : '' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                {{-- Guide --}}
                                <div class="col-md-6">
                                    <div class="service-item">
                                        <div class="service-name">
                                            <i class="fal fa-map-signs"></i> Guide
                                        </div>
                                        <div class="service-status">
                                            <span class="{{ $booking->guide_requesting == 'yes' ? 'badge-yes' : 'badge-no' }}">
                                                {{ $booking->guide_requesting == 'yes' ? 'Yes' : 'No' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                {{-- Guide Language --}}
                                <div class="col-md-6">
                                    <div class="service-item">
                                        <div class="service-name">
                                            <i class="fal fa-language"></i> Guide Language
                                        </div>
                                        <div class="service-status">
                                            <span style="color: #4a5568; font-weight: 600; font-size: 0.85rem;">
                                                {{ $booking->guide_first_lang }}{{ $booking->guide_second_lang != '' ? ' & ' . $booking->guide_second_lang : '' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                {{-- Temp Driving Permit --}}
                                <div class="col-md-6">
                                    <div class="service-item">
                                        <div class="service-name">
                                            <i class="fal fa-id-badge"></i> SL Driving Permit
                                        </div>
                                        <div class="service-status">
                                            <span class="{{ $booking->local_license == 'yes' ? 'badge-yes' : 'badge-no' }}">
                                                {{ $booking->local_license == 'yes' ? 'Yes' : 'No' }}
                                            </span>
                                            @if($booking->local_license == 'yes')
                                                <span class="badge-count">×{{ $booking->local_license_qty }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Additional Instructor Sessions --}}
                                <div class="col-md-6">
                                    <div class="service-item">
                                        <div class="service-name">
                                            <i class="fal fa-redo"></i> Extra Instructor Sessions
                                        </div>
                                        <div class="service-status">
                                            <span class="{{ $booking->instructor_additional_session == 'yes' ? 'badge-yes' : 'badge-no' }}">
                                                {{ $booking->instructor_additional_session == 'yes' ? 'Yes' : 'No' }}
                                            </span>
                                            @if($booking->instructor_additional_session == 'yes')
                                                <span class="badge-count">×{{ $booking->instructor_additional_session_qty }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Baby Seat --}}
                                <div class="col-md-6">
                                    <div class="service-item">
                                        <div class="service-name">
                                            <i class="fal fa-baby"></i> Baby Seat
                                        </div>
                                        <div class="service-status">
                                            <span class="{{ $booking->baby_seat == 'yes' ? 'badge-yes' : 'badge-no' }}">
                                                {{ $booking->baby_seat == 'yes' ? 'Yes' : 'No' }}
                                            </span>
                                            @if($booking->baby_seat == 'yes')
                                                <span class="badge-count">×{{ $booking->baby_seat_qty }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Bluetooth Speakers --}}
                                <div class="col-md-6">
                                    <div class="service-item">
                                        <div class="service-name">
                                            <i class="fal fa-bluetooth"></i> Bluetooth Speakers
                                        </div>
                                        <div class="service-status">
                                            <span class="{{ $booking->bluetooth_speakers == 'yes' ? 'badge-yes' : 'badge-no' }}">
                                                {{ $booking->bluetooth_speakers == 'yes' ? 'Yes' : 'No' }}
                                            </span>
                                            @if($booking->bluetooth_speakers == 'yes')
                                                <span class="badge-count">×{{ $booking->bluetooth_speakers_qty }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Seatbelts --}}
                                <div class="col-md-6">
                                    <div class="service-item">
                                        <div class="service-name">
                                            <i class="fal fa-shield-check"></i> Tuktuk With Seatbelts
                                        </div>
                                        <div class="service-status">
                                            <span class="{{ $booking->tuktuk_with_seatbelts == 'yes' ? 'badge-yes' : 'badge-no' }}">
                                                {{ $booking->tuktuk_with_seatbelts == 'yes' ? 'Yes' : 'No' }}
                                            </span>
                                            @if($booking->tuktuk_with_seatbelts == 'yes')
                                                <span class="badge-count">×{{ $booking->tuktuk_with_seatbelts_qty }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Cooler --}}
                                <div class="col-md-6">
                                    <div class="service-item">
                                        <div class="service-name">
                                            <i class="fal fa-snowflake"></i> Cooler
                                        </div>
                                        <div class="service-status">
                                            <span class="{{ $booking->cooler == 'yes' ? 'badge-yes' : 'badge-no' }}">
                                                {{ $booking->cooler == 'yes' ? 'Yes' : 'No' }}
                                            </span>
                                            @if($booking->cooler == 'yes')
                                                <span class="badge-count">×{{ $booking->cooler_qty }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ===== RIGHT COLUMN (Action Sidebar) ===== --}}
                <div class="col-lg-4">
                    <div class="detail-card action-section animate-in delay-5" id="action-panel" style="position: sticky; top: 20px;">
                        <div class="card-header-custom">
                            <div class="header-icon icon-action">
                                <i class="fal fa-bolt"></i>
                            </div>
                            <div>
                                <h5>Take Action</h5>
                                <p class="header-subtitle">Approve or reject this booking</p>
                            </div>
                        </div>
                        <div class="card-body-custom">

                            @if ($booking->driver_requesting == 'yes')
                                <div class="form-group mb-4">
                                    <label for="driver_id">
                                        <i class="fal fa-steering-wheel mr-1" style="color: #667eea;"></i>
                                        Assign Driver
                                    </label>
                                    <select class="form-control" id="driver_id" name="driver_id">
                                        <option value="">— Select Driver —</option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}">
                                                {{ $driver->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if ($booking->instructor_requesting == 'yes')
                                <div class="form-group mb-4">
                                    <label for="instructor_id">
                                        <i class="fal fa-chalkboard-teacher mr-1" style="color: #667eea;"></i>
                                        Assign Instructor
                                    </label>
                                    <select class="form-control" id="instructor_id" name="instructor_id">
                                        <option value="">— Select Instructor —</option>
                                        @foreach ($instructors as $instructor)
                                            <option value="{{ $instructor->id }}">
                                                {{ $instructor->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="form-group mb-4">
                                <label for="action">
                                    <i class="fal fa-gavel mr-1" style="color: #667eea;"></i>
                                    Action <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" id="action" name="action" required>
                                    <option value="">— Select Action —</option>
                                    <option value="Approve">✅ Approve Booking</option>
                                    <option value="Reject">❌ Reject Booking</option>
                                </select>
                            </div>

                            <hr style="border-color: #edf0f7;">

                            <button class="btn btn-submit-action btn-block" type="submit" id="submit-action-btn">
                                <i class="fal fa-paper-plane mr-2"></i>Submit Decision
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </main>
@stop

@section('footerScript')
    <script>
        $(document).ready(function() {
            // Initialize Parsley form validation
            $('#booking_action_form').parsley();

            // Animate elements on scroll (optional enhancement)
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.animate-in').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
@stop
