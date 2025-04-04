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
                    <div class="bg-success-light p-2">
                        <h5 class="card-title">Add Courses</h5>
                    </div>
                    <div class="card-body p-3">
                        <form method="POST" action="{{ url('admin/college/add-college-courses') }}" enctype="application/x-www-form-urlencoded">
                            <input type="hidden" name="institution_id" value="{!! $id !!}">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="institution_category">Institution Year <span style="color: red">*</span></label>
                                    <select class="form-control select2" name="year" id="college_year" required>
                                        <option value="" disabled>Select Institution Year</option>
                                        @if (!empty($college_year) && $college_year != null)
                                            <option value="{{ $college_year->id }}">{{ $college_year->name }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label for="institution_category">Institution Category <span style="color: red">*</span></label>
                                    <select class="form-control select2" name="course_name[]" id="institution_category" multiple required>
                                        <option value="" disabled>Select Institution Category</option>
                                        @if (!empty($college_courses) && count($college_courses) > 0)
                                            @foreach ($college_courses as $row)
                                                <option value="{{ $row->id }}" data-semesters="{{ $row->semesters }}">
                                                    {{ $row->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <!-- Container for Semester Fee Inputs -->
                            <div id="semester_fee_container" class="row mt-3"></div>

                            <div class="col-md-2 text-left mt-3">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="ti-save"></i> Create Course
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!------------Modal Popup --------------------->

           {{-- <div class="content container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0 datatable">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Year</th>
                                            <th>Course</th>
                                            <th>Semesters</th>
                                            <th>Fee</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (count($data) > 0)
                                            @foreach ($data as $key => $row)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{!! ucfirst($row->year) !!}</td>
                                                    <td>{!! ucfirst($row->course) !!}</td>
                                                    <td>Semesters-{!! $row->semesters !!}</td>
                                                    <td>{!! $row->fee !!}</td>
                                                    <td class="text-end">
                                                        <div class="actions">
                                                            <a href="edit-student.html" class="btn btn-sm btn-success-light">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-danger-light">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </div>
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
                </div>
            </div>

--}}
            @stop


                @section('scripts')
                <script>

                        $(document).ready(function () {
                        $('#institution_category').change(function () {
                            let selectedOptions = $(this).find(':selected');
                            let container = $('#semester_fee_container');

                            // Store existing input values
                            let existingValues = {};
                            container.find('input').each(function () {
                                let key = $(this).attr('name'); // Get input name as key
                                existingValues[key] = $(this).val(); // Store input value
                            });

                            // Get the currently selected institution IDs
                            let selectedIds = selectedOptions.map(function () {
                                return $(this).val();
                            }).get();

                            // Remove semester fee sections for deselected institutions
                            $('.course-container').each(function () {
                                let courseId = $(this).data('course-id');
                                if (!selectedIds.includes(courseId.toString())) {
                                    $(this).remove(); // Remove the row if the institution is deselected
                                }
                            });

                            // Add new semester fee inputs for newly selected institutions
                            selectedOptions.each(function () {
                                let courseId = $(this).val();
                                let courseTitle = $(this).text();
                                let semesterCount = $(this).data('semesters');

                                // Check if this course's semester fee section already exists
                                if ($(`#course_${courseId}`).length === 0 && semesterCount > 0) {
                                    let courseContainer = $(`
                        <div class="col-12 mt-3 course-container" id="course_${courseId}" data-course-id="${courseId}">
                            <h6 class="m-0 text-info"><u>${courseTitle} Fees - ${semesterCount} Semesters</u></h6>
                            <div class="row border-bottom pb-2"></div>
                        </div>
                    `);

                                    let semesterRow = courseContainer.find('.row');
                                    for (let i = 1; i <= semesterCount; i++) {
                                        let inputName = `semesters[${courseId}][${i}]`;
                                        semesterRow.append(`
                            <div class="col-md-2">
                                <label for="semester_${courseId}_${i}">Semester ${i} Fee <span style="color: red">*</span></label>
                                <input type="text" class="form-control semester-input" name="${inputName}" required placeholder="Enter fee for Semester ${i}">
                            </div>
                        `);
                                    }
                                    container.append(courseContainer);
                                }
                            });

                            // Restore previous input values
                            container.find('input').each(function () {
                                let key = $(this).attr('name');
                                if (existingValues[key] !== undefined) {
                                    $(this).val(existingValues[key]);
                                }
                            });
                        });

                        // Restrict input to numbers only
                        $(document).on('input', '.semester-input', function () {
                        this.value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
                    });
                    });
                </script>


@stop
