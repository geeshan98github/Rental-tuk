@extends('layouts.master')

@section('title', 'Flavors &amp; Editions - Documentation')

@section('content')
<main id="js-page-content" role="main" class="page-content">
    <!-- Page heading removed for composed layout -->
    <div class="alert alert-info m-0 p-0 border-left-0 border-right-0 rounded-0 px-5 py-2">
        <div class="container">
            <div class="px-3 d-flex pr-5">
                <strong>SmartAdmin Support Forum is a public support forum hosting on https://support.gotbootstrap.com</strong>
                <div class="ml-auto">
                    <a href="javascript:void(0);" class="btn btn-danger btn-xs btn-icon rounded-circle">
                        <i class="fal fa-times"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-grow-1 p-0 iframe-wrapper">
        <iframe src="https://support.gotbootstrap.com/" id="iframe" class="w-100 border-0 h-100" allowtransparency="true"></iframe>
    </div>
</main>
@stop

@section('footerScript')
<script type="text/javascript">
    initApp.pushSettings("layout-composed nav-function-fixed", false);
</script>
@stop