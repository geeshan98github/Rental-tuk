@extends('layouts.master')

@section('title', 'Logs List')

@section('headerStyle')
    <link rel="stylesheet" media="screen, print"
        href="{{ URL::asset('public/back/css/datagrid/datatables/datatables.bundle.css') }}">

@stop

@section('content')
    <main id="js-page-content" role="main" class="page-content">

        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-chart-area'></i> Log List <span class='fw-300'></span>
            </h1>

            {{-- <div class="row" style="margin-left:auto; margin-right:auto; gap: 12px">
                @can('testimonial-create')
                    <a href=" {{ route('testimonial-create') }}">
                        <button type="button" class="btn btn-lg btn-primary">
                            <span class="fal fa-plus mr-1"></span>
                            Add New
                        </button>
                    </a>
                @endcan
                @can('testimonial-list')
                    <a href=" {{ route('testimonial-list') }}">
                        <button type="button" class="btn btn-lg btn-primary">
                            <span class="fal fa-list mr-1"></span>
                            View All
                        </button>
                    </a>
                @endcan
            </div> --}}
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
                            Log List
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Subject</th>
                                        <th>Url</th>
                                        <th>Method</th>
                                        <th>Ip</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Time</th>
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
                        url: "{{ route('log-activity-list') }}", // or '/rooms.list' for testing
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
                            data: 'description',
                            name: 'description',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'url',
                            name: 'url',
                            orderable: true,
                            searchable: true
                        },

                        {
                            data: 'method',
                            name: 'method',
                            orderable: false,
                            searchable: false
                        },


                        {
                            data: 'ip',
                            name: 'ip',
                            orderable: false,
                            searchable: false
                        },

                        {
                            data: 'user_name',
                            name: 'user_name',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            orderable: false,
                            searchable: false
                        },

                        {
                            data: 'time',
                            name: 'time',
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


                // $("#dt-basic-example").on("click", '.btn-delete', function() {
                //     var id = $(this).val();
                //     Swal.fire({
                //         title: "Are you sure?",
                //         text: "You won't be able to revert this!",
                //         type: "warning",
                //         showCancelButton: true,
                //         confirmButtonText: "Yes, delete it!"
                //     }).then(function(result) {

                //         if (result.value == true) {
                //             // Swal.fire("Deleted!", "Your file has been deleted.", "success");
                //             window.location.replace(
                //                 "testimonial-delete/" + id);
                //         }
                //     });
                // }); 

            });
        });
    </script>
@stop
