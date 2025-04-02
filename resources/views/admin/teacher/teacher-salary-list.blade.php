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
                    <h3 class="page-title">Teachers Salary List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('auth/dashboard') !!}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teachers Salary List</li>
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
                                        <th>Contact</th>
                                        <th>Salary Month</th>
                                        <th>Salary Year</th>
                                        <th>Attendance Details</th>
                                        <th>Salary</th>
                                        <th>Bonus</th>
                                        <th>Payed Salary</th>
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
                                                <td>{!! $row->contact_mobile !!}</td>
                                                <td>{!! date('F', mktime(0, 0, 0, $row->salary_month, 1)) !!}</td>
                                                <td>{!! $row->salary_year !!}</td>
                                                <td>
                                                    <span>Present : {!! $row->attendance_present !!}</span>
                                                    <span>Absent : {!! $row->attendance_absent !!}</span>
                                                    <span>Leave : {!! $row->attendance_leave !!}</span>
                                                </td>
                                                <td>
                                                    {!! number_format($row->salary, 2) !!}
                                                </td>
                                                <td>
                                                    {!! number_format($row->bonus, 2) !!}
                                                </td>
                                                <td>
                                                    {!! number_format($row->payed_salary, 2) !!}
                                                </td>
                                                <td>
                                                    @switch($row->is_active)
                                                        @case('1')
                                                            <span class="badge fw-semibold py-1 w-85 bg-primary ">Active</span>
                                                        @break

                                                        @case('2')
                                                            <span class="badge fw-semibold py-1 w-85 bg-danger">Not Active</span>
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-danger printReceipt"
                                                        data-id="{!! $row->id !!}" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" data-bs-title="Print Salary">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                    @if ($row->is_active == '2')
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-success editTeacherSalary"
                                                            data-id="{!! base64_encode($row->id) !!}" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" data-bs-title="Edit Salary">
                                                            <i class="fa fa-edit"></i>
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
