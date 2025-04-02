@extends('layout.master')
@section('styles')
    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            float: left;
            padding-right: .5rem;
            color: #6c757d;
            content: var(--bs-breadcrumb-divider, "/");
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
    </style>
@stop
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">List Teachers</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('auth/dashboard') !!}">Dashboard</a></li>
                        <li class="breadcrumb-item active">List Teachers</li>
                    </ul>
                </div>
                <div class="col-auto text-end float-end ms-auto">
                    <a href="add-department.html" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Salary</th>
                                        <th>Joining Date</th>
                                        <th>Institutions</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) != 0)
                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{!! $key + 1 !!}.</td>
                                                <td>{!! ucfirst($row->full_name) !!}</td>
                                                <td>{!! $row->contact_email !!}</td>
                                                <td>{!! $row->contact_mobile !!}</td>
                                                <td>{!! $row->salary !!}</td>
                                                <td>{!! date('F d, Y', strtotime($row->joining_date)) !!}</td>
                                                <td>
                                                    {!! $row->institution_name !!}
                                                </td>
                                                <td>
                                                    @if ($row->is_active == '1')
                                                        <span
                                                            class="badge fw-semibold py-1 w-85 bg-light-primary text-primary">Active</span>
                                                    @else
                                                        <span
                                                            class="badge fw-semibold py-1 w-85 bg-light-danger text-primary">Non
                                                            Active</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-success editTeacher"
                                                        data-id="{!! base64_encode($row->id) !!}" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" data-bs-title="Edit Teacher Info">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{!! url('admin/teacher/teacher-details', base64_encode($row->id)) !!}" class="btn btn-dark"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        data-bs-title="View Teacher Info">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    @if ($row->is_active == '1')
                                                        <a href="javascript:void(0)" class="btn btn-danger updateStatus"
                                                            data-id="{!! $row->id !!}" data-status="2"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            data-bs-title="Non Active">
                                                            <i class="fa fa-lock"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)" class="btn btn-primary updateStatus"
                                                            data-id="{!! $row->id !!}" data-status="1"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            data-bs-title="Active">
                                                            <i class="fa fa-check"></i>
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
        @stop
