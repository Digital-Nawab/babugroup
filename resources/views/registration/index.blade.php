@extends('layout.master')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .select2-container .select2-selection--single {
            height: 38px;
        }
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
                    <h3 class="page-title">New Students</h3>
                </div>
                <div class="col-auto text-end ms-auto">
                    <button class="btn btn-primary btn-sm addRegistration"><i class="fas fa-plus"></i>  Add New Registration</button>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="col-12">
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
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
                                @if(count($registration) > 0)
                                    @foreach ($registration as $key => $row)
                                        <tr>
                                            {{--                                                <td>{{ $key + 1 }}</td>--}}
                                            <td>{{ ($registration->currentPage() - 1) * $registration->perPage() + $key + 1 }}</td>
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
                            @if (count($registration) != 0)
                                <div class="p-2">
                                    {!! $registration->links('pagination::bootstrap-5') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup Form for Add/Update -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasLabel">Add New Registration {!! $year->name !!}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form id="registerForm" method="post" action="{!! url('admin/registration/add-new-registration') !!}">
                    @csrf
                    <div class="row">

                        <input type="hidden" name="academic_year" id="academic_year" value="{!! $year->id !!}">
                        <div class="mb-3 col-12">
                            <label for="college_id" class="form-label">College <span class="text-danger">*</span></label>
                            <select class="form-control select2 {{ $errors->has('college_id') ? 'is-invalid' : '' }}" name="college_id" id="institute" required>
                                <option value="">Select College</option>
                                @foreach($college as $row)
                                    <option value="{{ $row->id }}" {{ old('college_id') == $row->id ? 'selected' : '' }}>
                                        {{ $row->college_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('college_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-6">
                            <label for="course" class="form-label">Course <span class="text-danger">*</span></label>
                            <select class="form-control select2 {{ $errors->has('course_id') ? 'is-invalid' : '' }}" name="course_id" id="course" required>
                                <option value="">Select Course</option>
                                @foreach($course as $row)
                                    <option value="{{ $row->id }}" {{ old('course_id') == $row->id ? 'selected' : '' }}>
                                        {{ $row->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-6">
                            <label for="semesters" class="form-label">Semester <span class="text-danger">*</span></label>
                            <select class="form-control select2 {{ $errors->has('semesters') ? 'is-invalid' : '' }}" name="semesters" id="semesters" required>
                                <option value="">Select Semester</option>
                                @foreach($course as $row)
                                    <option value="{{ $row->id }}" {{ old('semesters') == $row->id ? 'selected' : '' }}>
                                        {{ $row->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('semesters')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <label for="name" class="form-label">Student Name</label>
                            <input type="text" class="form-control {{ $errors->has('student_name') ? 'is-invalid' : '' }}" pattern="[A-Za-z]+" title="Only alphabets allowed" maxlength="40" minlength="4" id="name" name="student_name" value="{{ old('student_name') }}" required>
                            @error('student_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <label for="mobile" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('mobile_num') ? 'is-invalid' : '' }}" pattern="\d*" title="Only Numbers allowed" inputmode="numeric" maxlength="13" minlength="10" id="mobile" name="mobile_num" value="{{ old('mobile_num') }}" required>
                            @error('mobile_num')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-6">
                            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                            <select class="form-control select2 {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="others" {{ old('gender') == 'others' ? 'selected' : '' }}>Others</option>
                            </select>
                            @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-6">
                            <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                            <input type="text" class="form-control flatpickrMaxLimit {{ $errors->has('dob') ? 'is-invalid' : '' }}" name="dob" value="{{ old('dob') }}" required />
                            @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <label for="father_name" class="form-label">Father Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}" pattern="[A-Za-z]+" title="Only alphabets allowed" maxlength="40" minlength="4" id="father_name" name="father_name" value="{{ old('father_name') }}" required>
                            @error('father_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12">
                            <label for="mother_name" class="form-label">Mother Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('mother_name') ? 'is-invalid' : '' }}" pattern="[A-Za-z]+" title="Only alphabets allowed" maxlength="40" minlength="4" id="mother_name" name="mother_name" value="{{ old('mother_name') }}" required>
                            @error('mother_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label for="amount" class="form-label">Pay Amount <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" maxlength="5" minlength="3" name="amount" value="{{ old('amount') }}" placeholder="100" required />
                            @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label for="payment_mode" class="form-label">Payment Mode <span class="text-danger">*</span></label>
                            <select class="form-control select2 {{ $errors->has('payment_mode') ? 'is-invalid' : '' }}" name="payment_mode" required>
                                <option value="">Select Mode</option>
                                <option value="upi" {{ old('payment_mode') == 'upi' ? 'selected' : '' }}>UPI</option>
                                <option value="cash" {{ old('payment_mode') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="gateway" {{ old('payment_mode') == 'gateway' ? 'selected' : '' }}>Gateway</option>
                            </select>
                            @error('payment_mode')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3 col-12">
                            <button type="submit" class="btn btn-success" id="submitAcademicYear">Registered</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@stop
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $('.flatpickrMaxLimit').flatpickr({
            dateFormat: "Y-m-d",
            maxDate: "today",
        });
    </script>
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

    <script type="text/javascript">
        /* Add Academic Year */
        $(document).on("click", ".addRegistration", function() {
            $("#offcanvasExample form#academicForm input[type='text']").val('');
            $("#offcanvasExample input[name='_id']").val('');
            $("#offcanvasExample h4.offcanvas-title").text("Add New Registration");
            $("#offcanvasExample").offcanvas("show");
        });
        </script>

@stop
