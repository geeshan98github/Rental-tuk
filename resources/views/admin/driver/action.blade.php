@extends('layouts.master')

@section('title', 'Action')

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
                <i class='subheader-icon fal fa-chart-area'></i>Action<span class='fw-300'></span>
            </h1>

            {{-- <div class="row" style="margin-left:auto; margin-right:auto; gap: 12px">
                @can('driver-applicant-list')
                    <a href=" {{ route('driver-applicant-list') }}">
                        <button type="button" class="btn btn-lg btn-primary">
                            <span class="fal fa-list mr-1"></span>
                            View All
                        </button>
                    </a>
                @endcan
            </div> --}}
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Action
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
                            <form action="{{ route('save-driver-action') }}" enctype="multipart/form-data" method="post"
                               class="smart-form row" autocomplete="off" >
                                @csrf
                                <div class="col-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="action">Select Action</label>
                                        <select class="form-control" id="action" name="action">
                                            <option value="Approve">Approve</option>
                                            <option value="Reject">Reject</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div
                                        class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row">
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button class="btn btn-primary ml-auto" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </main>
@stop

@section('footerScript')


@stop
