@extends('layouts.master')

@section('title', 'Create Roles')

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
            <i class='subheader-icon fal fa-chart-area'></i> Roles <span class='fw-300'></span>
        </h1>

        <div class="row" style="margin-left:auto; margin-right:auto; gap: 12px"">
            <a href=" {{ route('role-create') }}">
            <button type="button" class="btn btn-lg btn-primary">
                <span class="mr-1 fal fa-plus"></span>
                Add New
            </button>
            </a>
            <a href=" {{ route('role-list') }}">
            <button type="button" class="btn btn-lg btn-primary">
                <span class="mr-1 fal fa-list"></span>
                View All
            </button>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Create <span class="fw-300"><i>role</i></span>
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
                        <form action="{{ route('save-role') }}" enctype="multipart/form-data" method="post" id="role-form" class="smart-form row" autocomplete="off" data-parsley-validate>
                            @csrf
                            <div class="mb-3 col-6">
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Role Name</label>
                                    <input type="text" id="simpleinput" name="name" class="form-control"  data-parsley-required="true" required>
                                </div>
                            </div>

                            <div class="mb-3 col-6">
                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">User Manual</label>
                                    <input type="file" id="example-fileinput" class="form-control-file" name="user_manual">
                                </div>
                            </div>

                            <div class="col-lg-12 col-xl-12">
                                <!--Basic tables-->
                                <div class="panel-container show">
                                    <div class="panel-content">

                                        @foreach($dynamicMenu as $menu)
                                        @if($menu->is_parent == 1)
                                        <h5 class="frame-heading">
                                            {{ $menu->title }}
                                        </h5>
                                        @endif
                                        @if($menu->parent_id != 0)
                                        <div class="frame-wrap">
                                            <table class="table m-0">
                                                <tbody>
                                                    @if($menu->parent_id != 0)
                                                    <tr>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;{{ $menu->title }} <input type="hidden" name="formid[]" value="1">
                                                    </tr>
                                                    @endif
                                                    @if($menu->is_parent == 0 || $menu->child_order != 0)
                                                        @foreach($permission as $value)
                                                            @if($value->dynamic_menu_id==$menu->id)
                                                            <tr>
                                                                <td style="display: flex">
                                                                    <div class="panel-toolbar">
                                                                        <div class="custom-control d-flex custom-switch">
                                                                            <input id="eventlog-switch-{{ $value->id }}" type="checkbox" class="custom-control-input" name="permission[]" value="{{ $value->name }}">
                                                                            <label class="custom-control-label fw-500" for="eventlog-switch-{{ $value->id }}"></label>
                                                                        </div>
                                                                    </div>
                                                                    {{ $value->name }}
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
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
<x-slot name="script">

<script>
    $(document).ready(function () {
        $('#role-form').parsley();
    });
</script>
</x-slot>

