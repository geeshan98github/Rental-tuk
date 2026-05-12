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
    </style>
@stop

@section('content')
    <!-- the #js-page-content id is needed for some plugins to initialize -->
    <main id="js-page-content" role="main" class="page-content">

        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-chart-area'></i>Applicant<span class='fw-300'></span>
            </h1>

            <div class="row" style="margin-left:auto; margin-right:auto; gap: 12px">
                @can('driver-applicant-list')
                    <a href=" {{ route('driver-applicant-list') }}">
                        <button type="button" class="btn btn-lg btn-primary">
                            <span class="fal fa-list mr-1"></span>
                            View All
                        </button>
                    </a>
                @endcan
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            View Applicant
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
                            <div class="widget-body no-padding">
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="width:100% ;  border-style: hidden">
                                        <tbody style=" border-style: hidden">
                                            <tr style=" border-style: hidden">
                                                <td style="width: 20%;">First Name</td>
                                                <td style=" border-style: hidden">:&nbsp; {{ $data->first_name }}</td>
                                            </tr>
                                            <tr style=" border-style: hidden">
                                                <td style="width: 20%;">Last Name</td>
                                                <td style=" border-style: hidden">:&nbsp; {{ $data->last_name }}</td>
                                            </tr>

                                            <tr style=" border-style: hidden">
                                                <td style=" border-style: hidden">Email</td>
                                                <td style=" border-style: hidden">:&nbsp; {{ $data->email }}</td>
                                            </tr>
                                            <tr style=" border-style: hidden">
                                                <td style=" border-style: hidden">Phone No</td>
                                                <td style=" border-style: hidden">:&nbsp; {{ $data->phone_number }}</td>
                                            </tr>
                                            <tr style=" border-style: hidden">
                                                <td style=" border-style: hidden">Address</td>
                                                <td style=" border-style: hidden">:&nbsp; {{ $data->address }}</td>
                                            </tr>

                                            <tr style=" border-style: hidden">
                                                <td style=" border-style: hidden">Licence No</td>
                                                <td style=" border-style: hidden">:&nbsp; {{ $data->license_number }}</td>
                                            </tr>
                                            <tr style=" border-style: hidden">
                                                <td style=" border-style: hidden">Years of Experience</td>
                                                <td style=" border-style: hidden">:&nbsp; {{ $data->year_of_experience }}
                                                </td>
                                            </tr>
                                            <tr style=" border-style: hidden">
                                                <td style=" border-style: hidden">Tuk Tuk Register No</td>
                                                <td style=" border-style: hidden">:&nbsp; {{ $data->vehical_reg_number }}
                                                </td>
                                            </tr>
                                            <tr style=" border-style: hidden">
                                                <td style=" border-style: hidden">Languages</td>
                                                @php

                                                    $languages = explode(',', $data->spoken_languages);

                                                @endphp
                                                <td style=" border-style: hidden">:&nbsp; {{ implode(', ', $languages) }}
                                                </td>
                                            </tr>
                                            <tr style="border-style: hidden">
                                                <td style="border-style: hidden">Driver's License </td>
                                                <td style="border-style: hidden">
                                                    <a href="{{ asset('storage/app/private/' . $data->license_image) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/app/private/' . $data->license_image) }}"
                                                            width="100px" height="100px" alt=""
                                                            style="cursor: pointer;">
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr style="border-style: hidden">
                                                <td style="border-style: hidden">Police Clearance </td>
                                                <td style="border-style: hidden">
                                                    <a href="{{ asset('storage/app/private/' . $data->police_report) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/app/private/' . $data->police_report) }}"
                                                            width="100px" height="100px" alt=""
                                                            style="cursor: pointer;">
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br><br>
                                </div>
                                @can('send-approvel-driver-applicant')
                                    <div class="col-12">
                                    <form action="{{ route('send-driver-approvel') }}" method="POST">
                                        @csrf
                                    <div
                                        class="flex-row panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <button class="ml-auto btn btn-primary" type="submit">Send to Approval</button>
                                    </div>
                                    </form>
                                </div>
                                @endcan
                                 @can('action-driver-applicant')
                                    <div class="col-12">
                                    <form action="{{ route('action-driver-approvel') }}" method="POST">
                                        @csrf
                                    <div
                                        class="flex-row panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <button class="ml-auto btn btn-primary" type="submit">Action</button>
                                    </div>
                                    </form>
                                </div>
                                @endcan
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop

@section('footerScript')


@stop
