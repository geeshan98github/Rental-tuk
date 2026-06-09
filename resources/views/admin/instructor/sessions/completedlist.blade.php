@extends('layouts.master')

@section('title', 'Completed Driving Sessions')

@section('headerStyle')
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('public/back/css/datagrid/datatables/datatables.bundle.css') }}">

@stop

@section('content')
    <main id="js-page-content" role="main" class="page-content">

        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-chart-area'></i> Completed Driving Sessions <span class='fw-300'></span>
            </h1>

            <div class="row" style="margin-left:auto; margin-right:auto; gap: 12px">

                @can('new-booking-list')
                    <a href=" {{ route('new-booking-list') }}">
                        <button type="button" class="btn btn-lg btn-primary">
                            <span class="fal fa-list mr-1"></span>
                            View All
                        </button>
                    </a>
                @endcan
            </div>
        </div>
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

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                          Completed Driving Sessions
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Booking ID</th>
                                        <th>Pickup Location</th>
                                        <th>Start Date</th> 
                                        <th>Passenger Name</th>
                                        <th>Contact Number</th>
                                        <th>View</th>
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
                        url: "{{ route('completed-driving-session-list') }}", // or '/rooms.list' for testing
                        type: 'GET',
                        dataType: 'json', // Ensure the response type is json

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
                            data: 'trip_id',
                            name: 'trip_id',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'pickup',
                            name: 'pickup',
                            orderable: true,
                            searchable: true
                        },

                        {
                            data: 'check_in',
                            name: 'check_in',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'first_name',
                            name: 'first_name',
                            orderable: true,
                            searchable: true
                        },

                        {
                            data: 'phone_number',
                            name: 'phone_number',
                            orderable: false,
                            searchable: false
                        },

                         {
                            data: 'view',
                            name: 'view',
                            orderable: false,
                            searchable: false
                        },


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




            });
        });
    </script>
@stop
