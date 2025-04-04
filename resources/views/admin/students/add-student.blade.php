@extends('layout.master')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            float: left;
            padding-right: .5rem;
            color: #6c757d;
            content: var(--bs-breadcrumb-divider, "/");
        }

        .form-title {
            margin-bottom: 0px;
            font-size: 1rem;
        }

        .page-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .card .card-header {
            background-color: #18aefa;
            border-bottom: 1px solid #eaeaea;
            padding: 0.50rem;
        }

        .form-title span {
            padding: 0 .5rem 0 0;
            background-color: #18aefa;
            display: inline-block;
            z-index: 2;
            position: relative;
            color: #fff;
        }

        .form-title:before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            height: 1px;
            top: 50%;
            background-color: rgb(24 174 250);
        }

        label {
            display: inline-block;
            margin-bottom: .5rem;
            font-size: 15px;
        }

        input.form-control::placeholder {
            font-size: 14px;
        }
    </style>
@stop
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Student</h3>
                    {{-- <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="students.html">Students</a></li>
                        <li class="breadcrumb-item active">Add Students</li>
                    </ul> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <form method="post" action="{!! url('admin/students/new-student') !!}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="form-title"><span>Basic Information</span></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Application Form <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="input[admission_form_no]"
                                            placeholder="Application Form" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Student Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Student Name"
                                            name="input[student_name]" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Father Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="input[father_name]"
                                            placeholder="Father Name" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Mother Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="input[mother_name]"
                                            placeholder="Mother Name" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="input[gender]" required>
                                            <option value="">Select Gender</option>
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Student DOB <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control flatpickrWithLimit"
                                            value="{!! date('d-m-Y', strtotime('-20 years')) !!}" name="date_of_birth" required />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Student Email <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="input[email]"
                                            placeholder="Student Email" required />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Contact Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" onkeypress="return onlyNumberKey(event)"
                                            maxlength="10" minlength="10" name="input[mobile_num]"
                                            placeholder="Student Contact Number" required />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Whatapp Number</label>
                                        <div>
                                            <input type="text" class="form-control"
                                                onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10"
                                                name="input[what_app_num]" placeholder="Student Whatapp Number" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Guardians Contact Number *</label>
                                        <input type="text" class="form-control" placeholder="Guardians Contact Number"
                                            onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10"
                                            name="input[guardians_contact]" required />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Student Aadhar Number</label>
                                        <input type="text" placeholder="Student Adhar Number"
                                            onkeypress="return onlyNumberKey(event)" maxlength="16" class="form-control"
                                            name="input[adhar_number]">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Scholarship Number</label>
                                        <input type="text" class="form-control"
                                            placeholder="Student Scholarship Number" name="input[scholar_number]" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Caste</label>
                                        <select class="form-control select2" name="input[caste]" required>
                                            <option value="">Select Caste</option>
                                            <option value="GEN">GEN</option>
                                            <option value="OBC">OBC</option>
                                            <option value="SC">SC</option>
                                            <option value="ST">ST</option>
                                            <option value="OTHERS">OTHERS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Caste Category</label>
                                        <input type="text" class="form-control" placeholder="Caste Category"
                                            name="input[caste_type]" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Religion</label>
                                        <select class="form-control select2" name="input[religion]" required>
                                            <option value="">Select Religion</option>
                                            <option value="Hinduism">Hinduism</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Christianity">Christianity</option>
                                            <option value="Buddhism">Buddhism</option>
                                            <option value="Judaism ">Judaism </option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Nationality</label>
                                        <select class="form-control select2" name="input[nationality]" required>
                                            <option value="">Select Nationality</option>
                                            <option value="Indian">Indian</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="form-title"><span>Academy Information</span></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Academic Year <span style="color: red">*</span></label>
                                        <select class="form-control select2" id="academic_year"
                                            name="academic[academic_year]" style="width: 100%; height: 40px" required>
                                            <option value="">Select</option>
                                            @if (count($academic_year) != 0)
                                                @foreach ($academic_year as $row)
                                                    <option value="{!! $row->id !!}">{!! $row->academic_year !!}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Academic Course <span style="color: red">*</span></label>
                                        <select class="form-control select2" name="academic[course]" id="academic_course"
                                            style="width: 100%; height: 40px" required>
                                            <option value="">Select</option>
                                            @if (count($academic_course ?? '') != 0)
                                                @foreach ($academic_course ?? '' as $row)
                                                    <option value="{!! $row->id !!}">{!! $row->course !!}
{{--                                                        {!! $row->subject !!}--}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>Subjects <span style="color: red">*</span></label>
                                    <div class="row" id="subject"></div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Academic Fee <span style="color: red">*</span></label>
                                        <input type="text" class="form-control"
                                            onkeypress="return onlyNumberKey(event)" name="academic[academic_fee]"
                                            id="academic_fee" value="0" required />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Admission Fee <span style="color: red">*</span></label>
                                        <input type="text" class="form-control"
                                            onkeypress="return onlyNumberKey(event)" name="academic[admission_fee]"
                                            id="admission_fee" value="0" required />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Other Charges <span style="color: red">*</span></label>
                                        <input type="text" class="form-control"
                                            onkeypress="return onlyNumberKey(event)" name="academic[other_charges]"
                                            id="other_charges" value="0" required />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Total Fee <span style="color: red">*</span></label>
                                        <input type="text" class="form-control"
                                            onkeypress="return onlyNumberKey(event)" name="academic[total_fee]"
                                            id="total_fee" required readonly />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Academic Discount <span style="color: red">*</span></label>
                                        <input type="text" class="form-control"
                                            onkeypress="return onlyNumberKey(event)" name="academic[discount]"
                                            id="discount" value="0" required />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Discount Type <span style="color: red">*</span></label>
                                        <select class="form-control select2" name="academic[discount_type]"
                                            id="fee_discount_type" required>
                                            <option value="rs">Rs</option>
                                            <option value="percent">%</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Final Fee <span style="color: red">*</span></label>
                                        <input type="text" class="form-control"
                                            onkeypress="return onlyNumberKey(event)" name="academic[final_fee]"
                                            id="final_price" required readonly />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Payed Amount <span style="color: red">*</span></label>
                                        <input type="text" class="form-control "
                                            onkeypress="return onlyNumberKey(event)" name="academic[payed_amount]"
                                            id="payed_amount" value="0" required />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Payment Mode <span style="color: red">*</span></label>
                                        {{-- <input type="text" class="form-control" onkeypress="return onlyNumberKey(event)" name="academic[payment_mode]" id="payment_mode" required/> --}}
                                        <select class="form-control select2" name="academic[payment_mode]"
                                            id="payment_mode" required="">
                                            <option value="">Select</option>
                                            <option value="cash">Cash</option>
                                            <option value="credit-card">Credit Card</option>
                                            <option value="debit-card">Debit Cart</option>
                                            <option value="upi-pay">UPI Pay</option>
                                            <option value="online">Online</option>
                                            <option value="cheque">Cheque</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Payment Date <span style="color: red">*</span></label>
                                        <input type="text" class="form-control flatpickrMaxLimit"
                                            name="academic[payment_date]" id="payment_date" required />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Remain Amount<span style="color: red">*</span></label>
                                        <input type="text" class="form-control"
                                            onkeypress="return onlyNumberKey(event)" name="academic[remain_amount]"
                                            id="remain_amount" required />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Next Payment Date<span style="color: red">*</span></label>
                                        <input type="text" class="form-control flatpickrMinLimit"
                                            onkeypress="return onlyNumberKey(event)" name="academic[next_payment_date]"
                                            id="next_payment_date" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="form-title"><span>Address Information</span></h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Pincode <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" placeholder="Pincode"
                                                    id="post_code" onkeypress="return onlyNumberKey(event)"
                                                    name="input[pincode]" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>District <span style="color: red">*</span></label>
                                                <input type="text" id="district" placeholder="District"
                                                    class="form-control" name="input[district]" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>State <span style="color: red">*</span></label>
                                                <input type="text" id="state" placeholder="State"
                                                    class="form-control" name="input[state]" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>City <span style="color: red">*</span></label>
                                                <input type="text" id="city" placeholder="City"
                                                    class="form-control" name="input[city]" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Permanent Address <span style="color: red">*</span></label>
                                                <textarea class="form-control" placeholder="Permanent Address" name="input[permanent_address]" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="form-title"><span>Previous Education</span></h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Last Education </label>
                                                <input type="text" class="form-control" placeholder="Last Education"
                                                    id="last_education" name="input[last_education]">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Board/University </label>
                                                <input type="text" id="university" placeholder="Board/University"
                                                    class="form-control" name="input[last_education_board]">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Roll No </label>
                                                <input type="text" id="" placeholder="Roll No"
                                                    class="form-control" name="input[roll_no]">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Rank/Grade</label>
                                                <input type="text" id="" placeholder="Rank/Grade"
                                                    class="form-control" name="input[rank]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="form-title"><span>Any Entrance Exam</span></h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Entrance Exam Name </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Entrance Exam Name" name="input[entrance_exam_name]">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Entrance Exam Roll No. </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Entrance Exam Roll No."
                                                    name="input[entrance_exam_roll_no]">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Entrance Exam Rank </label>
                                                <input type="text" class="form-control"
                                                    placeholder="Entrance Exam Rank" name="input[entrance_exam_rank]">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Entrance Exam Date </label>
                                                <input type="text" class="form-control flatpickr"
                                                    placeholder="Entrance Exam Date" name="input[entrance_exam_date]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 text-center">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript">
        /* Add */
        $(document).on("click", ".addAcademicFee", function() {
            $("#offcanvasExample form#subjectForm input[type='text']").val('');
            $("#offcanvasExample input[name='_id']").val('');
            $("#offcanvasExample h4.offcanvas-title").text("Add Academic Fee");
            $("#offcanvasExample").offcanvas("show");

        });

        $(document).ready(function() {

            $('.numberonly').keypress(function(e) {

                var charCode = (e.which) ? e.which : event.keyCode

                if (String.fromCharCode(charCode).match(/[^0-9]/g))

                    return false;

            });

            $('.flatpickrWithLimit').flatpickr({
                minDate: "2000-01",
                maxDate: "2020-01",
                dateFormat: "Y-m-d",
            });

            $('.flatpickr').flatpickr({
                dateFormat: "Y-m-d",
            });

            $('.flatpickrMinLimit').flatpickr({
                dateFormat: "Y-m-d",
                minDate: "today",
                maxDate: new Date().fp_incr(40)
            });

            $('.flatpickrMaxLimit').flatpickr({
                dateFormat: "Y-m-d",
                maxDate: "today",
                minDate: new Date().fp_incr(-15)
            });
        });

        /* Get Academic Course Type */
        $(document).on("change", "#academic_course", function() {
            let academicYear = $("#academic_year").val(),
                academicCourse = $("#academic_course").val();
            if (academicYear == "") {
                $.alert("Please Select Academic Year", "Warning");
                return false;
            }
            if (academicCourse == "") {
                $.alert("Please Select Academic Course", "Warning");
                return false;
            } else {
                $.post("{!! url('admin/students/ajex-academic-course-type') !!}", {
                    "_token": "{!! csrf_token() !!}",
                    'academic_year': academicYear,
                    'academic_course': academicCourse
                }, function(html) {
                    let obj = $.parseJSON(html);
                    if (obj.code == 200) {
                        $("select#academic_course_type").html(obj.data);
                        $("select#academic_course_type").select2();
                        $("div.row#subject").html(obj.subject);
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
        });

        /* Get Academic Fee */
        $(document).on("change", "select#academic_course_type", function() {
            let courseType = $(this).val();
            $.post("{!! url('admin/get-single-data') !!}", {
                '_token': "{!! csrf_token() !!}",
                'where[id]': courseType,
                'tab': 'academic_fee'
            }, function(html) {
                let obj = $.parseJSON(html);
                if (obj.code == 200) {
                    $("#academic_fee").val(obj.data['academic_fee']);
                    calcucation()
                } else {
                    $.alert({
                        title: 'Error',
                        icon: 'ti ti-alert',
                        type: 'orange',
                        content: obj.msg,
                    });
                }
            });
        });

        function calcucation() {
            let academic_fee = $("#academic_fee").val(),
                admission_fee = $("#admission_fee").val(),
                otherCharges = $("#other_charges").val(),
                discount = $("#discount").val(),
                discount_type = $("#fee_discount_type").val(),
                payedAmount = $("#payed_amount").val();
            totalFee = parseInt(academic_fee) + parseInt(admission_fee) + parseInt(otherCharges);
            $("#total_fee").val(parseInt(totalFee));
            FinalFee = 0;
            if (discount_type == "percent") {
                FinalFee = totalFee - ((totalFee * parseInt(discount)) / 100);
            } else if (discount_type == "rs") {
                FinalFee = totalFee - parseInt(discount);
            }
            $("#final_price").val(FinalFee);
            $("#remain_amount").val(FinalFee - parseInt(payedAmount));


        }

        $(document).on("change", "#admission_fee", function() {
            calcucation();
        });

        $(document).on("change", "#other_charges", function() {
            calcucation();
        });

        $(document).on("change", "#discount", function() {
            calcucation();
        });

        $(document).on("change", "#fee_discount_type", function() {
            calcucation();
        });

        $(document).on("keyup", "#payed_amount", function() {
            calcucation();
        });

        $(document).on("change", "#post_code", function() {
            var val = $(this).val();
            if (val != "") {
                $.post("{!! url('admin/get-address') !!}", {
                    '_token': '{!! csrf_token() !!}',
                    'pincode': val
                }, function(html) {
                    var obj = $.parseJSON(html);
                    //$("#shipping_city").val(obj['region']);
                    if (obj.code == 200) {
                        $("#city").val(obj.data['district']);
                        $("#state").val(obj.data['state']);
                        $("input[name='input[district]']").val(obj.data['district']);
                    } else {
                        $.alert({
                            title: 'Error',
                            icon: 'ti ti-alert',
                            type: 'orange',
                            content: obj.msg,
                        });
                    }
                    return false;
                });
            }
        });


        $(document).on("change", ".checkDoc", function() {
            let value = $(this).val();
            if ($("#doc_check_" + value).prop('checked') == true) {
                //do something
                $("#doc_div_" + value).css('display', "block");
                //console.log(value)
            } else {
                $("doc_" + value).val("");
                $("#doc_div_" + value).css('display', "none");
                //do something
                //console.log(value+" is not checked");
            }
        });
    </script> --}}
@stop
