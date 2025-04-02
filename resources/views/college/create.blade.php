@extends('layout.master')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Add College</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @include('layout.flash-msg')
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
            <div class="col-sm-12">
                <form action="{!! url('admin/college/add-college') !!}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-info">
                            <h5 class="card-title text-white">College Basic Info</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="university_id">Select University <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="university_id" id="university_id" required>
                                        <option value="" disabled>Select University</option>
                                        @if (!empty($university) && count($university) > 0)
                                            @foreach ($university as $row)
                                                <option value="{{ $row->id }}" {{ old('university_id') == $row->id ? 'selected' : '' }}>
                                                    {{ $row->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('university_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="category_id">College Category <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="category_id" id="category_id" required>
                                        <option value="" disabled>Select Category Type</option>
                                        @if (!empty($category) && count($category) > 0)
                                            @foreach ($category as $row)
                                                <option value="{{ $row->id }}" {{ old('category_id') == $row->id ? 'selected' : '' }}>
                                                    {{ $row->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="collegeName">College Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="collegeName" name="college_name" placeholder="College name" value="{{ old('college_name') }}" required>
                                    @error('college_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustomUsername">Contact Number <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="13" minlength="10" class="form-control" name="college_contact" placeholder="Contact Number" value="{{ old('college_contact') }}" required>
                                    @error('college_contact') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="validationCustomUsername">College Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="10" minlength="3" class="form-control" name="college_code" placeholder="College Code" value="{{ old('college_code') }}" required>
                                    @error('college_code') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="college_email" placeholder="College Email" value="{{ old('college_email') }}" required>
                                    @error('college_email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustomUsername">College GSTN</label>
                                    <input type="text" class="form-control" maxlength="15" minlength="15" name="gstn" placeholder="Contact Number" value="{{ old('gstn') }}">
                                    @error('gstn') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="collegeSlug">College URL <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="collegeSlug" name="slug_url" placeholder="College URL" value="{{ old('slug_url') }}" required readonly>
                                    @error('slug_url') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="validationCustom05">College Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="address" value="{{ old('address') }}">
                                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="collegeLogo">College Logo</label>
                                    <input type="file" class="form-control" id="collegeLogo" name="logo" accept="image/*">
                                    @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-11 mb-3">
                                    <label for="validationCustom05">College Description </label>
                                    <textarea type="text" class="form-control" name="description" width="100%" placeholder="College Description">{{ old('description') }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-1 mb-3">
                                    <label for="previewImage">Preview</label>
                                    <img id="previewImage" src="https://www.babuedu.com/assets/img/logo/logo.png" class="img-fluid" alt="Preview" style="width: 100%; height: auto; border: 1px solid #ddd; padding: 3px ">
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-info">
                            <h5 class="card-title text-white">College Admin Login</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label for="validationDefault01">User Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="User Name" value="{{ old('name') }}" required>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault02">User Personal Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" placeholder="User Personal Email" value="{{ old('email') }}" required>
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="validationDefaultUsername">Personal Contact Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" maxlength="10" minlength="10" name="contact" placeholder="Personal Contact Number" value="{{ old('contact') }}" required>
                                    @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="password">Login Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" placeholder="College Login Password" required>
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mb-3">
                        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        function generateSlug(name) {
            return name.toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')  // Remove special characters
                .replace(/\s+/g, '-')         // Replace spaces with hyphens
                .replace(/-+/g, '-');         // Remove multiple hyphens
        }

        $("#collegeName").on("keyup change", function() { // Triggers on typing & changing
            let name = $(this).val();
            let slug = generateSlug(name);
            $("#collegeSlug").val(slug);
        });
    });

    document.getElementById('collegeLogo').addEventListener('change', function(event) {
        let preview = document.getElementById('previewImage');
        let file = event.target.files[0];

        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = "block"; // Show image after selection
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            preview.style.display = "none"; // Hide preview if no file selected
        }
    });

</script>
@endsection
