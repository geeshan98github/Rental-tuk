@extends('layouts.master')

@section('title', 'City List')

@section('headerStyle')
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('public/back/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('public/back/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
@stop

@section('content')
    <main id="js-page-content" role="main" class="page-content">

        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-chart-area'></i>City List <span class='fw-300'></span>
            </h1>

            <div class="row" style="margin-left:auto; margin-right:auto; gap: 12px"">
                <a href=" {{ route('cities-create') }}">
                    <button type="button" class="btn btn-lg btn-primary">
                        <span class="mr-1 fal fa-plus"></span>
                        {{ __('Add New') }}
                    </button>
                </a>
                <a href=" {{ route('cities-list') }}">
                    <button type="button" class="btn btn-lg btn-primary">
                        <span class="mr-1 fal fa-list"></span>
                        {{ __('View All') }}
                    </button>
                </a>
            </div>
        </div>
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

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            {{ __('City List') }}
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('City Name') }}</th>
                                        <th>{{ __('Branch') }}</th>
                                        @can('cities-edit')
                                            <th>Edit</th>
                                        @endcan
                                        <th>Activation</th>
                                        @can('cities-delete')
                                            <th>Delete</th>
                                        @endcan
                                    </tr>

                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <!-- datatable end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@stop

@section('footerScript')
    <script src="{{ URL::asset('public/back/js/datagrid/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ URL::asset('public/back/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
    <script>
        /* demo scripts for change table color */
        /* change background */
        $(function() {
            $(document).ready(function() {
                var table = $('#dt-basic-example').dataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('cities-list') }}", // or '/user.list' for testing
                        type: 'GET',
                        dataType: 'json', // Ensure the response type is json
                        // headers: {
                        //     'X-Requested-With': 'XMLHttpRequest' // Ensure this header is set for AJAX
                        // },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    },
                    columnDefs: [{
                        "defaultContent": "-",
                        "targets": "_all"
                    }],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'branch_name',
                            name: 'branch_name'
                        },
                        {
                            data: 'edit',
                            name: 'edit',
                            orderable: false,
                            searchable: false
                        },

                        {
                            data: 'activation',
                            name: 'activation',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'cities-delete',
                            name: 'cities-delete',
                            orderable: false,
                            searchable: false
                        }

                    ],
                });

                $('.js-thead-colors a').on('click', function() {
                    var theadColor = $(this).attr("data-bg");
                    console.log(theadColor);
                    $('#dt-basic-example thead').removeClassPrefix('bg-').addClass(theadColor);
                });

                $('.js-tbody-colors a').on('click', function() {
                    var theadColor = $(this).attr("data-bg");
                    console.log(theadColor);
                    $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
                });

                $("#dt-basic-example").on("click", '.btn-delete', function() {
                    var id = $(this).val();
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, delete it!"
                    }).then(function(result) {

                        if (result.value == true) {
                            // Swal.fire("Deleted!", "Your file has been deleted.", "success");
                            window.location.replace(
                                "cities-delete/" + id);
                        }
                    });
                }); // ... and by passing a parameter, you can execute something else for "Cancel".

            });
        });
    </script>
@stop
