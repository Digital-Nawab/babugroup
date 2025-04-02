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
                                        <th>Institution</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) > 0)
                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{!! $row->course !!} {!! $row->semesters !!} Semester <span class="badge fw-semibold py-1 w-85 bg-success text-white">₹{!! $row->fee !!}</span></td>
{{--                                                <td>{!! $row->subject !!}</td>--}}
                                                <td>{!! $row->institution_name . ' - ' . $row->institution_id !!}</td>
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
           <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" data-simplebar="" style="width: 40%">

            <div class="offcanvas-body">
                <div class="mb-3 p-3 rounded-2 bg-dark">
                    <div class="row">
                        <div class="col-8">
                            <h5 style="color: #fee48d">Academic Course</h5>
                            <p class="mb-3 card-subtitle" style="color: aliceblue">
                                Upload & Add Academic Course
                            </p>
                        </div>
                        <div class="col-4">
                            <button type="button" style="float: right" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                    </div>
                    <ul class="nav nav-underline" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="active-tab"  style="color:aliceblue"  data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-expanded="true" aria-selected="true">
                                <span>Add Academic Course</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="link1-tab" style="color:aliceblue" data-bs-toggle="tab" href="#link1" role="tab" aria-controls="link1" aria-selected="false" tabindex="-1">
                                <span>Upload Academic Course</span>
                            </a>
                        </li>
    
                    </ul>
                    <div class="tab-content tabcontent-border p-3" id="myTabContent">
    
                        <div role="tabpanel" class="tab-pane fade active show" id="active" aria-labelledby="active-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" id="academiCourseForm">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_id" />
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <input type="text" class="form-control" name="course" required placeholder="Write Course name">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <input type="text" class="form-control" name="subject" required placeholder="Write Subject/Branch">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <select  class="form-control" style="color: #FFFFFF; background-color: #6c757d"  name="institution_id" required>
                                                    <option value="">Select Institution</option>
                                                    @if(count($institution) !=0)
                                                        @foreach($institution as $row)
                                                            <option value="{!! $row->id !!}">{!! $row->institution_name.' - '.$row->institution_id !!}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-12 text-center mb-3">
                                                <button type="submit" class="btn btn-outline-primary"><i class="ti-save"></i> Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="link1" role="tabpanel" aria-labelledby="link1-tab">
                            <form class="space-y-5" method="post" action="{!! url('admin/tools/upload-academic-course') !!}" id="uploadAcademicourse" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_id" value="">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="ctnUsername" class="mb-2" style="color: #fee48d">Excel File  <span style="color: red">*</span></label><br/>
                                        <div>
                                            <img src="data:image/png;base64,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" alt="" id="image_preview" class="rounded-circle mb-3" width="150" height="150">
                                            <input type="file" name="excel" style="display: none;" data-targetid="image_preview" id="cservice_image" />
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    </div>
                                </div>
    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @stop
        @section('scripts')
            <script type="text/javascript">
                /* Add */
                $(document).on("click", ".addAcademiCourse", function() {
                    $("#offcanvasExample form#academiCourseForm input[type='text']").val('');
                    $("#offcanvasExample input[name='_id']").val('');
                    $("#offcanvasExample select").val('');
                    $("#offcanvasExample h4.offcanvas-title").text("Add Academic Course");
                    $("#offcanvasExample").offcanvas("show");

                });

                /* Submit form */
                $(document).on("submit", "#academiCourseForm", function() {
                    let FormData = $("#academiCourseForm").serialize();
                    $.post("{!! url('admin/tools/academic-course') !!}", FormData, function(html) {
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
                                    $.post("{!! url('admin/get-single-data') !!}", {
                                        '_token': "{!! csrf_token() !!}",
                                        'where[id]': atob(id),
                                        'tab': 'academic_course'
                                    }, function(html) {
                                        let obj = $.parseJSON(html);
                                        if (obj.code == 200) {
                                            $("#offcanvasExample input[name='_id']").val(id);
                                            $("#offcanvasExample input[name='course']").val(obj.data[
                                                'course_name']);
                                            $("#offcanvasExample input[name='subject']").val(obj.data[
                                                'subject']);
                                            $("#offcanvasExample select[name='institution_id']").val(obj
                                                .data['institution_id']);
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
                $(document).on("click", '#image_preview', function() {
                    //var targetid = $(this).attr('data-targetid');
                    $(this).siblings('input[type="file"]').trigger('click');
                });
            </script>
        @stop
