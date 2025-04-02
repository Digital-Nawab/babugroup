@extends('layout.master')
@section('styles')

@stop
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All  Courses</h3>
                </div>
               {{-- <div class="col-auto text-end float-end ms-auto">
                    <button class="btn btn-primary btn-sm addYear"><i class="fas fa-plus"></i>  Add New Courses</button>
                </div>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="bg-success-light p-2 ">
                        <h5 class="card-title">Add Courses</h5>
                    </div>
                    <div class="card-body p-3">
                        <form method="post" action="{!! url('admin/tools/add-course') !!}" enctype="application/x-www-form-urlencoded">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="title">Course Title <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="title" required placeholder="Write academic Course Ex. B.A etc.">
                                </div>
                                <div class="col-md-2 ">
                                    <label for="title">Course Semester <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="semesters" required placeholder="  Semester in number">
                                </div>
                                <div class="col-md-4 ">
                                    <label for="subject">Institution Category <span style="color: red">*</span></label>
                                    <select class="form-control select2" name="category_id" required>
                                        <option value="">Select Institution Category</option>
                                        @if (count($category) != 0)
                                            @foreach ($category as $key => $row)
                                                <option value="{!! $row->id !!}">{!! $row->title !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-2 text-left">
                                    <label for="subject">&nbsp;</label><br>
                                    <button type="submit" class="btn btn-outline-primary"><i class="ti-save"></i> Create Course</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!------------Modal Popup --------------------->
            @foreach($category as $cat)
            <div class="col-sm-6">
                <div class="card">
{{--                    <h4 class="text-center">{!! $cat->title !!}</h4>--}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0 datatable">
                                <thead class="bg-success-light">
                                <tr>
                                    <th>#</th>
                                    <th>Course Name</th>
                                    <th>Category For</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($data) > 0)
                                    @foreach ($data as $key => $row)
                                        @php
                                            $categoryTitle = optional($category->firstWhere('id', $row->category_id))->title ?? 'Unknown';
                                        @endphp
                                        @if($cat->id == $row->category_id )
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{!! ucfirst($row->title) !!}  <span class="badge fw-semibold py-1 w-85 bg-light text-info">{!! $row->semesters !!} Sem.</span> </td>
                                                <td>{!! ucfirst($categoryTitle) !!}</td>
                                                <td>
                                                    @if ($row->is_active == '1')
                                                        <span class="badge fw-semibold py-1 w-85 bg-success text-white">Active</span>
                                                    @else
                                                        <span class="badge fw-semibold py-1 w-85 bg-danger text-white">NonActive</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm editYear" data-id="{!! base64_encode($row->id) !!}" data-year="{!! $row->title !!}" data-semester="{!! $row->semesters !!}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit Subject">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @if ($row->is_active == '1')
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm updateStatus"
                                                           data-id="{!! $row->id !!}" data-status="2"
                                                           data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                           data-bs-title="Non Active">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm updateStatus"
                                                           data-id="{!! $row->id !!}" data-status="1"
                                                           data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                           data-bs-title="Active">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            @if (count($data) != 0)
                                <div class="p-2">
                                    {!! $data->links('pagination::bootstrap-5') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach



            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                 aria-labelledby="offcanvasExampleLabel" data-simplebar="" style="width: 30%">
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Add Subject</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form method="post" id="subjectForm">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_id" />
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label for="title">Academic Subject Title <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="title" required placeholder="Write academic Course Ex. B.A etc.">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="title">Academic Total Semesters <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="semesters" required placeholder="Write academic semesters Ex.4, 5, 6 etc.">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="subject">Institution Category <span style="color: red">*</span></label>
                                <select class="form-control select2" name="category_id" required>
                                    <option value="">Select Institution</option>
                                    @if (count($category) != 0)
                                        @foreach ($category as $key => $row)
                                            <option value="{!! $row->id !!}">{!! $row->title !!}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-12 text-center mt-4">
                                <button type="submit" class="btn btn-outline-primary"><i class="ti-save"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @stop

            @section('scripts')
                <script type="text/javascript">

                    /* update Academic Year */
                    $(document).on("click", ".editYear", function() {
                        let id = $(this).data('id'),
                            year = $(this).data('year'),
                            semester = $(this).data('semester');
                        $("#offcanvasExample input[name='_id']").val(id);
                        $("#offcanvasExample input[name='title']").val(year);
                        $("#offcanvasExample input[name='semesters']").val(semester);
                        $("#offcanvasExample h4.offcanvas-title").text("Update Course Name");
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
                                            'tab': 'subject_list'
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
