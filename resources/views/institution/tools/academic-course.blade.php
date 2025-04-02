@extends('layout.institution-master')
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
                    <h3 class="page-title">Academic Course</h3>
                    {{-- <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('auth/dashboard') !!}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Academic Course</li>
                    </ul> --}}
                </div>
                <div class="col-auto text-end float-end ms-auto">
                    <button class="btn btn-primary btn-sm addAcademiCourse"><i class="fas fa-plus"></i> New Add</button>
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
                                        <th>Academic Course</th>
                                        <th>Branch/Subject</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) > 0)
                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{!! $row->course_name !!}</td>
                                                <td>{!! $row->subject !!}</td>
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
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-success btn-sm bg-success-light editAcademiCourse"
                                                        data-id="{!! base64_encode($row->id) !!}" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" data-bs-title="Edit Academic Course">
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
                                                            <i class="ti ti-check"></i>
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

            <!-----------Modal---------------------------------->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel" data-simplebar="" style="width: 20%">
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Add Academic Year</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form method="post" id="academiCourseForm">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_id" />
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="text" class="form-control" name="course" required
                                    placeholder="Write Course name">
                            </div>
                            <div class="col-md-12 mb-3">
                                <input type="text" class="form-control" name="subject" required
                                    placeholder="Write Subject/Branch">
                            </div>
                            <div class="col-md-12 text-center mb-3">
                                <button type="submit" class="btn btn-outline-primary"><i class="ti-save"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @stop
        @section('scripts')
            <script type="text/javascript">
                /* Add */
                $(document).on("click", ".addAcademiCourse", function() {
                    $("#offcanvasExample form#subjectForm input[type='text']").val('');
                    $("#offcanvasExample input[name='_id']").val('');
                    $("#offcanvasExample h4.offcanvas-title").text("Add Academic Course");
                    $("#offcanvasExample").offcanvas("show");

                });

                /* Submit form */
                $(document).on("submit", "#academiCourseForm", function() {
                    let FormData = $("#academiCourseForm").serialize();
                    $.post("{!! url('institution/tools/academic-course') !!}", FormData, function(html) {
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

                /* Update */
                $(document).on("click", ".editAcademiCourse", function() {
                    let id = $(this).data('id');
                    $.confirm({
                        title: 'Confirm!',
                        content: 'Are you sure do you want edit this academic course ?',
                        buttons: {
                            confirm: {
                                text: 'Confirm',
                                btnClass: 'btn-blue',
                                keys: ['enter', 'shift'],
                                action: function() {
                                    $.post("{!! url('institution/get-single-data') !!}", {
                                        '_token': "{!! csrf_token() !!}",
                                        'where[id]': atob(id),
                                        'tab': 'academic_course'
                                    }, function(html) {
                                        let obj = $.parseJSON(html);
                                        if (obj.code == 200) {
                                            $("#offcanvasExample input[name='_id']").val(btoa(id));
                                            $("#offcanvasExample input[name='course']").val(obj.data[
                                                'course_name']);
                                            $("#offcanvasExample input[name='subject']").val(obj.data[
                                                'subject']);
                                            $("#offcanvasExample h4.offcanvas-title").text(
                                                "Update Academic Course");
                                            $("#offcanvasExample").offcanvas("show");
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

                /* update status */
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
                                        'tab': 'academic_course'
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
