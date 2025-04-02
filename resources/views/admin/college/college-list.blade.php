@extends('layout.master')
@section('styles')
@stop
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Colleges List</h3>
                    {{-- <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('auth/dashboard') !!}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Colleges List</li>
                    </ul> --}}
                </div>
                <div class="col-auto text-end float-end ms-auto">
                    <a href="{{url('admin/college/add-college')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New</a>
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
                                        <th>College Name</th>
{{--                                        <th>College Address</th>--}}
                                        <th>Status</th>
                                        <th>Admission </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($college_list) != 0)
                                        @foreach ($college_list as $key => $row)

                                            @php
                                                $categoryTitle = optional($category->firstWhere('id', $row->category_id))->title ?? 'Unknown';

                                            @endphp
                                            <tr>
                                                <td>{!! $key + 1 !!}.</td>
                                                <td>{!! $row->institution_name !!} <span class="badge fw-semibold py-1 w-85 {!! $row->category_id == '1' ? 'bg-info' : ($row->category_id == '2' ? 'bg-success' : 'bg-dark') !!}  ">{!! $categoryTitle  !!}</span></td>
{{--                                                <td>{!! $row->institution_address !!}</td>--}}
                                                <td>
                                                    @switch($row->is_active)
                                                        @case('1')
                                                            <span class="badge fw-semibold py-1 w-85 bg-success ">Active</span>
                                                        @break

                                                        @case('2')
                                                            <span class="badge fw-semibold py-1 w-85 bg-danger">Not Active</span>
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <a href="{{url('admin/college/college-courses/' .base64_encode($row->id))}}" tabindex="0" data-bs-toggle="tooltip" title="Colloge Course/Fee " class=" btn btn-info btn-sm"><i class="fa fa-book text-white"></i></a>
                                                    <a href="javascript:void(0)" data-id="{!! $row->id !!}" class="btn btn-light btn-sm editInfo"><i class="fa fa-edit"></i></a>
                                                    <a href="{{url('admin/college/college-details/' .base64_encode($row->id))}}" class="btn btn-success btn-sm"
                                                       data-id="{!! base64_encode($row->id) !!}" data-bs-toggle="tooltip"
                                                       data-bs-placement="bottom" data-bs-title="Edit Salary">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{url('admin/college/college-students/' .base64_encode($row->id))}}"  tabindex="0" data-bs-toggle="tooltip" title="Colloge Roll/User Login " class=" btn btn-secondary btn-sm"><i class="fa fa-user-graduate text-white"></i></a>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBasicDetails" aria-labelledby="offcanvasBasicDetailsLabel" data-simplebar="" style="width: 30%">
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4 class="offcanvas-title fw-semibold" id="offcanvasBasicDetailsLabel">Add Academic Year</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form id="FormUpdateInfo" method="post">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <input type="hidden" name="_id" value=""/>
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="validationCustom01">Institution Category *</label>
                                    <select class="form-control select2" name="category_id" id="category_id" required>
                                        <option value="" disabled>Select Institution Type</option>
                                        @if (!empty($category) && count($category) > 0)
                                            @foreach ($category as $row)
                                                <option value="{{ $row->id }}">
                                                    {{ $row->title }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Institution Name <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="institution_name" required placeholder="Write institution name">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Institution Email <span style="color:red">*</span></label>
                                    <input type="email" class="form-control" name="institution_email"  required placeholder="Write institution email">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Institution Contact <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="institution_contact"  required placeholder="Write institution contact">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Institution GSTN</label>
                                    <input type="text" class="form-control" name="institution_gstn"   placeholder="Write institution gstn">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Institution Address <span style="color:red">*</span></label>
                                    <textarea class="form-control" name="institution_address" required placeholder="Write institution contact"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-sm btn-success">Update Profile</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>


            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasUserList" aria-labelledby="offcanvasUserListLabel" data-simplebar="" style="width: 50%">
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4 class="offcanvas-title fw-semibold" id="offcanvasUserListLabel">Institution User Lists</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="row">
                        <div class="col-md-12 shadow-sm bg-warning mb-3 border-0 w-100 text-white">
                            <form id="formUserAdd" class="" method="post">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                <input type="hidden" name="institution_id" value=""/>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="d-sm-flex d-block align-items-center justify-content-between mt-3">
                                            <div class="mb-3 mb-sm-0">
                                                <h5 class="card-title fw-semibold">Create New User</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="row mb-2">
                                            <div class="col-md-4 mb-2">
                                                <label>User Name <span style="color: #f50606">*</span></label>
                                                <input type="text" class="form-control" name="user_name" required>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label>User Personal Email <span style="color: #f50606">*</span></label>
                                                <input type="email" class="form-control" name="personal_email" required>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label>Personal Contact Number <span style="color: #f50606">*</span></label>
                                                <input type="text" maxlength="10" minlength="10" class="form-control" name="user_contact" required>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label>College Login Email <span style="color: #f50606">*</span></label>
                                                <input type="email" class="form-control" name="login_email" required>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label>College Login Password <span style="color: #f50606">*</span></label>
                                                <input type="password" class="form-control" name="login_password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center mb-2">
                                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 shadow-sm mb-3 border-0 w-100">
                            <table class="table table-bordered" id="userTable">
                                <thead>
                                <tr>
                                    <td>#</td>
                                    <td>User Name</td>
                                    <td>User Email</td>
                                    <td>User Contact</td>
                                    <td>Login Email</td>
                                    <td>Role</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
           @stop

            @section('scripts')
                <script>
                    $(document).on("click", ".changeStatus", function (){
                        var id = $(this).data('id');
                        var status = $(this).data('status');
                        $.post("{!! url('admin/college/change-status') !!}", {"_token" : "{!! csrf_token() !!}", 'id' : id, 'status' : status }, function(html){
                            let obj = $.parseJSON(html);
                            if(obj.code == 200){
                                $.alert({
                                    title: 'Success',
                                    icon: 'ti ti-face-smile',
                                    type: 'green',
                                    content: obj.msg,
                                });
                                setInterval(function () { location.reload() }, 2000)
                            }else{
                                $.alert({
                                    title: 'Error',
                                    icon: 'ti ti-alert',
                                    type: 'orange',
                                    content: obj.msg,
                                });
                            }
                        });

                    });

                    $(document).on("click", ".editInfo", function (){
                        let id = $(this).data('id');
                        $.post("{!! url('admin/college/edit') !!}", {"_token" : "{!! csrf_token() !!}", 'id' : id }, function(html){
                            let obj = $.parseJSON(html);
                            if(obj.code == 200){
                                $("#offcanvasBasicDetails form#FormUpdateInfo input[name='institution_name']").val(obj.data['institution_name']);
                                $("#offcanvasBasicDetails form#FormUpdateInfo select[name='category_id']").val(obj.data['category_id']);
                                $("#offcanvasBasicDetails form#FormUpdateInfo input[name='institution_email']").val(obj.data['institution_email']);
                                $("#offcanvasBasicDetails form#FormUpdateInfo input[name='institution_contact']").val(obj.data['institution_contact']);
                                $("#offcanvasBasicDetails form#FormUpdateInfo input[name='institution_gstn']").val(obj.data['gstn']);
                                $("#offcanvasBasicDetails form#FormUpdateInfo textarea[name='institution_address']").text(obj.data['institution_address']);
                                $("#offcanvasBasicDetails input[name='_id']").val(id);
                                $("#offcanvasBasicDetails h4.offcanvas-title").text("Update Institution Details");
                                $("#offcanvasBasicDetails").offcanvas("show");

                            }
                        });

                        //$("#offcanvasBasicDetails form#bankForm input[type='text']").val('');

                    });

                    $(document).on("submit", "#FormUpdateInfo", function (e){
                        e.preventDefault();
                        let forData = $("form#FormUpdateInfo").serialize();
                        $.post("{!! url('admin/college/update') !!}", forData, function(html){
                            let obj = $.parseJSON(html);
                            if(obj.code == 200){
                                $.alert({
                                    title: 'Success',
                                    icon: 'ti ti-face-smile',
                                    type: 'green',
                                    content: obj.msg
                                });
                                setInterval(function () { location.reload() }, 3000)
                            }else{
                                $.alert({
                                    title: 'Error',
                                    icon: 'ti ti-alert',
                                    type: 'orange',
                                    content: obj.msg
                                });
                            }
                        })
                    });

                    $(document).on("click", ".userDetails", function (){
                        let id = $(this).data('id');
                        $.post("{!! url('admin/college/college-user-list') !!}", {"_token": "{!! csrf_token() !!}", 'id' : id}, function(html){
                            let obj = $.parseJSON(html);
                            if(obj.code == 200){
                                $("#userTable tbody").html(obj.data);
                                $("#offcanvasUserList input[name='_id']").val(id);
                                $("#offcanvasUserList h4.offcanvas-title").text("Institution User Details");
                                $("#offcanvasUserList").offcanvas("show");
                            }
                        });

                    });
                </script>
            @stop


