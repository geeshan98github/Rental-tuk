@extends('layouts.master')

@section('title', 'Availability Calendar')

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

        /* ===== Calendar Page Custom Styles ===== */

        .calendar-header-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 28px 32px;
            color: #fff;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        }

        .calendar-header-banner::before {
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

        .calendar-header-banner::after {
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

        .calendar-header-banner .calendar-badge {
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

        .calendar-header-banner h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 12px 0 4px;
        }

        .calendar-header-banner .header-meta {
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

        .icon-calendar { background: linear-gradient(135deg, #667eea, #764ba2); }

        /* Form Styles */
        .calendar-form-body {
            padding: 28px;
        }

        /* Day Option Cards */
        .day-options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .day-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 18px 10px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.25s ease;
            background: #fff;
            position: relative;
            text-align: center;
            margin-bottom: 0;
        }

        .day-option:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .day-option input[type="checkbox"] {
            display: none;
        }

        .day-option.selected {
            border-color: #667eea;
            background: linear-gradient(135deg, #f0f0ff, #e8eaff);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.15);
        }

        .day-option .day-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0aec0;
            font-size: 1.2rem;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .day-option.selected .day-icon {
            background: #667eea;
            color: #fff;
        }

        .day-option .day-text {
            font-weight: 700;
            font-size: 0.95rem;
            color: #4a5568;
            margin-bottom: 2px;
        }

        .day-option.selected .day-text {
            color: #2d3748;
        }
        
        .select-all-wrapper {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px dashed #e2e8f0;
            display: flex;
            align-items: center;
        }

        .custom-control-label {
            font-weight: 600;
            color: #4a5568;
            cursor: pointer;
        }

        /* Submit Button */
        .btn-submit-calendar {
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

        .btn-submit-calendar:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(102, 126, 234, 0.45);
            color: #fff;
        }

        .btn-submit-calendar:active {
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

        /* Responsive */
        @media (max-width: 768px) {
            .calendar-header-banner {
                padding: 20px;
            }

            .calendar-form-body {
                padding: 20px;
            }
            
            .day-options-grid {
                grid-template-columns: repeat(2, 1fr);
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
        <div class="calendar-header-banner animate-in" id="calendar-banner">
            <div class="d-flex justify-content-between align-items-start flex-wrap" style="gap: 16px;">
                <div>
                    <span class="calendar-badge">
                        <i class="fal fa-calendar-alt mr-1"></i>Driver Settings
                    </span>
                    <h2><i class="fal fa-clock mr-2"></i>Availability Calendar</h2>
                    <p class="header-meta mb-0">
                        <i class="fal fa-info-circle mr-1"></i>Manage driver availability across the week
                    </p>
                </div>
            </div>
        </div>

        {{-- ===== Calendar Form Card ===== --}}
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="detail-card animate-in delay-1" id="calendar-form-card">
                    <div class="card-header-custom">
                        <div class="header-icon icon-calendar">
                            <i class="fal fa-calendar-check"></i>
                        </div>
                        <div>
                            <h5>Select Available Days</h5>
                            <p class="header-subtitle">Choose the days when the driver is available for rides</p>
                        </div>
                    </div>
                    
                    <div class="calendar-form-body">
                        <form action="{{ route('save-driver-availability-calendar') }}" method="POST">
                            @csrf

                            <div class="select-all-wrapper">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="selectAll">
                                    <label class="custom-control-label" for="selectAll">Select / Deselect All Days</label>
                                </div>
                            </div>

                            <div class="day-options-grid">
                                @php
                                    $days = [
                                        'Monday' => 'fal fa-calendar-day',
                                        'Tuesday' => 'fal fa-calendar-day',
                                        'Wednesday' => 'fal fa-calendar-day',
                                        'Thursday' => 'fal fa-calendar-day',
                                        'Friday' => 'fal fa-calendar-day',
                                        'Saturday' => 'fal fa-calendar-star',
                                        'Sunday' => 'fal fa-calendar-star',
                                    ];

                                    $availableDays = $data->available_days ?? [];
                                @endphp

                                @foreach ($days as $day => $icon)
                                    @php 
                                        $id = strtolower($day); 
                                        $isChecked = in_array($id, $availableDays);
                                    @endphp
                                    
                                    <label class="day-option {{ $isChecked ? 'selected' : '' }}" id="label-{{ $id }}">
                                        <input type="checkbox" class="day-check" name="days[]" value="{{ $id }}" 
                                            id="chk-{{ $id }}" {{ $isChecked ? 'checked' : '' }} onchange="toggleDaySelection('{{ $id }}')">
                                        <div class="day-icon">
                                            <i class="{{ $icon }}"></i>
                                        </div>
                                        <div class="day-text">{{ substr($day, 0, 3) }}</div>
                                        <div class="small text-muted" style="font-size: 0.7rem;">{{ $day }}</div>
                                    </label>
                                @endforeach
                            </div>

                            {{-- Submit --}}
                            <div class="d-flex justify-content-end pt-3 mt-3" style="border-top: 1px solid #f0f0f5;">
                                <button class="btn btn-submit-calendar" type="submit">
                                    <i class="fal fa-save mr-2"></i>Save Availability
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
        function toggleDaySelection(id) {
            const checkbox = document.getElementById('chk-' + id);
            const label = document.getElementById('label-' + id);
            
            if (checkbox.checked) {
                label.classList.add('selected');
            } else {
                label.classList.remove('selected');
            }
            
            checkSelectAllState();
        }

        function checkSelectAllState() {
            const allCheckboxes = document.querySelectorAll('.day-check');
            const checkedCheckboxes = document.querySelectorAll('.day-check:checked');
            const selectAllCheckbox = document.getElementById('selectAll');
            
            selectAllCheckbox.checked = allCheckboxes.length > 0 && allCheckboxes.length === checkedCheckboxes.length;
        }

        document.getElementById('selectAll').addEventListener('change', function() {
            const isChecked = this.checked;
            
            document.querySelectorAll('.day-check').forEach(cb => {
                cb.checked = isChecked;
                const id = cb.id.replace('chk-', '');
                const label = document.getElementById('label-' + id);
                
                if (isChecked) {
                    label.classList.add('selected');
                } else {
                    label.classList.remove('selected');
                }
            });
        });
        
        // Initial check for 'Select All' state
        document.addEventListener('DOMContentLoaded', function() {
            checkSelectAllState();
        });
    </script>
@stop
