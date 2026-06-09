@extends('layouts.master')

@section('title', 'Edit Branch')

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
                <i class='subheader-icon fal fa-chart-area'></i> {{ __('Edit Branch') }}<span class='fw-300'></span>
            </h1>

            <div class="row" style="margin-left:auto; margin-right:auto; gap: 12px">
                <a href=" {{ route('branches-create') }}">
                    <button type="button" class="btn btn-lg btn-primary">
                        <span class="mr-1 fal fa-plus"></span>
                        {{ __('Add New') }}
                    </button>
                </a>
                <a href=" {{ route('branches-list') }}">
                    <button type="button" class="btn btn-lg btn-primary">
                        <span class="mr-1 fal fa-list"></span>
                        {{ __('View All') }}
                    </button>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            {{ __('Edit Branch') }}
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
                            <form action="{{ route('update-branches') }}" enctype="multipart/form-data" method="post"
                                id="branches-form" class="smart-form row" autocomplete="off" data-parsley-validate>
                                @csrf
                                @method('PUT')
                                <div class="mb-3 col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Branch Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            data-parsley-required="true" required value="{{ $data->name }}">
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="status">Status
                                            <span style=" color: red;">*</span></label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Y" {{ $data->status == 'Y' ? 'selected' : '' }}>
                                                Active </option>
                                            <option value="N" {{ $data->status == 'N' ? 'selected' : '' }}>
                                                Inactive </option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="id" value="{{ $data->id }}">

                                <div class="col-12">
                                    <div
                                        class="flex-row panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex">
                                        <button class="ml-auto btn btn-primary" type="submit">{{ __('Submit') }}</button>
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
            $('#branches-form').parsley();
        });
    </script>
@stop
