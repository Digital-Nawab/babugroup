@extends('layout.master')

@section('styles')
    <style>
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
    </style>
@stop

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Academic Years</h3>
                    {{-- <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('auth/dashboard') !!}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Academic Years</li>
                    </ul> --}}
                </div>
                <div class="col-auto text-end ms-auto">
                    <button class="btn btn-primary btn-sm addYear"><i class="fas fa-plus"></i> New Add</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (count($data) > 0)
                                <table class="table table-hover table-center mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Year</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $row->academic_year }}</td>
                                                <td>
                                                    @if ($row->is_active == '1')
                                                        <span
                                                            class="badge fw-semibold py-1 w-85 bg-success text-white">Active</span>
                                                    @else
                                                        <span class="badge fw-semibold py-1 w-85 bg-danger text-white">Non
                                                            Active</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <button class="btn btn-sm bg-success-light editYear me-2"
                                                            data-id="{{ base64_encode($row->id) }}"
                                                            data-year="{{ $row->academic_year }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" data-bs-title="Edit Year">
                                                            <i class="fa fa-edit"></i>
                                                        </button>

                                                        @if ($row->is_active == '1')
                                                            <button class="btn btn-danger btn-sm updateStatus"
                                                                data-id="{{ $row->id }}" data-status="2"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                data-bs-title="Non Active">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-primary btn-sm updateStatus"
                                                                data-id="{{ $row->id }}" data-status="1"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                data-bs-title="Active">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup Form for Add/Update -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasLabel">Add Academic Year</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form id="academicForm">
                    @csrf
                    <input type="hidden" name="_id" id="academic_id">
                    <div class="mb-3">
                        <label for="academic_year" class="form-label">Academic Year</label>
                        <input type="text" class="form-control" id="academic_year" name="academic_year" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" id="submitAcademicYear">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        /* Add Academic Year */
        $(document).on("click", ".addYear", function() {
            $("#offcanvasExample form#academicForm input[type='text']").val('');
            $("#offcanvasExample input[name='_id']").val('');
            $("#offcanvasExample h4.offcanvas-title").text("Add Academic Year");
            $("#offcanvasExample").offcanvas("show");

        });

        /* Academic Year submit form */
        $(document).on("submit", "#academicForm", function() {
            let FormData = $("#academicForm").serialize();
            $.post("{!! url('admin/tools/post-academic-year') !!}", FormData, function(html) {
                let obj = $.parseJSON(html);
                if (obj.code == 200) {
                    $.alert({
                        title: 'Success',
                        icon: 'ti ti-face-smile',
                        type: 'green',
                        content: obj.msg,
                    });
                    setInterval(function() {
                        location.reload()
                    }, 2000)
                } else {
                    $.alert({
                        title: 'Error',
                        icon: 'ti ti-alert',
                        type: 'orange',
                        content: obj.msg,
                    });
                }
            });
            return false;
        });

        /* update Academic Year */
        $(document).on("click", ".editYear", function() {
            let id = $(this).data('id'),
                year = $(this).data('year');
            $("#offcanvasExample input[name='_id']").val(id);
            $("#offcanvasExample input[name='academic_year']").val(year);
            $("#offcanvasExample h4.offcanvas-title").text("Update Academic Year");
            $("#offcanvasExample").offcanvas("show");
        });

        /* update status Academic Year */
        $(document).on("click", ".updateStatus", function() {
            let id = $(this).data('id'),
                status = $(this).data('status');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure do you want confirm this process ?',
                buttons: {
                    confirm: {
                        text: 'Confirm',
                        btnClass: 'btn-blue',
                        keys: ['enter', 'shift'],
                        action: function() {
                            $.post("{!! url('admin/single-update-data') !!}", {
                                '_token': "{!! csrf_token() !!}",
                                'where[id]': id,
                                'data[is_active]': status,
                                'tab': 'academic_year'
                            }, function(html) {
                                let obj = $.parseJSON(html);
                                if (obj.code == 200) {
                                    $.alert({
                                        title: 'Success',
                                        icon: 'ti ti-face-smile',
                                        type: 'green',
                                        content: obj.msg,
                                    });
                                    setInterval(function() {
                                        location.reload()
                                    }, 2000)
                                } else {
                                    $.alert({
                                        title: 'Error',
                                        icon: 'ti ti-alert',
                                        type: 'orange',
                                        content: obj.msg,
                                    });
                                }
                            });
                        }
                    },
                    cancel: {
                        text: 'Cancel',
                        btnClass: 'btn-danger',
                        action: function() {
                            $.alert("You clicked on canceled.");
                        }
                    }

                }
            });

        });
    </script>
@stop
