@extends('layout.master')
@section('styles')
    <style>
        div:where(.swal2-icon) .swal2-icon-content {
            display: flex;
            align-items: center;
            font-size: 1.2em !important;
        }

        .swal2-popup .swal2-styled {
            margin: 0px 5px 0 !important;
            padding: 10px 32px;
        }
        .breadcrumb-item+.breadcrumb-item::before {
            float: left;
            padding-right: .5rem;
            color: #6c757d;
            content: var(--bs-breadcrumb-divider, "/");
        }

        .page-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .card-body {
            flex: 1 1 auto;
            padding: 0rem 0rem;
        }

        .table>thead {
            vertical-align: bottom;
            background: #18aefa;
            color: #fff;
        }

        .card-table .table td {
            padding: 0.30rem;
            font-size: 14px;
        }

        .card-table .table th {
            padding: .75rem;
        }

        .offcanvas h4 {
            font-size: 20px;
        }
        .nav-tabs .nav-link {
            border: none;
            font-weight: 600;
            color: #555;
            padding: 10px 20px;
            transition: all 0.3s ease-in-out;
            position: relative;
        }

        .nav-tabs .nav-link.active {
            color: #fff;
            background: #007bff;
            border-radius: 5px;
        }

        /* Hover Effect on Table Rows */
        .table-hover tbody tr:hover {
            background-color: #f8f9fa !important;
        }

        /* Table Styling */
        .table th {
            background: #007bff;
            color: #fff;
            text-transform: uppercase;
            padding: 12px;
        }

        .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        /* Buttons Styling */
        .btn-success, .btn-danger {
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 4px;
        }

        .btn-success {
            background: #28a745;
            border: none;
        }

        .btn-danger {
            background: #dc3545;
            border: none;
        }

        .btn-success:hover {
            background: #218838;
        }

        .btn-danger:hover {
            background: #c82333;
        }
    </style>
@stop
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Rejected Students</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0 datatable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>DOB</th>
                                    <th>Mobile Number</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($reg_rejected) > 0)
                                    @foreach ($reg_rejected as $key => $row)
                                        <tr>
                                            {{--                                                <td>{{ $key + 1 }}</td>--}}
                                            <td>{{ ($reg_rejected->currentPage() - 1) * $reg_rejected->perPage() + $key + 1 }}</td>
                                            <td>{!! ucfirst($row->name) . ' S/o Mr. ' . ucfirst($row->father_name) !!}</td>
                                            <td>{!! $row->email !!}</td>
                                            <td>{!! date('F d, Y', strtotime($row->dob)) !!}</td>
                                            <td>{!! $row->mobile !!}</td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="javascript:void(0);"
                                                       data-id="{{$row->id}}"
                                                       class="btn btn-sm text-white bg-success approve-btn">
                                                        Approved
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                       data-id="{{$row->id}}"
                                                       class="btn btn-sm bg-danger reject-btn text-white me-2">
                                                        Rejected
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            @if (count($reg_rejected) != 0)
                                <div class="p-2">
                                    {!! $reg_rejected->links('pagination::bootstrap-5') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.approve-btn').on('click', function() {
                let id = $(this).data('id');
                console.log(id);
                let url = "{{ url('admin/registration/approve-registration', '__ID__') }}".replace('__ID__', id);
                console.log(url);
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to approve this registration!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#28a745",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Approve it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: "POST",
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire("Approved!", response.message, "success").then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire("Error!", response.message, "error");
                                }
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", xhr.responseJSON.message || "Something went wrong.", "error");
                            }
                        });
                    }
                });
            });

            //reject
            $('.reject-btn').on('click', function() {
                let id = $(this).data('id');
                console.log(id);
                let url = "{{ url('admin/registration/reject-registration', '__ID__') }}".replace('__ID__', id);
                console.log(url);
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to reject this registration!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#28a745",
                    confirmButtonText: "Yes, Reject it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: "POST",
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire("Rejected!", response.message, "success").then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire("Error!", response.message, "error");
                                }
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", xhr.responseJSON.message || "Something went wrong.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>

@stop
