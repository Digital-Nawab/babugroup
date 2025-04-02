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
                    <h3 class="page-title">Academic Course Type</h3>
                    {{-- <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('auth/dashboard') !!}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Academic Course Type</li>
                    </ul> --}}
                </div>
                <div class="col-auto text-end float-end ms-auto">
                    <button class="btn btn-primary btn-sm addYear"><i class="fas fa-plus"></i> New Add</button>
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
                                        <th>#</th>
                                        <th>Course Type</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) > 0)
                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{!! $row->course_title !!}</td>
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
                                                    <a href="javascript:void(0)" class="btn btn-success btn-sm editYear"
                                                        data-id="{!! base64_encode($row->id) !!}"
                                                        data-year="{!! $row->course_title !!}" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" data-bs-title="Edit Course Type">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    @if ($row->is_active == '1')
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-danger btn-sm updateStatus"
                                                            data-id="{!! $row->id !!}" data-status="2"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            data-bs-title="Non Active">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-primary btn-sm updateStatus"
                                                            data-id="{!! $row->id !!}" data-status="1"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            data-bs-title="Active">
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!---------Modal popup--------------->

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel" data-simplebar="" style="width:30%">
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Add Academic Year</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form method="post" id="academicForm">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_id" />
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="course_title" required
                                    placeholder="Write Course Type : Ist Semester">
                                <span style="color:red">Write Course Type : Ist Semester</span>
                            </div>
                            <div class="col-md-12 text-center mt-4">
                                <button type="submit" class="btn btn-outline-primary"><i class="ti-save"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        /* Add Course Type */
        $(document).on("click", ".addYear", function() {
            $("#offcanvasExample form#academicForm input[type='text']").val('');  // Clear the input fields
            $("#offcanvasExample input[name='_id']").val(''); // Reset hidden ID field
            $("#offcanvasExample h4.offcanvas-title").text("Add Course Type"); // Update the title for add
            $("#offcanvasExample").offcanvas("show"); // Open the offcanvas
        });

        /* Academic Year submit form (Add and Update both) */
        $(document).on("submit", "#academicForm", function() {
            let FormData = $("#academicForm").serialize();
            $.post("{!! url('admin/tools/post-course-type') !!}", FormData, function(html) {
                let obj = $.parseJSON(html);
                if (obj.code == 200) {
                    $.alert({
                        title: 'Success',
                        icon: 'ti ti-face-smile',
                        type: 'green',
                        content: obj.msg,
                    });
                    setInterval(function() {
                        location.reload();
                    }, 2000);
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

        /* Edit Course Type (Populate form with existing data) */
        $(document).on("click", ".editYear", function() {
            let id = $(this).data('id'),
                year = $(this).data('year');
            $("#offcanvasExample input[name='_id']").val(id); // Set the hidden ID field
            $("#offcanvasExample input[name='course_title']").val(year); // Set the course title in the input field
            $("#offcanvasExample h4.offcanvas-title").text("Update Course Type"); // Change the title for update
            $("#offcanvasExample").offcanvas("show"); // Open the offcanvas
        });

        /* Update status for Course Type (Active/Non Active) */
        $(document).on("click", ".updateStatus", function() {
            let id = $(this).data('id'),
                status = $(this).data('status');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure you want to confirm this process?',
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
                                'tab': 'course_type'
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
                                        location.reload();
                                    }, 2000);
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
                            $.alert("You clicked on cancel.");
                        }
                    }
                }
            });
        });
    </script>
@stop
