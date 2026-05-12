@extends('layouts.master')

@section('title', 'Licensing - Documentation')

@section('content')
<main id="js-page-content" role="main" class="page-content">

    @component('common-components.breadcrumb')
    @slot('item1') Documentation @endslot
    @slot('item2') Licensing @endslot
    @endcomponent

    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-book'></i> Documentation: <span class='fw-300'>Build Notes</span>
            <small>
                Casing all release notes for your convenience
            </small>
        </h1>
    </div>
    <div class="card mb-g">
        <div class="card-body">
            <div class="alert alert-primary">
                <div class="d-flex flex-start w-100">
                    <div class="d-flex align-center mr-2 hidden-sm-down">
                        <span class="icon-stack icon-stack-lg">
                            <i class="base-7 icon-stack-3x color-primary-400"></i>
                            <i class="base-7 icon-stack-2x color-primary-600 opacity-70"></i>
                            <i class="fal fa-key icon-stack-1x text-white opacity-90"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-fill">
                        <div class="flex-fill">
                            <span class="h5">Get early access!</span>
                            <br> You can always find our latest build of on our private repository, allowing access to
                            nightly builds, bug fixes and feature requests. Please email us to see if we have any available seats left.
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="mb-g text-danger">Note: All the versions of Laravel SmartAdmin will be reflected in HTML versions. i.e. Laravel v4.4.5 will reflect HTML v4.4.5 only.</h3>
            <h4 class="mb-g">
                Build v 4.4.5
            </h4>
            <ul class="nav d-block fs-md pl-3">
                <li>
                    Initial release.
                </li>
            </ul>
        </div>
    </div>
    <div class="modal"></div>
</main>
@stop
