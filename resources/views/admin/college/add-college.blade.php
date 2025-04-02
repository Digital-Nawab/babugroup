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
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 0px;
        }

        .card .card-header .card-title {
            margin-bottom: 0;
            font-size: 15px;
        }

        label {
            display: inline-block;
            margin-bottom: .5rem;
            font-size: 15px;
        }

        .card .card-header {
            background-color: #18aefa;
            border-bottom: 1px solid #eaeaea;
            color: #fff;
            padding: .5rem 1rem;
        }
    </style>
@stop
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Add College</h3>
                    {{-- <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add College</li>
                    </ul> --}}
                </div>
            </div>
        </div>
        <div class="row">
            @include('layout.flash-msg')
            <div class="col-sm-12">
                <form action="{!! url('admin/college/add-college') !!}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">College Basic Info</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
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
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom01">College name *</label>
                                    <input type="text" class="form-control" name="college_name"
                                        placeholder="College name" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">College Contact Email *</label>
                                    <input type="text" class="form-control" name="college_email" placeholder="Email"
                                        required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustomUsername">College Contact Number *</label>
                                    <input type="text" class="form-control" name="college_number"
                                        placeholder="Contact Number" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom05">College Address *</label>
                                    <textarea type="text" class="form-control" name="college_address" width="100%" placeholder="Address" required>
                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">College Admin Login</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault01">User Name *</label>
                                    <input type="text" class="form-control" name="user_name" placeholder="User Name"
                                        required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault02">User Personal Email *</label>
                                    <input type="email" class="form-control" name="personal_email"
                                        placeholder="User Personal Email" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefaultUsername">Personal Contact Number *</label>
                                    <input type="text" class="form-control" maxlength="10" minlength="10"
                                        name="user_contact" placeholder="Personal Contact Number" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault03">College Login Email *</label>
                                    <input type="email" class="form-control" name="login_email"
                                        placeholder="College Login Email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault04">College Login Password *</label>
                                    <input type="password" class="form-control" name="login_password"
                                        placeholder="College Login Password" required>
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
@stop
