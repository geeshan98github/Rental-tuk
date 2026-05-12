@extends('layouts.master')

@section('title', 'Create Meta Tag')

@section('headerStyle')
<!-- Place favicon.ico in the root directory -->
<link rel="stylesheet" media="screen, print" href="{{ URL::asset('public/back/css/miscellaneous/reactions/reactions.css') }}">
<link rel="stylesheet" media="screen, print" href="{{ URL::asset('public/back/css/miscellaneous/fullcalendar/fullcalendar.bundle.css') }}">
<link rel="stylesheet" media="screen, print" href="{{ URL::asset('public/back/css/miscellaneous/jqvmap/jqvmap.bundle.css') }}">

@stop

@section('content')
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">

    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> {{ __('Meta Tags') }}<span class='fw-300'></span>
        </h1>

        <div class="row" style="margin-left:auto; margin-right:auto; gap: 12px">
            <a href="{{ route('meta-tags.create') }}">
                <button type="button" class="btn btn-lg btn-primary">
                    <span class="mr-1 fal fa-plus"></span>
                    {{ __('Add New') }}
                </button>
            </a>
            <a href="{{ route('meta-tags.list') }}">
                <button type="button" class="btn btn-lg btn-primary">
                    <span class="mr-1 fal fa-list-ul"></span>
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
                        {{ __('Create Meta Tag') }}
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
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
                        <form action="{{ route('meta-tags.store') }}" enctype="multipart/form-data" method="post" id="meta-tags-form" class="smart-form row" autocomplete="off" data-parsley-validate>
                            @csrf
                            <div class="mb-3 col-6">
                                <div class="form-group">
                                    <label class="form-label" for="page_name">{{ __('Page Name') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="page_name" name="page_name" class="form-control"  data-parsley-required="true" required>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <div class="form-group">
                                    <label class="form-label" for="page_title">{{ __('Page Title') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="page_title" name="page_title" class="form-control"  data-parsley-required="true" required>
                                </div>
                            </div>
                            <div class="mb-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="description">{{ __('Description') }} <span class="text-danger">*</span></label>
                                    <textarea id="description" name="description" rows="2" class="form-control" data-parsley-required="true" required></textarea>
                                </div>
                            </div>
                            <div class="mb-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="keywords">{{ __('Keywords') }} <span class="text-danger">*</span></label>
                                    <textarea id="keywords" name="keywords" rows="2" class="form-control" data-parsley-required="true" required></textarea>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <div class="form-group">
                                    <label class="form-label" for="og_title">{{ __('OG Title') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="og_title" name="og_title" class="form-control"  data-parsley-required="true" required>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <div class="form-group">
                                    <label class="form-label" for="og_type">{{ __('OG Type') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="og_type" name="og_type" class="form-control"  data-parsley-required="true" required>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <div class="form-group">
                                    <label class="form-label" for="og_url">{{ __('OG Url') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="og_url" name="og_url" class="form-control"  data-parsley-required="true" required>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <div class="form-group">
                                    <label class="form-label" for="og_sitename">{{ __('OG Sitename') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="og_sitename" name="og_sitename" class="form-control"  data-parsley-required="true" required>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <div class="form-group">
                                    <label class="form-label" for="og_email">{{ __('OG Email') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="og_email" name="og_email" class="form-control"  data-parsley-required="true" required>
                                </div>
                            </div>
                            <div class="mb-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="og_description">{{ __('OG Description') }} <span class="text-danger">*</span></label>
                                    <textarea id="og_description" name="og_description" rows="2" class="form-control" data-parsley-required="true" required></textarea>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <div class="form-group">
                                    <label class="form-label" for="og_image">{{ __('OG Image') }}<span class="text-danger">*</span></label>
                                    <input type="file" id="og_image" name="og_image" class="form-control"  data-parsley-required="true" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="flex-row panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex">
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
    $(document).ready(function () {
        // Initialize Parsley
        $('#meta-tags-form').parsley();
    });

</script>
@stop

