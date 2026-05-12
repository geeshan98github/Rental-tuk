@extends('layouts.master')

@section('title', 'General Docs - Documentation')

@section('headerStyle')
    <link rel="stylesheet" media="screen, print" href="{{ URL::asset('css/theme-demo.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ URL::asset('css/fa-duotone.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ URL::asset('css/fa-brands.css') }}">
@stop

@section('content')
<main id="js-page-content" role="main" class="page-content">

    <ol class="breadcrumb page-breadcrumb">
     <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
     <li class="breadcrumb-item">Documentation</li>
          <li class="breadcrumb-item active">General Docs</li>
               <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date">Wednesday, September 23, 2020</span></li>
 </ol>    <div class="subheader">
        <h1 class="subheader-title">
            <i class="subheader-icon fal fa-book"></i> Documentation: <span class="fw-300">General Docs</span>
            <small>
                Product documentation, plugin reference, and online help
            </small>
        </h1>
    </div>

    <div class="alert alert-danger alert-dismissible p-2 mb-4">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">
	            <i class="fal fa-times"></i>
	        </span>
	    </button>
	    <div class="d-flex flex-start w-100">
	        <div class="mr-2 hidden-sm-down">
	            <span class="icon-stack icon-stack-lg">
	                <i class="base-14 icon-stack-3x color-primary-400"></i>
	                <i class="base-14 icon-stack-2x color-primary-600 opacity-70"></i>
	                <i class="fal fa-newspaper icon-stack-1x text-white opacity-90"></i>
	            </span>
	        </div>
	        <div class="d-flex flex-fill align-items-center">
	            <div class="flex-fill">
	                <span class="h5">To access the full documentation, instructions and/or tutorials please purchase the SmartAdmin Laravel <strong>Full</strong> edition on WrapBootstrap: <a href="#" rel="nofollow" class="active">SmartAdmin Laravel</a>.</span>
	            </div>
	        </div>
	    </div>
	</div>

</main>
@stop

@section('footerScript') <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
<script>
    $(document).ready(function() {
        var jsdisplay = $('#js-display');
        var url = "/media/data/plugin-reference.json";

        $.getJSON(url, function(data) {
            $.each(data, function(index, value) {
                $('.js-plugins').append('<option value="' + value.plugin + '" data-description="' + value.description + '" data-url="' + value.url + '" data-license="' + value.license + '">' + value.plugin + '</option>');
            });
        });

        // SHOW SELECTED VALUE.
        $('.js-plugins').change(function() {
            var plugin = this.options[this.selectedIndex].text;
            var url = $('select.js-plugins').find(':selected').data('url');
            var license = $('select.js-plugins').find(':selected').data('license');
            var description = $('select.js-plugins').find(':selected').data('description');

            jsdisplay.removeClass().addClass('d-block')

            $('.js-plugin-name').text(plugin);
            $('.js-plugin-url').text(url);
            $('.js-plugin-url').attr('href', url);
            $('.js-plugin-license').text(license);
            $('.js-plugin-description').text(description);
        });
    });
</script>
@stop
