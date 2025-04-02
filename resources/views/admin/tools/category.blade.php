@extends('layout.master')
@section('styles')

@stop
@section('content')
    <div class="content container">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All Institution Category</h3>
                </div>
                {{-- <div class="col-auto text-end float-end ms-auto">
                     <button class="btn btn-primary btn-sm addYear"><i class="fas fa-plus"></i>  Add New Courses</button>
                 </div>--}}
            </div>
        </div>
        <div class="row">


                <div class="col-sm-7">
                    <div class="card">
                        {{--                    <h4 class="text-center">{!! $cat->title !!}</h4>--}}
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0 datatable">
                                    <thead class="bg-success-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Category title</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (count($data) > 0)
                                        @foreach ($data as $key => $row)

                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{!! ucfirst($row->title) !!}</td>
                                                    <td>
                                                        @if ($row->is_active == '1')
                                                            <span class="badge fw-semibold py-1 w-85 bg-success text-white">Active</span>
                                                        @else
                                                            <span class="badge fw-semibold py-1 w-85 bg-danger text-white">NonActive</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="javascript:void(0)" class="btn btn-success btn-sm editYear" data-id="{!! base64_encode($row->id) !!}" data-title="{!! $row->title !!}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit Subject">
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
            <div class="col-sm-5">
                <div class="card">
                    <div class="bg-success-light p-2 ">
                        <h5 class="card-title">Add Institution Category</h5>
                    </div>
                    <div class="card-body p-3">
                        <form method="post" action="{!! url('admin/tools/add-category') !!}" enctype="application/x-www-form-urlencoded">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_id" />
                            <div class="row">
                                <div class="col-md-12 ">
                                    <label for="title">Course Title <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="title" required placeholder="Write Institution Category Ex. B.A etc.">
                                </div>
                                <div class="col-md-12 text-left">
                                    <label for="subject">&nbsp;</label><br>
                                    <button type="submit" class="btn btn-outline-primary"><i class="ti-save"></i> Create Course</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!------------Modal Popup --------------------->




            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                 aria-labelledby="offcanvasExampleLabel" data-simplebar="" style="width: 30%">
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Udate Institution Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form method="post" id="subjectForm">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_id" />
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label for="title">Academic Subject Title <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="title" required placeholder="Write Institution Category">
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
                            title = $(this).data('title');
                        $("#offcanvasExample input[name='_id']").val(id);
                        $("#offcanvasExample input[name='title']").val(title);
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
                                            'tab': 'institution_category'
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
